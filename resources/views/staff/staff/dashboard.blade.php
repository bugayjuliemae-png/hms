<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Welcome Staff - Hotel Booking System</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #f3efff, #faf9ff);
        }

        .header {
            background: linear-gradient(135deg, #6d5dfc, #8b7cff);
            color: white;
            padding: 22px 40px;
        }

        .header h2 {
            font-size: 24px;
        }

        .header p {
            margin-top: 5px;
            font-size: 14px;
        }

        .container {
            min-height: calc(100vh - 90px);
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 25px;
        }

        .welcome-box {
            width: 100%;
            max-width: 550px;
            background: white;
            padding: 45px;
            border-radius: 18px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        }

        .icon {
            font-size: 60px;
            margin-bottom: 15px;
        }

        .welcome-box h1 {
            color: #5143b8;
            font-size: 32px;
            margin-bottom: 12px;
        }

        .welcome-box p {
            color: #666;
            font-size: 16px;
            line-height: 1.6;
        }

        .staff-name {
            margin-top: 20px;
            color: #6d5dfc;
            font-size: 19px;
            font-weight: bold;
        }

        .logout {
            margin-top: 25px;
            padding: 11px 28px;
            background: #6d5dfc;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
        }

        .logout:hover {
            background: #5748d8;
        }
    </style>
</head>

<body>

    <div class="header">
        <h2>🏨 Hotel Booking System</h2>
        <p>Comfort • Quality • Service</p>
    </div>

    <div class="container">

        <div class="welcome-box">

            <div class="icon">
                👨‍💼
            </div>

            <h1>
                Welcome Staff!
            </h1>

            <p>
                Welcome to the Hotel Booking System.
                You are now logged in as a staff member.
            </p>

            <div class="staff-name">
                {{ auth()->user()->name }}
            </div>

            <form method="POST" action="{{ route('logout') }}">

                @csrf

                <button type="submit" class="logout">
                    Logout
                </button>

            </form>

        </div>

    </div>

</body>
</html>