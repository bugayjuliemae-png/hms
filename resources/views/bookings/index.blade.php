<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Reservation Management</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f6fb;
            color: #1f2937;
        }

        .header {
            background: linear-gradient(135deg, #4338ca, #6366f1);
            color: white;
            padding: 18px 35px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo-icon {
            font-size: 28px;
        }

        .logo h2 {
            margin: 0;
            font-size: 21px;
        }

        .dashboard-btn {
            background: white;
            color: #4338ca;
            padding: 10px 16px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
        }

        .container {
            max-width: 1450px;
            margin: 35px auto;
            padding: 0 20px 50px;
        }

        .top-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .title h1 {
            margin: 0;
            color: #312e81;
            font-size: 29px;
        }

        .title p {
            margin: 7px 0 0;
            color: #6b7280;
        }

        .add-btn {
            background: #4338ca;
            color: white;
            padding: 12px 18px;
            border-radius: 9px;
            text-decoration: none;
            font-weight: bold;
        }

        .success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
            padding: 14px;
            border-radius: 9px;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
            padding: 14px;
            border-radius: 9px;
            margin-bottom: 20px;
        }

        .table-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 8px 30px rgba(0,0,0,.08);
        }

        .table-header {
            padding: 20px 24px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
        }

        .table-header h3 {
            margin: 0;
        }

        .table-header span {
            color: #6b7280;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 1200px;
        }

        th {
            background: #f8fafc;
            padding: 15px;
            text-align: left;
            font-size: 13px;
            color: #4b5563;
        }

        td {
            padding: 16px 15px;
            border-bottom: 1px solid #eef0f3;
            vertical-align: middle;
            font-size: 14px;
        }

        tr:hover td {
            background: #fafbff;
        }

        .customer-name {
            font-weight: bold;
            color: #111827;
        }

        .email {
            font-size: 12px;
            color: #9ca3af;
            margin-top: 3px;
        }

        .room {
            font-weight: bold;
            color: #312e81;
        }

        .room-type {
            font-size: 12px;
            color: #6b7280;
            margin-top: 3px;
        }

        .total {
            font-weight: bold;
            color: #166534;
            white-space: nowrap;
        }

        .badge {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
        }

        .pending {
            background: #fef3c7;
            color: #92400e;
        }

        .approved {
            background: #dcfce7;
            color: #166534;
        }

        .cancelled {
            background: #fee2e2;
            color: #991b1b;
        }

        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            min-width: 230px;
        }

        .btn {
            border: none;
            padding: 8px 11px;
            border-radius: 7px;
            color: white;
            text-decoration: none;
            font-size: 12px;
            font-weight: bold;
            cursor: pointer;
            display: inline-block;
        }

        .approve-btn {
            background: #16a34a;
        }

        .cancel-btn {
            background: #dc2626;
        }

        .edit-btn {
            background: #2563eb;
        }

        .delete-btn {
            background: #ef4444;
        }

        .pay-btn {
            background: #7c3aed;
        }

        .waiting {
            background: #fef3c7;
            color: #92400e;
            padding: 7px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
        }

        .empty {
            text-align: center;
            padding: 70px 20px;
        }

        .empty-icon {
            font-size: 55px;
        }

    </style>

</head>


<body>


<div class="header">

    <div class="logo">

        <div class="logo-icon">
            🏨
        </div>

        <h2>
            Hotel Booking System
        </h2>

    </div>


    <a
        href="{{ route('dashboard') }}"
        class="dashboard-btn"
    >
        ← Dashboard
    </a>

</div>


<div class="container">


    <div class="top-section">

        <div class="title">

            <h1>

                {{ auth()->user()->role === 'admin'
                    ? '📋 Reservation Management'
                    : '📋 My Reservations' }}

            </h1>

            <p>
                {{ auth()->user()->role === 'admin'
                    ? 'Manage all customer reservations.'
                    : 'Manage your hotel reservations.' }}
            </p>

        </div>


        <a
            href="{{ route('bookings.create') }}"
            class="add-btn"
        >
            + Book / Reserve Room
        </a>

    </div>


    @if(session('success'))

        <div class="success">
            ✓ {{ session('success') }}
        </div>

    @endif


    @if($errors->any())

        <div class="error">

            <strong>
                ⚠ Please fix the following:
            </strong>

            <ul>

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    <div class="table-card">


        <div class="table-header">

            <h3>
                🏨 Reservation List
            </h3>

            <span>
                {{ $bookings->count() }} booking(s)
            </span>

        </div>


        @if($bookings->count() > 0)


        <div class="table-wrapper">

            <table>

                <thead>

                    <tr>

                        <th>ID</th>

                        <th>Customer</th>

                        <th>Email</th>

                        <th>Room</th>

                        <th>Check In</th>

                        <th>Check Out</th>

                        <th>Total Price</th>

                        <th>Status</th>

                        <th>Action</th>

                    </tr>

                </thead>


                <tbody>


                @foreach($bookings as $booking)


                    <tr>


                        <td>
                            <strong>
                                {{ $booking->id }}
                            </strong>
                        </td>


                        <td>

                            <div class="customer-name">

                                {{ $booking->customer_name
                                    ?? optional($booking->user)->name
                                    ?? 'Customer' }}

                            </div>

                        </td>


                        <td>

                            <div class="email">

                                {{ optional($booking->user)->email
                                    ?? 'N/A' }}

                            </div>

                        </td>


                        <td>

                            @if($booking->room)

                                <div class="room">

                                    Room
                                    {{ $booking->room->room_number }}

                                </div>

                                <div class="room-type">

                                    {{ $booking->room->room_type }}

                                </div>

                            @else

                                Room deleted

                            @endif

                        </td>


                        <td>

                            {{ \Carbon\Carbon::parse(
                                $booking->check_in
                            )->format('M d, Y') }}

                        </td>


                        <td>

                            {{ \Carbon\Carbon::parse(
                                $booking->check_out
                            )->format('M d, Y') }}

                        </td>


                        <td>

                            <span class="total">

                                ₱{{ number_format(
                                    (float)$booking->total_price,
                                    2
                                ) }}

                            </span>

                        </td>


                        <td>


                            @if($booking->status === 'approved')

                                <span class="badge approved">
                                    ✅ Approved
                                </span>

                            @elseif($booking->status === 'cancelled')

                                <span class="badge cancelled">
                                    ❌ Cancelled
                                </span>

                            @else

                                <span class="badge pending">
                                    ⏳ Pending
                                </span>

                            @endif


                        </td>


                        <td>


                            <div class="actions">


                                {{-- ADMIN --}}

                                @if(auth()->user()->role === 'admin')


                                    @if($booking->status === 'pending')


                                        {{-- APPROVE --}}

                                        <form
                                            action="{{ route(
                                                'bookings.approve',
                                                $booking
                                            ) }}"
                                            method="POST"
                                        >

                                            @csrf

                                            <button
                                                type="submit"
                                                class="btn approve-btn"
                                                onclick="return confirm('Approve this booking?')"
                                            >
                                                ✓ Approve
                                            </button>

                                        </form>


                                        {{-- CANCEL --}}

                                        <form
                                            action="{{ route(
                                                'bookings.cancel',
                                                $booking
                                            ) }}"
                                            method="POST"
                                        >

                                            @csrf

                                            <button
                                                type="submit"
                                                class="btn cancel-btn"
                                                onclick="return confirm('Cancel this booking?')"
                                            >
                                                ✕ Cancel
                                            </button>

                                        </form>


                                    @endif


                                    {{-- EDIT --}}

                                    <a
                                        href="{{ route(
                                            'bookings.edit',
                                            $booking
                                        ) }}"
                                        class="btn edit-btn"
                                    >
                                        ✎ Edit
                                    </a>


                                    {{-- DELETE --}}

                                    <form
                                        action="{{ route(
                                            'bookings.destroy',
                                            $booking
                                        ) }}"
                                        method="POST"
                                    >

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn delete-btn"
                                            onclick="return confirm('Delete this booking permanently?')"
                                        >
                                            🗑 Delete
                                        </button>

                                    </form>


                                @else


                                    {{-- CUSTOMER --}}


                                    @if($booking->status === 'approved')

                                        @if($booking->payment_status === 'unpaid')

                                            <a
                                                href="{{ route(
                                                    'payments.create',
                                                    $booking
                                                ) }}"
                                                class="btn pay-btn"
                                            >
                                                💳 Pay Now
                                            </a>

                                        @elseif($booking->payment_status === 'pending')

                                            <span class="badge pending">
                                                Payment Submitted
                                            </span>

                                        @elseif($booking->payment_status === 'paid')

                                            <span class="badge approved">
                                                ✓ Paid
                                            </span>

                                        @endif


                                    @elseif($booking->status === 'pending')

                                        <span class="waiting">
                                            ⏳ Waiting for Admin
                                        </span>

                                    @elseif($booking->status === 'cancelled')

                                        <span class="badge cancelled">
                                            ❌ Cancelled
                                        </span>

                                    @endif


                                    {{-- CUSTOMER EDIT --}}

                                    @if($booking->status === 'pending')

                                        <a
                                            href="{{ route(
                                                'bookings.edit',
                                                $booking
                                            ) }}"
                                            class="btn edit-btn"
                                        >
                                            ✎ Edit
                                        </a>

                                    @endif


                                    {{-- CUSTOMER DELETE --}}

                                    @if($booking->status !== 'approved')

                                        <form
                                            action="{{ route(
                                                'bookings.destroy',
                                                $booking
                                            ) }}"
                                            method="POST"
                                        >

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn delete-btn"
                                                onclick="return confirm('Delete your booking?')"
                                            >
                                                🗑 Delete
                                            </button>

                                        </form>

                                    @endif


                                @endif


                            </div>


                        </td>


                    </tr>


                @endforeach


                </tbody>

            </table>

        </div>


        @else


            <div class="empty">

                <div class="empty-icon">
                    🏨
                </div>

                <h3>
                    No Reservations Found
                </h3>

                <p>
                    There are currently no bookings.
                </p>

            </div>


        @endif


    </div>


</div>


</body>

</html>