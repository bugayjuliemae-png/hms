<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>User Management</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f3f8ff;
            min-height: 100vh;
        }

        .header {
            background: linear-gradient(135deg, #1769aa, #3f91e8);
            color: white;
            padding: 18px 40px;
        }

        .header h2 {
            font-size: 23px;
        }

        .header p {
            margin-top: 4px;
            font-size: 13px;
        }

        .container {
            width: 90%;
            max-width: 1050px;
            margin: 30px auto;
        }

        .top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .top h1 {
            color: #1769aa;
            font-size: 27px;
        }

        .add-button {
            background: #1769aa;
            color: white;
            border: none;
            text-decoration: none;
            padding: 10px 18px;
            border-radius: 7px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
        }

        .add-button:hover {
            background: #12558c;
        }

        .success {
            background: #d4edda;
            color: #155724;
            padding: 11px;
            border-radius: 7px;
            margin-bottom: 18px;
            font-size: 14px;
        }

        .error-box {
            background: #f8d7da;
            color: #721c24;
            padding: 11px;
            border-radius: 7px;
            margin-bottom: 18px;
            font-size: 14px;
        }

        /* ADD USER FORM */

        .add-form-box {
            display: none;
            width: 650px;
            max-width: 100%;
            margin: 0 auto 22px auto;
            background: white;
            padding: 25px 30px;
            border-radius: 12px;
            box-shadow: 0 5px 18px rgba(0,0,0,0.08);
        }

        .add-form-box.show {
            display: block;
        }

        .add-form-box h2 {
            color: #1769aa;
            font-size: 23px;
            margin-bottom: 18px;
        }

        .form-group {
            margin-bottom: 13px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
            font-size: 14px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            height: 40px;
            padding: 8px 11px;
            border: 1px solid #cfcfcf;
            border-radius: 6px;
            font-size: 14px;
            outline: none;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #1769aa;
        }

        .form-buttons {
            display: flex;
            gap: 8px;
            margin-top: 18px;
        }

        .save-button {
            background: #1769aa;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
        }

        .save-button:hover {
            background: #12558c;
        }

        .cancel-button {
            background: #777;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
        }

        .cancel-button:hover {
            background: #555;
        }

        /* TABLE */

        .table-box {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 18px rgba(0,0,0,0.08);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #1769aa;
            color: white;
            padding: 12px;
            text-align: left;
            font-size: 14px;
        }

        td {
            padding: 11px 12px;
            border-bottom: 1px solid #eee;
            font-size: 14px;
        }

        tr:hover {
            background: #f7fbff;
        }

        .role {
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: bold;
        }

        .customer {
            background: #e3f2fd;
            color: #1769aa;
        }

        .staff {
            background: #fff3cd;
            color: #856404;
        }

        .admin {
            background: #f8d7da;
            color: #721c24;
        }

        .actions {
            display: flex;
            gap: 6px;
        }

        .edit-button {
            background: #3f91e8;
            color: white;
            text-decoration: none;
            padding: 6px 10px;
            border-radius: 5px;
            font-size: 12px;
        }

        .delete-button {
            background: #dc3545;
            color: white;
            border: none;
            padding: 6px 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 12px;
        }

        .empty {
            text-align: center;
            padding: 30px;
            color: #777;
        }

        .back {
            display: inline-block;
            margin-top: 20px;
            color: #1769aa;
            text-decoration: none;
            font-weight: bold;
            font-size: 14px;
        }

        @media (max-width: 700px) {

            .container {
                width: 95%;
            }

            .top {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }

            .add-form-box {
                width: 100%;
                padding: 20px;
            }

            .table-box {
                overflow-x: auto;
            }

            table {
                min-width: 700px;
            }
        }
    </style>
</head>

<body>

    <div class="header">

        <h2>🏨 Hotel Booking System</h2>

        <p>User Management</p>

    </div>


    <div class="container">

        <div class="top">

            <h1>👥 User Management</h1>

            <button
                type="button"
                class="add-button"
                onclick="showAddUser()"
            >
                ➕ Add User
            </button>

        </div>


        @if(session('success'))

            <div class="success">
                {{ session('success') }}
            </div>

        @endif


        @if($errors->any())

            <div class="error-box">

                @foreach($errors->all() as $error)

                    <div>{{ $error }}</div>

                @endforeach

            </div>

        @endif


        <!-- ADD USER FORM -->

        <div
            id="addUserForm"
            class="add-form-box"
        >

            <h2>➕ Add New User</h2>


            <form
                method="POST"
                action="{{ route('users.store') }}"
            >

                @csrf


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


                <div class="form-group">

                    <label for="email">
                        Gmail
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="example@gmail.com"
                        required
                    >

                </div>


                <div class="form-group">

                    <label for="password">
                        Password
                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Enter password"
                        minlength="8"
                        required
                    >

                </div>


                <div class="form-group">

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

                        <option value="user">
                            Customer
                        </option>

                        <option value="staff">
                            Staff
                        </option>

                        <option value="admin">
                            Admin
                        </option>

                    </select>

                </div>


                <div class="form-buttons">

                    <button
                        type="submit"
                        class="save-button"
                    >
                        💾 Save User
                    </button>


                    <button
                        type="button"
                        class="cancel-button"
                        onclick="hideAddUser()"
                    >
                        Cancel
                    </button>

                </div>

            </form>

        </div>


        <!-- USER TABLE -->

        <div class="table-box">

            @if($users->count() > 0)

                <table>

                    <thead>

                        <tr>

                            <th>ID</th>

                            <th>Full Name</th>

                            <th>Gmail</th>

                            <th>Role</th>

                            <th>Action</th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach($users as $user)

                            <tr>

                                <td>
                                    {{ $user->id }}
                                </td>

                                <td>
                                    {{ $user->name }}
                                </td>

                                <td>
                                    {{ $user->email }}
                                </td>

                                <td>

                                    @if($user->role === 'admin')

                                        <span class="role admin">
                                            Admin
                                        </span>

                                    @elseif($user->role === 'staff')

                                        <span class="role staff">
                                            Staff
                                        </span>

                                    @else

                                        <span class="role customer">
                                            Customer
                                        </span>

                                    @endif

                                </td>

                                <td>

                                    <div class="actions">

                                        <a
                                            href="{{ route('users.edit', $user->id) }}"
                                            class="edit-button"
                                        >
                                            ✏️ Edit
                                        </a>


                                        <form
                                            method="POST"
                                            action="{{ route('users.destroy', $user->id) }}"
                                            onsubmit="return confirm('Are you sure you want to delete this user?');"
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
                    No users found.
                </div>

            @endif

        </div>


        <a
            href="{{ route('dashboard') }}"
            class="back"
        >
            ← Back to Dashboard
        </a>

    </div>


    <script>

        function showAddUser() {

            document
                .getElementById('addUserForm')
                .classList.add('show');

            document
                .getElementById('name')
                .focus();

        }


        function hideAddUser() {

            document
                .getElementById('addUserForm')
                .classList.remove('show');

        }

    </script>

</body>
</html>