<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Payment</title>

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
            max-width: 650px;
            margin: auto;
        }

        .box {
            background: white;
            padding: 30px;
            border-radius: 12px;
        }

        h1 {
            margin-top: 0;
            color: #182433;
        }

        .reservation {
            background: #f5f7fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 25px;
        }

        .reservation p {
            margin: 8px 0;
        }

        .amount {
            font-size: 28px;
            font-weight: bold;
            color: #182433;
            margin-top: 15px;
        }

        label {
            display: block;
            margin-top: 18px;
            margin-bottom: 7px;
            font-weight: bold;
        }

        select,
        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 15px;
        }

        .gcash-box {
            display: none;
            background: #eef3f8;
            padding: 18px;
            border-radius: 8px;
            margin-top: 15px;
        }

        .gcash-box h3 {
            margin-top: 0;
            color: #182433;
        }

        .gcash-box p {
            margin: 7px 0;
        }

        .error {
            background: #f8d7da;
            color: #721c24;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .pay-button {
            width: 100%;
            margin-top: 25px;
            padding: 14px;
            background: #182433;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
        }

        .pay-button:hover {
            background: #2d4055;
        }

        .back {
            display: inline-block;
            margin-top: 20px;
            color: #182433;
            text-decoration: none;
        }

    </style>

</head>

<body>

<div class="container">

    <div class="box">

        <h1>
            💳 Payment
        </h1>

        @if($errors->any())

            <div class="error">

                @foreach($errors->all() as $error)

                    <div>
                        {{ $error }}
                    </div>

                @endforeach

            </div>

        @endif


        <div class="reservation">

            <h3>
                Reservation Details
            </h3>

            <p>
                <strong>Customer:</strong>
                {{ $booking->user->name }}
            </p>

            <p>
                <strong>Room:</strong>
                Room {{ $booking->room->room_number }}
            </p>

            <p>
                <strong>Check In:</strong>
                {{ $booking->check_in->format('M d, Y') }}
            </p>

            <p>
                <strong>Check Out:</strong>
                {{ $booking->check_out->format('M d, Y') }}
            </p>

            <p>
                <strong>Reservation Status:</strong>
                ✅ Approved
            </p>

            <div class="amount">
                ₱{{ number_format($booking->total_price, 2) }}
            </div>

        </div>


        <form
            method="POST"
            action="{{ route('payments.store', $booking->id) }}"
        >

            @csrf


            <label for="payment_method">
                Payment Method
            </label>

            <select
                name="payment_method"
                id="payment_method"
                required
                onchange="showPaymentInfo()"
            >

                <option value="">
                    Select Payment Method
                </option>

                <option value="gcash">
                    GCash
                </option>

                <option value="cash">
                    Cash
                </option>

                <option value="bank_transfer">
                    Bank Transfer
                </option>

            </select>


            <div
                id="gcashInfo"
                class="gcash-box"
            >

                <h3>
                    GCash Payment
                </h3>

                <p>
                    Send your payment to:
                </p>

                <p>
                    <strong>GCash Name:</strong>
                    HMS Hotel
                </p>

                <p>
                    <strong>GCash Number:</strong>
                    09XX-XXX-XXXX
                </p>

                <p>
                    <strong>Amount:</strong>
                    ₱{{ number_format($booking->total_price, 2) }}
                </p>

                <p>
                    After payment, enter your GCash reference number below.
                </p>

            </div>


            <label for="payment_reference">
                Payment Reference Number
            </label>

            <input
                type="text"
                name="payment_reference"
                id="payment_reference"
                placeholder="Enter GCash or bank reference number"
            >


            <button
                type="submit"
                class="pay-button"
            >
                Submit Payment
            </button>

        </form>


        <a
            href="{{ route('bookings.index') }}"
            class="back"
        >
            ← Back to My Reservations
        </a>

    </div>

</div>


<script>

function showPaymentInfo()
{
    const method =
        document.getElementById('payment_method').value;

    const gcashInfo =
        document.getElementById('gcashInfo');

    const reference =
        document.getElementById('payment_reference');

    if (method === 'gcash') {

        gcashInfo.style.display = 'block';

        reference.required = true;

    } else {

        gcashInfo.style.display = 'none';

        reference.required = false;

    }
}

</script>

</body>

</html>