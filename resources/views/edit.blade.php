<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Customer</title>

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
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
        }

        h1 {
            color: #182433;
            margin-bottom: 10px;
        }

        .back {
            color: #182433;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-top: 15px;
            margin-bottom: 6px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 15px;
        }

        button {
            width: 100%;
            margin-top: 25px;
            padding: 13px;
            background: #182433;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background: #2d4055;
        }

        .error {
            background: #f8d7da;
            color: #721c24;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Edit Customer</h1>

    <a href="{{ route('users.index') }}" class="back">
        ← Back to Customer Management
    </a>

    @if($errors->any())
        <div class="error">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form action="{{ route('users.update', $user->id) }}" method="POST">

        @csrf
        @method('PUT')

        <label>Full Name</label>

        <input
            type="text"
            name="name"
            value="{{ $user->name }}"
            required
        >

        <label>Email</label>

        <input
            type="email"
            name="email"
            value="{{ $user->email }}"
            required
        >

        <label>New Password</label>

        <input
            type="password"
            name="password"
            placeholder="Leave blank to keep current password"
        >

        <button type="submit">
            Update Customer
        </button>

    </form>

</div>

</body>
</html>