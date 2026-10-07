<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Book Your Room</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #eef6ff, #dceeff);
            color: #333;
        }

        /* HEADER */
        .header {
            height: 68px;
            background: linear-gradient(135deg, #1769aa, #3f91e8);
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 35px;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.15);
        }

        .hotel-title {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .hotel-icon {
            font-size: 29px;
        }

        .hotel-title h2 {
            font-size: 20px;
        }

        .hotel-title p {
            font-size: 11px;
            margin-top: 2px;
            opacity: 0.9;
        }

        .dashboard-btn {
            text-decoration: none;
            color: white;
            background: rgba(255,255,255,0.15);
            border: 1px solid rgba(255,255,255,0.35);
            padding: 8px 16px;
            border-radius: 7px;
            font-size: 12px;
        }

        .dashboard-btn:hover {
            background: rgba(255,255,255,0.28);
        }

        /* MAIN */
        .main {
            min-height: calc(100vh - 68px);
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 18px;
        }

        .booking-card {
            width: 620px;
            max-width: 100%;
            background: white;
            border-radius: 15px;
            padding: 20px 25px;
            box-shadow: 0 8px 30px rgba(23,105,170,0.15);
        }

        /* TITLE */
        .page-title {
            text-align: center;
            margin-bottom: 15px;
        }

        .page-title .icon {
            font-size: 32px;
        }

        .page-title h1 {
            color: #1769aa;
            font-size: 24px;
            margin-top: 2px;
        }

        .page-title p {
            color: #777;
            font-size: 11px;
            margin-top: 3px;
        }

        /* SECTION */
        .section-title {
            background: #eef7ff;
            border-left: 4px solid #1769aa;
            padding: 8px 11px;
            border-radius: 6px;
            color: #1769aa;
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 12px;
        }

        /* FIELD */
        .field {
            width: 100%;
            margin-bottom: 10px;
        }

        label {
            display: block;
            font-size: 12px;
            font-weight: bold;
            color: #444;
            margin-bottom: 4px;
        }

        input,
        select {
            width: 100%;
            height: 36px;
            border: 1px solid #ccd9e8;
            border-radius: 7px;
            padding: 0 10px;
            font-size: 12px;
            outline: none;
            background: white;
        }

        input:focus,
        select:focus {
            border-color: #3f91e8;
            box-shadow: 0 0 0 2px rgba(63,145,232,0.10);
        }

        /* ROOM */
        .room-box {
            background: #f8fbff;
            border: 1px solid #d9e8f7;
            border-radius: 8px;
            padding: 8px;
        }

        .room-box select {
            height: 36px;
        }

        .available-note {
            margin-top: 4px;
            color: #159447;
            font-size: 10px;
        }

        /* TOTAL */
        .total-box {
            width: 100%;
            height: 58px;
            background: linear-gradient(135deg, #edf7ff, #f8fbff);
            border: 1px solid #cfe3f8;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 8px 13px;
        }

        .total-info strong {
            display: block;
            color: #1769aa;
            font-size: 12px;
            margin-bottom: 2px;
        }

        .total-info span {
            color: #777;
            font-size: 10px;
        }

        .total-price {
            color: #1769aa;
            font-size: 20px;
            font-weight: bold;
        }

        /* PAYMENT */
        .payment-box {
            background: #fffaf0;
            border: 1px solid #f2dfad;
            border-radius: 8px;
            padding: 8px;
        }

        .payment-note {
            color: #856404;
            font-size: 10px;
            margin-top: 4px;
        }

        /* ERRORS */
        .errors {
            background: #fff0f0;
            border: 1px solid #f2b8b8;
            color: #b42323;
            padding: 8px 11px;
            border-radius: 7px;
            font-size: 11px;
            margin-bottom: 10px;
        }

        .errors ul {
            padding-left: 17px;
        }

        /* BUTTONS */
        .buttons {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            margin-top: 13px;
            padding-top: 12px;
            border-top: 1px solid #e5e5e5;
        }

        .back-btn {
            text-decoration: none;
            background: #eef1f4;
            color: #555;
            padding: 10px 16px;
            border-radius: 7px;
            font-size: 11px;
            font-weight: bold;
        }

        .back-btn:hover {
            background: #e0e5e9;
        }

        .submit-btn {
            border: none;
            background: linear-gradient(135deg, #1769aa, #3f91e8);
            color: white;
            padding: 10px 18px;
            border-radius: 7px;
            font-size: 11px;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(23,105,170,0.20);
        }

        .submit-btn:hover {
            background: linear-gradient(135deg, #12588f, #287bc9);
        }

        .security {
            text-align: center;
            color: #888;
            font-size: 9px;
            margin-top: 8px;
        }

        /* MOBILE */
        @media (max-width: 600px) {

            .header {
                padding: 0 15px;
            }

            .hotel-title h2 {
                font-size: 16px;
            }

            .hotel-title p {
                display: none;
            }

            .dashboard-btn {
                padding: 7px 10px;
                font-size: 10px;
            }

            .main {
                padding: 10px;
            }

            .booking-card {
                padding: 17px;
            }

            .buttons {
                flex-direction: column;
            }

            .back-btn,
            .submit-btn {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>

<body>

    <!-- HEADER -->
    <div class="header">

        <div class="hotel-title">

            <div class="hotel-icon">
                🏨
            </div>

            <div>
                <h2>Hotel Booking System</h2>
                <p>Comfort • Quality • Service</p>
            </div>

        </div>

        <a
            href="{{ route('dashboard') }}"
            class="dashboard-btn"
        >
            ← Dashboard
        </a>

    </div>


    <!-- MAIN -->
    <div class="main">

        <div class="booking-card">

            <!-- TITLE -->
            <div class="page-title">

                <div class="icon">
                    📝
                </div>

                <h1>
                    Book Your Room
                </h1>

                <p>
                    Create a new hotel reservation quickly and easily
                </p>

            </div>


            <!-- ERRORS -->
            @if ($errors->any())

                <div class="errors">

                    <ul>

                        @foreach ($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif


            <!-- SECTION TITLE -->
            <div class="section-title">
                📋 Booking Information
            </div>


            <form
                action="{{ route('bookings.store') }}"
                method="POST"
            >

                @csrf


                <!-- CUSTOMER NAME -->
                <div class="field">

                    <label>
                        👤 Customer Name *
                    </label>

                    <input
                        type="text"
                        name="customer_name"
                        value="{{ old('customer_name', auth()->user()->name) }}"
                        placeholder="Enter customer name"
                        required
                    >

                </div>


                <!-- CONTACT NUMBER -->
                <div class="field">

                    <label>
                        📞 Contact Number *
                    </label>

                    <input
                        type="text"
                        name="contact_number"
                        value="{{ old('contact_number') }}"
                        placeholder="09XXXXXXXXX"
                        required
                    >

                </div>


                <!-- ROOM -->
                <div class="field">

                    <label>
                        🛏 Select Room *
                    </label>

                    <div class="room-box">

                        <select
                            name="room_id"
                            id="room_id"
                            required
                        >

                            <option value="">
                                -- Select Available Room --
                            </option>

                            @foreach ($rooms as $room)

                                <option
                                    value="{{ $room->id }}"
                                    data-price="{{ $room->price }}"
                                    {{ old('room_id') == $room->id ? 'selected' : '' }}
                                >
                                    Room {{ $room->room_number }}
                                    - {{ $room->room_type }}
                                    - ₱{{ number_format($room->price, 2) }}
                                </option>

                            @endforeach

                        </select>

                        <div class="available-note">
                            🟢 Choose an available room.
                        </div>

                    </div>

                </div>


                <!-- CHECK-IN -->
                <div class="field">

                    <label>
                        📅 Check-in Date *
                    </label>

                    <input
                        type="date"
                        name="check_in"
                        id="check_in"
                        value="{{ old('check_in') }}"
                        required
                    >

                </div>


                <!-- CHECK-OUT -->
                <div class="field">

                    <label>
                        📅 Check-out Date *
                    </label>

                    <input
                        type="date"
                        name="check_out"
                        id="check_out"
                        value="{{ old('check_out') }}"
                        required
                    >

                </div>


                <!-- TOTAL -->
                <div class="field">

                    <label>
                        💰 Estimated Total
                    </label>

                    <div class="total-box">

                        <div class="total-info">

                            <strong>
                                Estimated Price
                            </strong>

                            <span>
                                Room price × number of nights
                            </span>

                        </div>

                        <div
                            class="total-price"
                            id="totalPrice"
                        >
                            ₱0.00
                        </div>

                    </div>

                </div>


                <!-- PAYMENT -->
                <div class="field">

                    <label>
                        💳 Payment Method *
                    </label>

                    <div class="payment-box">

                        <select
                            name="payment_method"
                            required
                        >

                            <option value="">
                                -- Select Payment Method --
                            </option>

                            <option
                                value="gcash"
                                {{ old('payment_method') == 'gcash' ? 'selected' : '' }}
                            >
                                📱 GCash
                            </option>

                            <option
                                value="cash"
                                {{ old('payment_method') == 'cash' ? 'selected' : '' }}
                            >
                                💵 Cash
                            </option>

                            <option
                                value="bank_transfer"
                                {{ old('payment_method') == 'bank_transfer' ? 'selected' : '' }}
                            >
                                🏦 Bank Transfer
                            </option>

                        </select>

                        <div class="payment-note">
                            🔒 Payment verification will be done by the administrator.
                        </div>

                    </div>

                </div>


                <!-- BUTTONS -->
                <div class="buttons">

                    <a
                        href="{{ route('dashboard') }}"
                        class="back-btn"
                    >
                        ← Back to Dashboard
                    </a>

                    <button
                        type="submit"
                        class="submit-btn"
                    >
                        📤 Send Booking to Admin
                    </button>

                </div>


                <div class="security">
                    🔒 Your booking information is securely saved.
                </div>

            </form>

        </div>

    </div>


    <!-- CALCULATE TOTAL -->
    <script>

        const roomSelect = document.getElementById('room_id');
        const checkIn = document.getElementById('check_in');
        const checkOut = document.getElementById('check_out');
        const totalPrice = document.getElementById('totalPrice');


        function calculateTotal() {

            const selectedRoom =
                roomSelect.options[roomSelect.selectedIndex];

            const price =
                parseFloat(
                    selectedRoom?.dataset.price || 0
                );

            const start =
                new Date(checkIn.value);

            const end =
                new Date(checkOut.value);


            if (
                price > 0 &&
                checkIn.value &&
                checkOut.value &&
                end > start
            ) {

                const difference =
                    end.getTime() - start.getTime();

                const nights =
                    Math.ceil(
                        difference /
                        (1000 * 60 * 60 * 24)
                    );

                const total =
                    price * nights;

                totalPrice.textContent =
                    '₱' +
                    total.toLocaleString(
                        'en-PH',
                        {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        }
                    );

            } else {

                totalPrice.textContent = '₱0.00';

            }

        }


        roomSelect.addEventListener(
            'change',
            calculateTotal
        );

        checkIn.addEventListener(
            'change',
            calculateTotal
        );

        checkOut.addEventListener(
            'change',
            calculateTotal
        );


        calculateTotal();

    </script>

</body>
</html>