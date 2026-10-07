<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>403 Access Denied</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            min-height: 100vh;
            background: #f3f8ff;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .error-box {
            width: 500px;
            max-width: 90%;
            background: white;
            padding: 45px;
            border-radius: 18px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.10);
        }

        .icon {
            font-size: 65px;
            margin-bottom: 15px;
        }

        .code {
            font-size: 55px;
            font-weight: bold;
            color: #1769aa;
            margin-bottom: 10px;
        }

        h1 {
            font-size: 25px;
            color: #333;
            margin-bottom: 12px;
        }

        p {
            color: #666;
            font-size: 15px;
            line-height: 1.6;
        }

        .user-role {
            margin-top: 15px;
            color: #1769aa;
            font-weight: bold;
        }

        .back-button {
            display: inline-block;
            margin-top: 25px;
            padding: 12px 28px;
            background: #1769aa;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 14px;
        }

        .back-button:hover {
            background: #125789;
        }
    </style>
</head>

<body>

    <div class="error-box">

        <div class="icon">🔒</div>

        <div class="code">403</div>

        <h1>Access Denied</h1>

        <p>
            You are not authorized to access this page.
        </p>

        @auth
            <div class="user-role">
                Your role: {{ ucfirst(auth()->user()->role) }}
            </div>
        @endauth

        <a href="{{ route('dashboard') }}" class="back-button">
            ← Back to Dashboard
        </a>

    </div>

</body>
</html>