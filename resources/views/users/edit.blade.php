<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit User - HMS</title>

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #eef2f6;
            min-height: 100vh;
        }

        /* SIDEBAR */

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;

            width: 310px;
            height: 100vh;

            background: #142234;
            color: white;

            padding: 50px 20px;
        }

        .sidebar h2 {
            text-align: center;

            font-size: 30px;

            margin-bottom: 60px;
        }

        .menu {
            display: flex;

            flex-direction: column;

            gap: 15px;
        }

        .menu a {
            display: block;

            color: white;

            text-decoration: none;

            padding: 15px 20px;

            border-radius: 8px;

            font-size: 18px;
        }

        .menu a:hover,
        .menu a.active {
            background: #263a52;
        }

        .logout {
            margin-top: 25px;
        }

        .logout button {
            width: 100%;

            padding: 15px;

            border: none;

            border-radius: 8px;

            background: #d63b2d;

            color: white;

            font-size: 17px;

            cursor: pointer;
        }

        /* MAIN */

        .main {
            margin-left: 310px;

            padding: 40px;
        }

        /* TITLE */

        .title-box {
            background: white;

            padding: 30px;

            border-radius: 14px;

            margin-bottom: 25px;

            box-shadow: 0 3px 12px rgba(0,0,0,0.05);
        }

        .title-box h1 {
            color: #142234;

            font-size: 32px;

            margin-bottom: 8px;
        }

        .title-box p {
            color: #777;
        }

        /* EDIT BOX */

        .edit-box {
            background: white;

            width: 700px;

            max-width: 100%;

            padding: 35px;

            border-radius: 14px;

            box-shadow: 0 3px 12px rgba(0,0,0,0.05);
        }

        .edit-box h2 {
            color: #1769aa;

            font-size: 24px;

            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;

            color: #333;

            font-size: 14px;

            font-weight: bold;

            margin-bottom: 8px;
        }

        .form-group input,
        .form-group select {
            width: 100%;

            height: 45px;

            border: 1px solid #ccd6e0;

            border-radius: 8px;

            padding: 0 12px;

            font-size: 14px;

            outline: none;

            background: white;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #1769aa;
        }

        .note {
            color: #888;

            font-size: 12px;

            margin-top: 6px;
        }

        /* BUTTONS */

        .buttons {
            display: flex;

            gap: 10px;

            margin-top: 25px;
        }

        .update-button {
            background: #1769aa;

            color: white;

            border: none;

            padding: 12px 25px;

            border-radius: 8px;

            font-size: 14px;

            font-weight: bold;

            cursor: pointer;
        }

        .back-button {
            background: #6b7280;

            color: white;

            text-decoration: none;

            padding: 12px 25px;

            border-radius: 8px;

            font-size: 14px;

            font-weight: bold;
        }

        .error-box {
            background: #ffeaea;

            color: #b42318;

            border: 1px solid #ffb7b7;

            padding: 13px 15px;

            border-radius: 8px;

            margin-bottom: 20px;
        }

        @media (max-width: 800px) {

            .sidebar {
                position: relative;

                width: 100%;

                height: auto;

                padding: 25px 15px;
            }

            .main {
                margin-left: 0;

                padding: 20px;
            }

        }

    </style>

</head>

<body>


    <!-- SIDEBAR -->

    <div class="sidebar">

        <h2>
            HMS ADMIN
        </h2>

        <div class="menu">

            <a href="{{ route('dashboard') }}">
                🏠 Dashboard
            </a>

            <a href="{{ route('rooms.index') }}">
                🛏️ Room Management
            </a>

            <a href="{{ route('users.index') }}" class="active">
                👥 User Management
            </a>

            <a href="{{ route('bookings.index') }}">
                📅 Reservation Management
            </a>

            <div class="logout">

                <form method="POST" action="{{ route('logout') }}">

                    @csrf

                    <button type="submit">
                        🚪 Logout
                    </button>

                </form>

            </div>

        </div>

    </div>


    <!-- MAIN -->

    <div class="main">


        <!-- TITLE -->

        <div class="title-box">

            <h1>
                ✏️ Edit User
            </h1>

            <p>
                Update user information and role.
            </p>

        </div>


        <!-- ERRORS -->

        @if ($errors->any())

            <div class="error-box">

                {{ $errors->first() }}

            </div>

        @endif


        <!-- EDIT FORM -->

        <div class="edit-box">

            <h2>
                Edit User Information
            </h2>


            <form
                method="POST"
                action="{{ route('users.update', $user->id) }}"
            >

                @csrf

                @method('PUT')


                <!-- NAME -->

                <div class="form-group">

                    <label for="name">
                        Full Name
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name', $user->name) }}"
                        required
                    >

                </div>


                <!-- EMAIL -->

                <div class="form-group">

                    <label for="email">
                        Email Address
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email', $user->email) }}"
                        required
                    >

                </div>


                <!-- PASSWORD -->

                <div class="form-group">

                    <label for="password">
                        New Password
                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Leave blank to keep current password"
                    >

                    <div class="note">
                        Leave blank if you do not want to change the password.
                    </div>

                </div>


                <!-- ROLE -->

                <div class="form-group">

                    <label for="role">
                        Select Role
                    </label>

                    <select
                        id="role"
                        name="role"
                        required
                    >

                        <option
                            value="user"
                            {{ old('role', $user->role) == 'user' ? 'selected' : '' }}
                        >
                            Customer
                        </option>

                        <option
                            value="staff"
                            {{ old('role', $user->role) == 'staff' ? 'selected' : '' }}
                        >
                            Staff
                        </option>

                        <option
                            value="admin"
                            {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}
                        >
                            Admin
                        </option>

                    </select>

                </div>


                <!-- BUTTONS -->

                <div class="buttons">

                    <button
                        type="submit"
                        class="update-button"
                    >
                        💾 Update User
                    </button>

                    <a
                        href="{{ route('users.index') }}"
                        class="back-button"
                    >
                        ← Back to User Management
                    </a>

                </div>

            </form>

        </div>

    </div>

</body>

</html>