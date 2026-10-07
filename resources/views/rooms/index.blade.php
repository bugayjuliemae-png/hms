<!DOCTYPE html>
<html>
<head>
    <title>Room Management</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f1f3f6;
            margin: 0;
            padding: 30px;
        }

        .container {
            max-width: 1100px;
            margin: auto;
        }

        h1 {
            color: #182433;
        }

        .add-button {
            display: inline-block;
            background: #182433;
            color: white;
            padding: 12px 20px;
            text-decoration: none;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            background: white;
            border-collapse: collapse;
        }

        th, td {
            padding: 14px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #182433;
            color: white;
        }

        .edit {
            color: #2980b9;
            text-decoration: none;
        }

        .delete {
            background: #c0392b;
            color: white;
            border: none;
            padding: 7px 12px;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Room Management</h1>

    <a href="{{ route('dashboard') }}">← Back to Dashboard</a>

    <br><br>

    <a href="{{ route('rooms.create') }}" class="add-button">
        + Add Room
    </a>

    <table>

        <tr>
            <th>Room Number</th>
            <th>Room Type</th>
            <th>Price</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

        @forelse($rooms as $room)

        <tr>
            <td>{{ $room->room_number }}</td>
            <td>{{ $room->room_type }}</td>
            <td>₱{{ number_format($room->price, 2) }}</td>
            <td>{{ ucfirst($room->status) }}</td>

            <td>
                <a href="{{ route('rooms.edit', $room->id) }}" class="edit">
                    Edit
                </a>

                <form action="{{ route('rooms.destroy', $room->id) }}"
                      method="POST"
                      style="display:inline;">

                    @csrf
                    @method('DELETE')

                    <button type="submit"
                            class="delete"
                            onclick="return confirm('Delete this room?')">
                        Delete
                    </button>

                </form>
            </td>
        </tr>

        @empty

        <tr>
            <td colspan="5">
                No rooms available.
            </td>
        </tr>

        @endforelse

    </table>

</div>

</body>
</html>