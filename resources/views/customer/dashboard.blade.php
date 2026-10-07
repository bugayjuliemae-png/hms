<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>User Dashboard</title>

    <style>

        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            margin: 0;
            background: #f1f3f6;
        }

        .header {
            background: #182433;
            color: white;
            padding: 25px 35px;
        }

        .header h1 {
            margin: 0 0 5px;
        }

        .header p {
            margin: 0;
        }

        .container {
            max-width: 1100px;
            margin: 30px auto;
            padding: 0 20px;
        }

        .welcome {
            background: white;
            padding: 30px;
            border-radius: 10px;
            margin-bottom: 25px;
        }

        .welcome h2 {
            color: #182433;
            margin-top: 0;
        }

        .welcome p {
            color: #666;
        }

        .buttons {
            margin-top: 25px;
        }

        .button {
            display: inline-block;
            padding: 13px 20px;
            margin-right: 10px;
            margin-bottom: 10px;
            border-radius: 6px;
            text-decoration: none;
            color: white;
            background: #182433;
        }

        .button:hover {
            background: #2d4055;
        }

        .logout {
            display: inline-block;
            padding: 13px 20px;
            border: none;
            border-radius: 6px;
            background: #c0392b;
            color: white;
            cursor: pointer;
            font-size: 15px;
        }

        .info {
            background: white;
            padding: 30px;
            border-radius: 10px;
        }

        .info h2 {
            color: #182433;
            margin-top: 0;
        }

        .info p {
            color: #666;
            line-height: 1.6;
        }

    </style>

</head>

<body>


    <div class="header">

        <h1>
            Hotel Booking System
        </h1>

        <p>
            Customer Dashboard
        </p>

    </div>


    <div class="container">


        <div class="welcome">

            <h2>
                Welcome, {{ auth()->user()->name }}!
            </h2>

            <p>
                You are logged in as a customer.
            </p>


            <div class="buttons">

                <a
                    href="{{ route('bookings.create') }}"
                    class="button"
                >
                    🏨 Book / Reserve Room
                </a>


                <a
                    href="{{ route('bookings.index') }}"
                    class="button"
                >
                    📅 My Reservations
                </a>


                <form
                    method="POST"
                    action="{{ route('logout') }}"
                    style="display: inline;"
                >

                    @csrf

                    <button
                        type="submit"
                        class="logout"
                    >
                        🚪 Logout
                    </button>

                </form>

            </div>

        </div>


        <div class="info">

            <h2>
                Hotel Booking and Reservation Management System
            </h2>

            <p>
                You can book an available room and check the status
                of your reservation.
            </p>

            <p>
                Your reservation will be marked as
                <strong>Pending</strong>
                until the administrator approves it.
            </p>

            <p>
                Once approved by the administrator, your reservation
                will show an
                <strong>Approved</strong>
                status.
            </p>

        </div>


    </div>


</body>

</html>