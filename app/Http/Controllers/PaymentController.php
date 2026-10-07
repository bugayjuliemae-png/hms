<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // SHOW PAYMENT PAGE
    public function create(Booking $booking)
    {
        // Customer can only pay their own reservation
        if (
            auth()->user()->role !== 'admin'
            && $booking->user_id !== auth()->id()
        ) {
            abort(403);
        }

        // Payment is only allowed after admin approval
        if ($booking->status !== 'approved') {
            return redirect()
                ->route('bookings.index')
                ->withErrors([
                    'payment' => 'You can only pay an approved reservation.'
                ]);
        }

        return view(
            'payments.create',
            compact('booking')
        );
    }

    // SAVE PAYMENT
    public function store(Request $request, Booking $booking)
    {
        // Customer can only pay their own reservation
        if (
            auth()->user()->role !== 'admin'
            && $booking->user_id !== auth()->id()
        ) {
            abort(403);
        }

        // Payment is only allowed after admin approval
        if ($booking->status !== 'approved') {
            return redirect()
                ->route('bookings.index')
                ->withErrors([
                    'payment' => 'You can only pay an approved reservation.'
                ]);
        }

        $request->validate([
            'payment_method' => 'required|in:gcash,cash,bank_transfer',
            'payment_reference' => 'nullable|string|max:255',
        ]);

        $booking->update([
            'payment_method' => $request->payment_method,
            'payment_reference' => $request->payment_reference,
            'payment_status' => 'pending',
        ]);

        return redirect()
            ->route('bookings.index')
            ->with(
                'success',
                'Payment submitted successfully. Please wait for admin verification.'
            );
    }
}