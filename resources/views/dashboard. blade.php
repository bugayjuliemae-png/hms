<!DOCTYPE html>
<html>
<head>
    <title>Hotel Booking and Reservation Management System</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f7fb;
        }

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 240px;
            height: 100vh;
            background: #17324d;
            color: white;
            padding: 25px 15px;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 35px;
        }

        .sidebar a,
        .logout {
            display: block;
            width: 100%;
            padding: 13px;
            margin-bottom: 10px;
            color: white;
            text-decoration: none;
            border: none;
            background: transparent;
            text-align: left;
            border-radius: 6px;
            cursor: pointer;
            font-size: 15px;
        }

        .sidebar a:hover,
        .logout:hover {
            background: #2d5275;
        }

        .main {
            margin-left: 240px;
            padding: 35px;
        }

        .header {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 2px 10px #ddd;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-top: 25px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 2px 10px #ddd;
        }

        .card h2 {
            margin-top: 0;
        }

        .welcome {
            color: #17324d;
        }

        .button {
            display: inline-block;
            background: #17324d;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 6px;
        }

        .button:hover {
            background: #2d5275;
        }
    </style>
</head>

<body>

<div class="sidebar">

    <h2>🏨 HOTEL HMS</h2>

    <a href="{{ route('dashboard') }}">
        🏠 Dashboard
    </a>

    <a href="{{ route('users.index') }}">
        👥 User Management
    </a>

    <a href="#">
        🛏️ Rooms
    </a>

    <a href="#">
        📅 Reservations
    </a>

    <a href="#">
        📊 Reports
    </a>

    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <button type="submit" class="logout">
            🚪 Logout
        </button>
    </form>

</div>

<div class="main">

    <div class="header">

        <h1 class="welcome">
            Welcome, {{ Auth::user()->name }}!
        </h1>

        <p>
            Role:
            <strong>{{ Auth::user()->role }}</strong>
        </p>

        <p>
            Welcome to the Hotel Booking and Reservation Management System.
        </p>

    </div>

    <div class="cards">

        <!-- USERS -->
        <div class="card">
            <h2>👥 Users</h2>

            <p>
                Manage hotel system users and their roles.
            </p>

            <a class="button" href="{{ route('users.index') }}">
                Manage Users
            </a>
        </div>

        <!-- ROOMS -->
        <div class="card">
            <h2>🛏️ Rooms</h2>

            <p>
                Manage hotel rooms, prices and availability.
            </p>
        </div>

        <!-- RESERVATIONS -->
        <div class="card">
            <h2>📅 Reservations</h2>

            <p>
                Manage customer hotel reservations.
            </p>
        </div>

        <!-- WEATHER -->
        <div class="card">
            <h2>🌤️ Weather</h2>

            <p>
                View current weather information from the external Weather API.
            </p>

            <a class="button" href="{{ route('weather') }}">
                View Weather
            </a>
        </div>

    </div>

</div>

</body>
</html>