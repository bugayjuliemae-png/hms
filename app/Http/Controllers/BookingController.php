<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function index()
    {
        if (auth()->user()->role === 'admin') {

            $bookings = Booking::with(['user', 'room'])
                ->latest()
                ->get();

        } else {

            $bookings = Booking::with(['user', 'room'])
                ->where('user_id', auth()->id())
                ->latest()
                ->get();
        }

        return view('bookings.index', compact('bookings'));
    }


    public function create()
    {
        $rooms = Room::where('status', 'available')
            ->get();

        return view('bookings.create', compact('rooms'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'contact_number' => 'required|string|max:20',
            'room_id' => 'required|exists:rooms,id',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'payment_method' => 'required|in:gcash,cash,bank_transfer',
        ]);


        $room = Room::findOrFail($request->room_id);


        $overlappingBooking = Booking::where('room_id', $room->id)
            ->whereIn('status', ['pending', 'approved'])
            ->where(function ($query) use ($request) {

                $query->where('check_in', '<', $request->check_out)
                    ->where('check_out', '>', $request->check_in);

            })
            ->exists();


        if ($overlappingBooking) {

            return back()
                ->withInput()
                ->withErrors([
                    'room_id' =>
                        'This room is already reserved for the selected dates.'
                ]);
        }


        $checkIn = Carbon::parse($request->check_in);
        $checkOut = Carbon::parse($request->check_out);

        $nights = $checkIn->diffInDays($checkOut);

        $totalPrice = $room->price * $nights;


        Booking::create([

            'user_id' => auth()->id(),

            'customer_name' => $request->customer_name,

            'contact_number' => $request->contact_number,

            'room_id' => $request->room_id,

            'check_in' => $request->check_in,

            'check_out' => $request->check_out,

            'total_price' => $totalPrice,

            'status' => 'pending',

            'payment_method' => $request->payment_method,

            'payment_status' => 'unpaid',

            'payment_reference' => null,

        ]);


        return redirect()
            ->route('bookings.index')
            ->with(
                'success',
                'Booking submitted successfully! Please wait for admin approval.'
            );
    }


    public function edit(Booking $booking)
    {
        if (
            auth()->user()->role !== 'admin'
            && $booking->user_id !== auth()->id()
        ) {
            abort(403);
        }


        $rooms = Room::all();


        return view(
            'bookings.edit',
            compact('booking', 'rooms')
        );
    }


    public function update(Request $request, Booking $booking)
    {
        if (
            auth()->user()->role !== 'admin'
            && $booking->user_id !== auth()->id()
        ) {
            abort(403);
        }


        $request->validate([
            'customer_name' => 'required|string|max:255',
            'contact_number' => 'required|string|max:20',
            'room_id' => 'required|exists:rooms,id',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'payment_method' => 'required|in:gcash,cash,bank_transfer',
        ]);


        $overlappingBooking = Booking::where('room_id', $request->room_id)
            ->where('id', '!=', $booking->id)
            ->whereIn('status', ['pending', 'approved'])
            ->where(function ($query) use ($request) {

                $query->where('check_in', '<', $request->check_out)
                    ->where('check_out', '>', $request->check_in);

            })
            ->exists();


        if ($overlappingBooking) {

            return back()
                ->withInput()
                ->withErrors([
                    'room_id' =>
                        'This room is already reserved for the selected dates.'
                ]);
        }


        $room = Room::findOrFail($request->room_id);


        $checkIn = Carbon::parse($request->check_in);
        $checkOut = Carbon::parse($request->check_out);

        $nights = $checkIn->diffInDays($checkOut);

        $totalPrice = $room->price * $nights;


        if (auth()->user()->role === 'admin') {

            $status = $booking->status;

            if ($request->has('status')) {
                $status = $request->status;
            }

        } else {

            $status = 'pending';
        }


        $booking->update([

            'customer_name' => $request->customer_name,

            'contact_number' => $request->contact_number,

            'room_id' => $request->room_id,

            'check_in' => $request->check_in,

            'check_out' => $request->check_out,

            'total_price' => $totalPrice,

            'status' => $status,

            'payment_method' => $request->payment_method,

        ]);


        return redirect()
            ->route('bookings.index')
            ->with(
                'success',
                'Reservation updated successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | ADMIN APPROVE
    |--------------------------------------------------------------------------
    */

    public function approve(Booking $booking)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }


        if ($booking->status !== 'pending') {

            return back()->withErrors([
                'booking' =>
                    'Only pending bookings can be approved.'
            ]);
        }


        $overlappingBooking = Booking::where('room_id', $booking->room_id)
            ->where('id', '!=', $booking->id)
            ->where('status', 'approved')
            ->where(function ($query) use ($booking) {

                $query->where(
                    'check_in',
                    '<',
                    $booking->check_out
                )
                ->where(
                    'check_out',
                    '>',
                    $booking->check_in
                );

            })
            ->exists();


        if ($overlappingBooking) {

            return back()->withErrors([
                'booking' =>
                    'This room is already approved for the selected dates.'
            ]);
        }


        $booking->update([
            'status' => 'approved',
        ]);


        $booking->room->update([
            'status' => 'booked',
        ]);


        return back()->with(
            'success',
            'Booking approved successfully.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | ADMIN CANCEL
    |--------------------------------------------------------------------------
    */

    public function cancel(Booking $booking)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }


        $booking->update([
            'status' => 'cancelled',
        ]);


        if ($booking->room) {

            $booking->room->update([
                'status' => 'available',
            ]);
        }


        return back()->with(
            'success',
            'Booking cancelled successfully.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */

    public function destroy(Booking $booking)
    {
        if (
            auth()->user()->role !== 'admin'
            && $booking->user_id !== auth()->id()
        ) {
            abort(403);
        }


        $room = $booking->room;


        $booking->delete();


        if ($room) {

            $room->update([
                'status' => 'available',
            ]);
        }


        return redirect()
            ->route('bookings.index')
            ->with(
                'success',
                'Reservation deleted successfully.'
            );
    }
}