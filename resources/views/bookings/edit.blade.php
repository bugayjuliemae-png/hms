<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Booking</title>

    <style>

        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            margin: 0;
            padding: 30px;
            background: #f1f3f6;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
        }

        h1 {
            color: #182433;
            margin-bottom: 10px;
        }

        .back {
            color: #182433;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-top: 15px;
            margin-bottom: 6px;
            font-weight: bold;
        }

        input,
        select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 15px;
        }

        button {
            width: 100%;
            margin-top: 25px;
            padding: 13px;
            background: #182433;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background: #2d4055;
        }

        .error {
            background: #f8d7da;
            color: #721c24;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 15px;
        }

    </style>

</head>

<body>

<div class="container">

    <h1>Edit Booking</h1>

    <a href="{{ route('bookings.index') }}" class="back">
        ← Back to Booking Management
    </a>


    @if($errors->any())

        <div class="error">

            @foreach($errors->all() as $error)

                <div>{{ $error }}</div>

            @endforeach

        </div>

    @endif


    <form
        action="{{ route('bookings.update', $booking->id) }}"
        method="POST"
    >

        @csrf
        @method('PUT')


        <label>Room</label>

        <select name="room_id" required>

            @foreach($rooms as $room)

                <option
                    value="{{ $room->id }}"
                    {{ $booking->room_id == $room->id ? 'selected' : '' }}
                >

                    Room {{ $room->room_number }}
                    -
                    {{ $room->room_type }}
                    -
                    ₱{{ number_format($room->price, 2) }}

                </option>

            @endforeach

        </select>


        <label>Check In</label>

        <input
            type="date"
            name="check_in"
            value="{{ $booking->check_in->format('Y-m-d') }}"
            required
        >


        <label>Check Out</label>

        <input
            type="date"
            name="check_out"
            value="{{ $booking->check_out->format('Y-m-d') }}"
            required
        >


        <label>Status</label>

        <select name="status" required>

            <option
                value="pending"
                {{ $booking->status == 'pending' ? 'selected' : '' }}
            >
                Pending
            </option>

            <option
                value="approved"
                {{ $booking->status == 'approved' ? 'selected' : '' }}
            >
                Approved
            </option>

            <option
                value="cancelled"
                {{ $booking->status == 'cancelled' ? 'selected' : '' }}
            >
                Cancelled
            </option>

        </select>


        <button type="submit">
            Update Booking
        </button>

    </form>

</div>

</body>

</html>