<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\UserController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;

use App\Models\Room;
use App\Models\User;
use App\Models\Booking;


/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});


/*
|--------------------------------------------------------------------------
| LOGIN
|--------------------------------------------------------------------------
*/

Route::get('/login', function () {
    return view('auth.login');
})->name('login');


/*
|--------------------------------------------------------------------------
| LOGOUT
|--------------------------------------------------------------------------
*/

Route::post('/logout', function () {

    Auth::logout();

    request()->session()->invalidate();

    request()->session()->regenerateToken();

    return redirect()->route('login');

})->name('logout');


/*
|--------------------------------------------------------------------------
| AUTHENTICATED ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {


    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', function () {

        $role = auth()->user()->role;

        if ($role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($role === 'staff') {
            return redirect()->route('staff.dashboard');
        }

        if ($role === 'user') {
            return redirect()->route('customer.dashboard');
        }

        abort(403, 'Access Denied');

    })->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | ADMIN DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get('/admin/dashboard', function () {

        if (auth()->user()->role !== 'admin') {
            abort(403, 'Access Denied');
        }


        /*
        |--------------------------------------------------------------------------
        | ROOM COUNTS
        |--------------------------------------------------------------------------
        */

        $totalRooms = Room::count();

        $availableRooms = Room::where(
            'status',
            'available'
        )->count();


        /*
        |--------------------------------------------------------------------------
        | CUSTOMER COUNT
        |--------------------------------------------------------------------------
        */

        $totalCustomers = User::where(
            'role',
            'user'
        )->count();


        /*
        |--------------------------------------------------------------------------
        | BOOKING COUNTS
        |--------------------------------------------------------------------------
        */

        $totalBookings = Booking::count();

        $pendingBookings = Booking::where(
            'status',
            'pending'
        )->count();

        $approvedBookings = Booking::where(
            'status',
            'approved'
        )->count();

        $cancelledBookings = Booking::where(
            'status',
            'cancelled'
        )->count();


        /*
        |--------------------------------------------------------------------------
        | TOTAL REVENUE
        |--------------------------------------------------------------------------
        */

        $totalRevenue = Booking::where(
            'status',
            'approved'
        )->sum('total_price');


        /*
        |--------------------------------------------------------------------------
        | RECENT BOOKINGS
        |--------------------------------------------------------------------------
        */

        $recentBookings = Booking::with([
            'user',
            'room'
        ])
        ->latest()
        ->take(5)
        ->get();


        /*
        |--------------------------------------------------------------------------
        | WEATHER
        |--------------------------------------------------------------------------
        */

        $weather = null;

        $weatherError = null;

        try {

            $response = Http::timeout(10)->get(
                'https://api.open-meteo.com/v1/forecast',
                [
                    /*
                    |--------------------------------------------------------------------------
                    | MANILA LOCATION
                    |--------------------------------------------------------------------------
                    */

                    'latitude' => 14.6042,
                    'longitude' => 120.9822,

                    /*
                    |--------------------------------------------------------------------------
                    | WEATHER DATA
                    |--------------------------------------------------------------------------
                    */

                    'current' =>
                        'temperature_2m,relative_humidity_2m,weather_code,wind_speed_10m',

                    'temperature_unit' => 'celsius',

                    'wind_speed_unit' => 'ms',

                    'timezone' => 'Asia/Manila',
                ]
            );


                
            /*
            |--------------------------------------------------------------------------
            | CHECK WEATHER RESPONSE
            |--------------------------------------------------------------------------
            */

            if ($response->failed()) {

                $weatherError =
                    'Weather service is currently unavailable.';

            } else {

                $data = $response->json();


                /*
                |--------------------------------------------------------------------------
                | CHECK WEATHER DATA
                |--------------------------------------------------------------------------
                */

                if (
                    !isset($data['current']['temperature_2m']) ||
                    !isset($data['current']['relative_humidity_2m']) ||
                    !isset($data['current']['weather_code']) ||
                    !isset($data['current']['wind_speed_10m'])
                ) {

                    $weatherError =
                        'Weather data is unavailable.';

                } else {


                    /*
                    |--------------------------------------------------------------------------
                    | WEATHER CODE
                    |--------------------------------------------------------------------------
                    */

                    $weatherCode =
                        $data['current']['weather_code'];


                    /*
                    |--------------------------------------------------------------------------
                    | WEATHER CONDITION
                    |--------------------------------------------------------------------------
                    */

                    $condition = match (true) {

                        $weatherCode === 0 =>
                            'Clear sky',

                        in_array(
                            $weatherCode,
                            [1, 2, 3]
                        ) =>
                            'Partly cloudy',

                        in_array(
                            $weatherCode,
                            [45, 48]
                        ) =>
                            'Fog',

                        in_array(
                            $weatherCode,
                            [51, 53, 55]
                        ) =>
                            'Drizzle',

                        in_array(
                            $weatherCode,
                            [61, 63, 65]
                        ) =>
                            'Rain',

                        in_array(
                            $weatherCode,
                            [66, 67]
                        ) =>
                            'Freezing rain',

                        in_array(
                            $weatherCode,
                            [71, 73, 75, 77]
                        ) =>
                            'Snow',

                        in_array(
                            $weatherCode,
                            [80, 81, 82]
                        ) =>
                            'Rain showers',

                        in_array(
                            $weatherCode,
                            [85, 86]
                        ) =>
                            'Snow showers',

                        in_array(
                            $weatherCode,
                            [95, 96, 99]
                        ) =>
                            'Thunderstorm',

                        default =>
                            'Unknown weather condition',
                    };


                    /*
                    |--------------------------------------------------------------------------
                    | WEATHER INFORMATION
                    |--------------------------------------------------------------------------
                    */

                    $weather = [

                        /*
                        | LOCATION
                        */

                        'city' => 'Manila',

                        /*
                        | TEMPERATURE
                        */

                        'temperature' =>
                            $data['current']['temperature_2m'],

                        /*
                        | CONDITION
                        */

                        'condition' =>
                            $condition,

                        /*
                        | HUMIDITY
                        */

                        'humidity' =>
                            $data['current']['relative_humidity_2m'],

                        /*
                        | WIND SPEED
                        */

                        'wind_speed' =>
                            $data['current']['wind_speed_10m'],
                    ];
                }
            }

        } catch (\Throwable $e) {

            $weatherError =
                'Unable to connect to the weather service.';

        }


        /*
        |--------------------------------------------------------------------------
        | ADMIN DASHBOARD VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'admin.dashboard',
            compact(
                'totalRooms',
                'availableRooms',
                'totalCustomers',
                'totalBookings',
                'pendingBookings',
                'approvedBookings',
                'cancelledBookings',
                'totalRevenue',
                'recentBookings',
                'weather',
                'weatherError'
            )
        );

    })->name('admin.dashboard');


    /*
    |--------------------------------------------------------------------------
    | STAFF DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get('/staff/dashboard', function () {

        if (auth()->user()->role !== 'staff') {
            abort(403, 'Access Denied');
        }

        return view('staff_dashboard');

    })->name('staff.dashboard');


    /*
    |--------------------------------------------------------------------------
    | CUSTOMER DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get('/customer/dashboard', function () {

        if (auth()->user()->role !== 'user') {
            abort(403, 'Access Denied');
        }

        return view('customer.dashboard');

    })->name('customer.dashboard');


    /*
    |--------------------------------------------------------------------------
    | ADMIN MANAGEMENT
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:admin')->group(function () {


        /*
        |--------------------------------------------------------------------------
        | USER MANAGEMENT
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'users',
            UserController::class
        );


        /*
        |--------------------------------------------------------------------------
        | ROOM MANAGEMENT
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'rooms',
            RoomController::class
        );


        /*
        |--------------------------------------------------------------------------
        | APPROVE BOOKING
        |--------------------------------------------------------------------------
        */

        Route::post(
            '/bookings/{booking}/approve',
            [BookingController::class, 'approve']
        )->name('bookings.approve');


        /*
        |--------------------------------------------------------------------------
        | CANCEL BOOKING
        |--------------------------------------------------------------------------
        */

        Route::post(
            '/bookings/{booking}/cancel',
            [BookingController::class, 'cancel']
        )->name('bookings.cancel');

    });


    /*
    |--------------------------------------------------------------------------
    | BOOKINGS
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:admin,user')->group(function () {

        Route::resource(
            'bookings',
            BookingController::class
        );

    });


    /*
    |--------------------------------------------------------------------------
    | PAYMENTS
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:admin,user')->group(function () {


        /*
        | PAYMENT PAGE
        */

        Route::get(
            '/payments/{booking}/create',
            [
                PaymentController::class,
                'create'
            ]
        )->name('payments.create');


        /*
        | SAVE PAYMENT
        */

        Route::post(
            '/payments/{booking}',
            [
                PaymentController::class,
                'store'
            ]
        )->name('payments.store');

    });

});


/*
|--------------------------------------------------------------------------
| BREEZE AUTH ROUTES
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';