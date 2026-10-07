<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Dashboard - HMS</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #eef3f8;
            color: #172235;
        }

        /* =========================
           SIDEBAR
        ========================= */

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;

            width: 380px;
            height: 100vh;

            background: #142438;
            color: white;

            padding: 55px 25px 25px 25px;

            display: flex;
            flex-direction: column;

            overflow-y: auto;
        }

        .sidebar h1 {
            text-align: center;

            font-size: 36px;

            margin: 0 0 55px 0;

            flex-shrink: 0;
        }

        /* MENU AREA */

        .menu-container {
            flex: 1;
        }

        .menu {
            display: block;

            width: 100%;

            padding: 18px 28px;

            margin-bottom: 12px;

            color: white;

            text-decoration: none;

            font-size: 25px;

            border-radius: 10px;
        }

        .menu:hover {
            background: #243b55;
        }

        /* =========================
           LOGOUT
        ========================= */

        .logout-area {
            width: 100%;

            margin-top: 20px;

            flex-shrink: 0;
        }

        .logout-button {
            width: 100%;

            padding: 18px;

            background: #e4382c;

            color: white;

            border: none;

            border-radius: 10px;

            font-size: 24px;

            cursor: pointer;
        }

        .logout-button:hover {
            background: #c92d23;
        }

        /* =========================
           MAIN
        ========================= */

        .main {
            margin-left: 380px;

            padding: 50px;

            min-height: 100vh;
        }

        /* =========================
           HEADER
        ========================= */

        .header {
            background: white;

            padding: 40px;

            border-radius: 22px;

            box-shadow: 0 5px 20px rgba(0,0,0,0.08);

            margin-bottom: 35px;
        }

        .header h2 {
            margin: 0 0 15px 0;

            font-size: 45px;
        }

        .header p {
            margin: 8px 0;

            font-size: 23px;

            color: #777;
        }

        /* =========================
           CARDS
        ========================= */

        .cards {
            display: grid;

            grid-template-columns: repeat(4, 1fr);

            gap: 25px;
        }

        .card {
            background: white;

            min-height: 190px;

            padding: 30px;

            border-radius: 20px;

            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        }

        .card h3 {
            margin: 0 0 25px 0;

            color: #666;

            font-size: 23px;
        }

        .number {
            font-size: 45px;

            font-weight: bold;
        }

        .money {
            font-size: 38px;

            font-weight: bold;
        }

        .pending {
            border-left: 8px solid #f5a400;
        }

        .approved {
            border-left: 8px solid #22ad63;
        }

        .cancelled {
            border-left: 8px solid #e4382c;
        }

        .revenue {
            border-left: 8px solid #2388c5;
        }

        /* =========================
           WEATHER
        ========================= */

        .weather-card {
            margin-top: 35px;

            background: white;

            padding: 35px;

            border-radius: 20px;

            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        }

        .weather-card h2 {
            margin: 0;

            font-size: 32px;
        }

        .weather-grid {
            display: grid;

            grid-template-columns: repeat(5, 1fr);

            gap: 15px;

            margin-top: 25px;
        }

        .weather-item {
            background: #f4f8fc;

            padding: 22px;

            border-radius: 12px;

            cursor: default;

            pointer-events: none;

            user-select: none;
        }

        .weather-item strong {
            display: block;

            color: #68778a;

            margin-bottom: 10px;

            font-size: 16px;
        }

        .weather-item span {
            display: block;

            font-size: 22px;

            font-weight: bold;

            line-height: 1.3;
        }

        .weather-error {
            margin-top: 20px;

            background: #ffe6e6;

            padding: 20px;

            border-radius: 10px;

            color: #a00000;
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 1200px) {

            .sidebar {
                width: 280px;
            }

            .main {
                margin-left: 280px;
            }

            .cards {
                grid-template-columns: repeat(2, 1fr);
            }

            .weather-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 700px) {

            .sidebar {
                position: relative;

                width: 100%;

                height: auto;

                min-height: auto;
            }

            .main {
                margin-left: 0;

                padding: 20px;
            }

            .cards {
                grid-template-columns: 1fr;
            }

            .weather-grid {
                grid-template-columns: 1fr;
            }

            .menu-container {
                flex: none;
            }

            .logout-area {
                margin-top: 20px;
            }
        }

    </style>

</head>

<body>


<!-- =========================
     SIDEBAR
========================= -->

<div class="sidebar">

    <h1>
        HMS ADMIN
    </h1>


    <!-- MENU CONTAINER -->

    <div class="menu-container">

        <a href="{{ route('admin.dashboard') }}" class="menu">
            🏠 Dashboard
        </a>


        <a href="{{ route('rooms.index') }}" class="menu">
            🛏️ Room Management
        </a>


        <a href="{{ route('users.index') }}" class="menu">
            👥 User Management
        </a>


        <a href="/admin/reservations" class="menu">
            📅 Reservation Management
        </a>

    </div>


    <!-- LOGOUT -->

    <div class="logout-area">

        <form method="POST" action="{{ route('logout') }}">

            @csrf

            <button
                type="submit"
                class="logout-button"
            >
                🚪 Logout
            </button>

        </form>

    </div>

</div>


<!-- =========================
     MAIN CONTENT
========================= -->

<div class="main">


    <!-- HEADER -->

    <div class="header">

        <h2>
            Admin Dashboard
        </h2>

        <p>
            Welcome,
            {{ Auth::user()->name ?? 'Admin' }}!
        </p>

        <p>
            Role:
            {{ Auth::user()->role ?? 'Administrator' }}
        </p>

    </div>


    <!-- =========================
         DASHBOARD CARDS
    ========================= -->

    <div class="cards">


        <div class="card">

            <h3>
                Total Rooms
            </h3>

            <div class="number">
                {{ $totalRooms ?? 0 }}
            </div>

        </div>


        <div class="card">

            <h3>
                Available Rooms
            </h3>

            <div class="number">
                {{ $availableRooms ?? 0 }}
            </div>

        </div>


        <div class="card">

            <h3>
                Total Customers
            </h3>

            <div class="number">
                {{ $totalCustomers ?? 0 }}
            </div>

        </div>


        <div class="card">

            <h3>
                Total Reservations
            </h3>

            <div class="number">
                {{ $totalBookings ?? 0 }}
            </div>

        </div>


        <div class="card pending">

            <h3>
                Pending Reservations
            </h3>

            <div class="number">
                {{ $pendingBookings ?? 0 }}
            </div>

        </div>


        <div class="card approved">

            <h3>
                Approved Reservations
            </h3>

            <div class="number">
                {{ $approvedBookings ?? 0 }}
            </div>

        </div>


        <div class="card cancelled">

            <h3>
                Cancelled Reservations
            </h3>

            <div class="number">
                {{ $cancelledBookings ?? 0 }}
            </div>

        </div>


        <div class="card revenue">

            <h3>
                Total Revenue
            </h3>

            <div class="money">
                ₱{{ number_format($totalRevenue ?? 0, 2) }}
            </div>

        </div>

    </div>


    <!-- =========================
         WEATHER
    ========================= -->

    <div class="weather-card">

        <h2>
             Current Weather Dashboard🌤️
        </h2>


        @if(isset($weather) && is_array($weather))

            <div class="weather-grid">


                <div class="weather-item">

                    <strong>
                        📍 Location
                    </strong>

                    <span>
                        {{ $weather['city'] }}
                    </span>

                </div>


                <div class="weather-item">

                    <strong>
                        🌡️ Temperature
                    </strong>

                    <span>
                        {{ $weather['temperature'] }} °C
                    </span>

                </div>


                <div class="weather-item">

                    <strong>
                        ☁️ Condition
                    </strong>

                    <span>
                        {{ $weather['condition'] }}
                    </span>

                </div>


                <div class="weather-item">

                    <strong>
                        💧 Humidity
                    </strong>

                    <span>
                        {{ $weather['humidity'] }}%
                    </span>

                </div>


                <div class="weather-item">

                    <strong>
                        💨 Wind Speed
                    </strong>

                    <span>
                        {{ $weather['wind_speed'] }} m/s
                    </span>

                </div>


            </div>

        @else

            <div class="weather-error">

                ⚠️ Weather information is currently unavailable.

                <br><br>

                {{ $weatherError ?? '' }}

            </div>

        @endif

    </div>

</div>


</body>

</html>