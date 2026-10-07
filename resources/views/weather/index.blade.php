<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Weather Dashboard</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #eef4ff;
        }

        .container {
            width: 90%;
            max-width: 900px;
            margin: 40px auto;
        }

        .back {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 18px;
            background: #2563eb;
            color: white;
            text-decoration: none;
            border-radius: 8px;
        }

        .title {
            text-align: center;
            color: #1e3a8a;
            margin-bottom: 25px;
        }

        .weather-card {
            background: white;
            border-radius: 18px;
            padding: 35px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.10);
        }

        .city {
            font-size: 30px;
            font-weight: bold;
            color: #1e3a8a;
        }

        .temperature {
            font-size: 55px;
            font-weight: bold;
            color: #2563eb;
            margin: 15px 0;
        }

        .condition {
            font-size: 22px;
            text-transform: capitalize;
            margin-bottom: 30px;
        }

        .information {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .box {
            background: #eff6ff;
            padding: 20px;
            border-radius: 12px;
        }

        .label {
            color: #64748b;
            font-size: 14px;
        }

        .value {
            font-size: 24px;
            font-weight: bold;
            color: #1e293b;
            margin-top: 8px;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
            padding: 25px;
            border-radius: 12px;
            text-align: center;
        }

    </style>

</head>

<body>

<div class="container">

    <a href="{{ route('dashboard') }}" class="back">
        ← Back to Dashboard
    </a>

    <h1 class="title">
        🌤️ Weather Dashboard
    </h1>

    @if($error)

        <div class="error">

            <h3>Weather Unavailable</h3>

            <p>{{ $error }}</p>

        </div>

    @elseif($weather)

        <div class="weather-card">

            <div class="city">
                📍 {{ $weather['city'] }}
            </div>

            <div class="temperature">
                {{ $weather['temperature'] }} °C
            </div>

            <div class="condition">
                {{ $weather['condition'] }}
            </div>

            <div class="information">

                <div class="box">

                    <div class="label">
                        💧 Humidity
                    </div>

                    <div class="value">
                        {{ $weather['humidity'] }}%
                    </div>

                </div>

                <div class="box">

                    <div class="label">
                        💨 Wind Speed
                    </div>

                    <div class="value">
                        {{ $weather['wind_speed'] }} m/s
                    </div>

                </div>

            </div>

        </div>

    @endif

</div>

</body>

</html>