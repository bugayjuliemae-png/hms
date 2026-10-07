<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Staff Dashboard - Hotel Booking System</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f5f3ff;
            min-height: 100vh;
        }

        .header {
            background: linear-gradient(135deg, #6d5dfc, #8b7cff);
            color: white;
            padding: 20px 40px;
        }

        .header h2 {
            font-size: 24px;
        }

        .header p {
            margin-top: 5px;
            font-size: 14px;
        }

        .container {
            padding: 35px;
        }

        .welcome {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.07);
            margin-bottom: 25px;
        }

        .welcome h1 {
            color: #5143b8;
            margin-bottom: 10px;
        }

        .welcome p {
            color: #666;
            font-size: 15px;
        }

        .menu-title {
            color: #444;
            margin-bottom: 15px;
        }

        .menu {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            text-decoration: none;
            box-shadow: 0 5px 20px rgba(0,0,0,0.07);
            transition: 0.2s;
        }

        .card:hover {
            transform: translateY(-4px);
        }

        .icon {
            font-size: 35px;
            margin-bottom: 12px;
        }

        .card h3 {
            color: #5143b8;
            margin-bottom: 7px;
        }

        .card p {
            color: #777;
            font-size: 14px;
        }

        .logout {
            margin-top: 30px;
        }

        .logout button {
            background: #6d5dfc;
            color: white;
            border: none;
            padding: 11px 25px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
        }

        .logout button:hover {
            background: #5748d8;
        }

        @media (max-width: 700px) {
            .menu {
                grid-template-columns: 1fr;
            }

            .container {
                padding: 20px;
            }
        }
    </style>
</head>

<body>

    <div class="header">
        <h2>🏨 Hotel Booking System</h2>
        <p>Comfort • Quality • Service</p>
    </div>

    <div class="container">

        <div class="welcome">
            <h1>👨‍💼 Welcome Staff!</h1>

            <p>
                Welcome,
                <strong>{{ auth()->user()->name }}</strong>.
                You are logged in as a hotel staff member.
            </p>
        </div>

        <h2 class="menu-title">
            Staff Menu
        </h2>

        <div class="menu">

            <a href="{{ route('bookings.index') }}" class="card">
                <div class="icon">📋</div>

                <h3>Reservations</h3>

                <p>
                    View hotel reservations and booking information.
                </p>
            </a>

            <a href="{{ route('rooms.index') }}" class="card">
                <div class="icon">🛏️</div>

                <h3>Rooms</h3>

                <p>
                    View hotel rooms and their availability.
                </p>
            </a>

            <a href="{{ route('users.index') }}" class="card">
                <div class="icon">👤</div>

                <h3>Customers</h3>

                <p>
                    View customer information.
                </p>
            </a>

        </div>

        <div class="logout">

            <form method="POST" action="{{ route('logout') }}">

                @csrf

                <button type="submit">
                    Logout
                </button>

            </form>

        </div>

    </div>

</body>
</html>