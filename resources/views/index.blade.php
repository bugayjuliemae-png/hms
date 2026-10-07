<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>User Management - HMS</title>

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

            padding: 55px 20px;
        }

        .sidebar h2 {
            text-align: center;
            font-size: 30px;
            margin-bottom: 65px;
        }

        .menu {
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        .menu a {
            color: white;
            text-decoration: none;

            font-size: 18px;

            padding: 14px 20px;

            border-radius: 8px;

            display: block;
        }

        .menu a:hover {
            background: #263a52;
        }

        .menu .active {
            background: #263a52;
        }

        .logout {
            margin-top: 30px;
        }

        .logout button {
            width: 100%;

            background: #d63b2d;
            color: white;

            border: none;

            padding: 16px;

            border-radius: 8px;

            font-size: 17px;

            cursor: pointer;
        }

        .logout button:hover {
            background: #b92f23;
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

            font-size: 16px;
        }


        /* ADD USER */

        .add-box {
            background: white;

            padding: 30px;

            border-radius: 14px;

            margin-bottom: 25px;

            box-shadow: 0 3px 12px rgba(0,0,0,0.05);
        }

        .add-box h2 {
            color: #1769aa;

            font-size: 24px;

            margin-bottom: 22px;
        }

        .form-row {
            display: grid;

            grid-template-columns:
                repeat(2, 1fr);

            gap: 18px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;

            color: #333;

            font-size: 14px;

            font-weight: bold;

            margin-bottom: 7px;
        }

        .form-group input,
        .form-group select {
            width: 100%;

            height: 44px;

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

            box-shadow:
                0 0 0 3px rgba(23,105,170,0.10);
        }

        .role-group {
            max-width: 50%;
        }

        .save-button {
            background: #1769aa;

            color: white;

            border: none;

            padding: 12px 25px;

            border-radius: 8px;

            font-size: 14px;

            font-weight: bold;

            cursor: pointer;
        }

        .save-button:hover {
            background: #12588f;
        }


        /* MESSAGE */

        .success {
            background: #e9f8ef;

            border: 1px solid #b7dfc5;

            color: #18733c;

            padding: 13px 15px;

            border-radius: 8px;

            margin-bottom: 20px;
        }

        .error {
            background: #ffe9e9;

            border: 1px solid #ffb7b7;

            color: #b42318;

            padding: 13px 15px;

            border-radius: 8px;

            margin-bottom: 20px;
        }


        /* USER LIST */

        .user-list {
            background: white;

            padding: 30px;

            border-radius: 14px;

            box-shadow:
                0 3px 12px rgba(0,0,0,0.05);

            overflow-x: auto;
        }

        .user-list h2 {
            color: #142234;

            font-size: 26px;

            margin-bottom: 22px;
        }

        table {
            width: 100%;

            border-collapse: collapse;

            min-width: 850px;
        }

        th {
            background: #142234;

            color: white;

            padding: 15px;

            text-align: left;

            font-size: 14px;
        }

        td {
            padding: 15px;

            border-bottom: 1px solid #eeeeee;

            color: #333;

            font-size: 14px;
        }

        tr:hover {
            background: #f7faff;
        }


        /* ROLE */

        .role {
            display: inline-block;

            padding: 6px 13px;

            border-radius: 20px;

            font-size: 12px;

            font-weight: bold;
        }

        .role-admin {
            background: #e8f1ff;

            color: #1769aa;
        }

        .role-staff {
            background: #fff3d9;

            color: #9a6500;
        }

        .role-customer {
            background: #e8f8ed;

            color: #18733c;
        }


        /* ACTION */

        .actions {
            display: flex;

            gap: 8px;
        }

        .edit-button {
            background: #2474c7;

            color: white;

            text-decoration: none;

            padding: 8px 13px;

            border-radius: 6px;

            font-size: 12px;

            font-weight: bold;
        }

        .edit-button:hover {
            background: #185b9d;
        }

        .delete-button {
            background: #d63b2d;

            color: white;

            border: none;

            padding: 8px 13px;

            border-radius: 6px;

            font-size: 12px;

            font-weight: bold;

            cursor: pointer;
        }

        .delete-button:hover {
            background: #b92f23;
        }


        /* EMPTY */

        .empty {
            text-align: center;

            padding: 40px;

            color: #777;
        }


        /* MOBILE */

        @media (max-width: 800px) {

            .sidebar {
                position: relative;

                width: 100%;

                height: auto;

                padding: 25px 15px;
            }

            .sidebar h2 {
                margin-bottom: 25px;
            }

            .main {
                margin-left: 0;

                padding: 20px;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .role-group {
                max-width: 100%;
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

            <a
                href="{{ route('users.index') }}"
                class="active"
            >
                👥 User Management
            </a>

            <a href="{{ route('bookings.index') }}">
                📅 Reservation Management
            </a>


            <div class="logout">

                <form
                    method="POST"
                    action="{{ route('logout') }}"
                >

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
                👥 User Management
            </h1>

            <p>
                Add, edit, delete, and manage system users.
            </p>

        </div>


        <!-- SUCCESS -->

        @if (session('success'))

            <div class="success">

                {{ session('success') }}

            </div>

        @endif


        <!-- ERRORS -->

        @if ($errors->any())

            <div class="error">

                {{ $errors->first() }}

            </div>

        @endif


        <!-- ADD USER -->

        <div class="add-box">

            <h2>
                ➕ Add User
            </h2>


            <form
                method="POST"
                action="{{ route('users.store') }}"
            >

                @csrf


                <div class="form-row">


                    <!-- NAME -->

                    <div class="form-group">

                        <label for="name">
                            Full Name
                        </label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="Enter full name"
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
                            value="{{ old('email') }}"
                            placeholder="Enter email address"
                            required
                        >

                    </div>


                    <!-- PASSWORD -->

                    <div class="form-group">

                        <label for="password">
                            Password
                        </label>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Enter password"
                            required
                        >

                    </div>


                </div>


                <!-- ROLE -->

                <div class="form-group role-group">

                    <label for="role">
                        Select Role
                    </label>

                    <select
                        id="role"
                        name="role"
                        required
                    >

                        <option value="">
                            -- Select Role --
                        </option>

                        <option
                            value="user"
                            {{ old('role') == 'user' ? 'selected' : '' }}
                        >
                            Customer
                        </option>

                        <option
                            value="staff"
                            {{ old('role') == 'staff' ? 'selected' : '' }}
                        >
                            Staff
                        </option>

                        <option
                            value="admin"
                            {{ old('role') == 'admin' ? 'selected' : '' }}
                        >
                            Admin
                        </option>

                    </select>

                </div>


                <!-- SAVE -->

                <button
                    type="submit"
                    class="save-button"
                >
                    💾 Save User
                </button>

            </form>

        </div>


        <!-- USER LIST -->

        <div class="user-list">

            <h2>
                📋 User List
            </h2>


            @if ($users->count() > 0)

                <table>

                    <thead>

                        <tr>

                            <th>
                                ID
                            </th>

                            <th>
                                Name
                            </th>

                            <th>
                                Email
                            </th>

                            <th>
                                Role
                            </th>

                            <th>
                                Action
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach ($users as $user)

                            <tr>

                                <td>
                                    {{ $user->id }}
                                </td>


                                <td>
                                    <strong>
                                        {{ $user->name }}
                                    </strong>
                                </td>


                                <td>
                                    {{ $user->email }}
                                </td>


                                <td>

                                    @if ($user->role === 'admin')

                                        <span class="role role-admin">
                                            Admin
                                        </span>

                                    @elseif ($user->role === 'staff')

                                        <span class="role role-staff">
                                            Staff
                                        </span>

                                    @else

                                        <span class="role role-customer">
                                            Customer
                                        </span>

                                    @endif

                                </td>


                                <td>

                                    <div class="actions">


                                        <!-- EDIT -->

                                        <a
                                            href="{{ route('users.edit', $user->id) }}"
                                            class="edit-button"
                                        >
                                            ✏️ Edit
                                        </a>


                                        <!-- DELETE -->

                                        <form
                                            method="POST"
                                            action="{{ route('users.destroy', $user->id) }}"
                                            onsubmit="return confirm('Are you sure you want to delete {{ $user->name }}?');"
                                        >

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="delete-button"
                                            >
                                                🗑️ Delete
                                            </button>

                                        </form>


                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            @else

                <div class="empty">

                    <h3>
                        No Users Found
                    </h3>

                    <p>
                        Add a user using the form above.
                    </p>

                </div>

            @endif

        </div>


    </div>

</body>
</html>