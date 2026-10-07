<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Staff Dashboard</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            min-height: 100vh;
            background: #f5f3ff;
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

        .content {
            min-height: calc(100vh - 90px);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .welcome-box {
            background: white;
            width: 500px;
            padding: 50px;
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
            margin-bottom: 15px;
        }

        .welcome-box p {
            color: #666;
            font-size: 16px;
        }

        .staff-name {
            margin-top: 18px;
            color: #6d5dfc;
            font-weight: bold;
            font-size: 18px;
        }

        .logout {
            margin-top: 25px;
        }

        .logout button {
            padding: 10px 25px;
            background: #6d5dfc;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <div class="header">
        <h2>🏨 Hotel Booking System</h2>
        <p>Comfort • Quality • Service</p>
    </div>

    <div class="content">

        <div class="welcome-box">

            <div class="icon">👨‍💼</div>

            <h1>Welcome Staff!</h1>

            <p>
                Welcome to the Hotel Booking System.
            </p>

            <div class="staff-name">
                {{ auth()->user()->name }}
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

    </div>

</body>
</html>