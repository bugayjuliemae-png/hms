<!DOCTYPE html>
<html>
<head>
    <title>Edit Room</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f1f3f6;
            padding: 30px;
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
        }

        label {
            display: block;
            margin-top: 15px;
            margin-bottom: 5px;
        }

        input, select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            margin-top: 20px;
            padding: 12px 20px;
            background: #182433;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .back {
            text-decoration: none;
            color: #182433;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Edit Room</h1>

    <a href="{{ route('rooms.index') }}" class="back">
        ← Back to Room Management
    </a>

    <form action="{{ route('rooms.update', $room->id) }}" method="POST">

        @csrf
        @method('PUT')

        <label>Room Number</label>
        <input
            type="text"
            name="room_number"
            value="{{ $room->room_number }}"
            required
        >

        <label>Room Type</label>
        <select name="room_type" required>
            <option value="Standard Room" {{ $room->room_type == 'Standard Room' ? 'selected' : '' }}>
                Standard Room
            </option>

            <option value="Deluxe Room" {{ $room->room_type == 'Deluxe Room' ? 'selected' : '' }}>
                Deluxe Room
            </option>

            <option value="Family Room" {{ $room->room_type == 'Family Room' ? 'selected' : '' }}>
                Family Room
            </option>

            <option value="Suite Room" {{ $room->room_type == 'Suite Room' ? 'selected' : '' }}>
                Suite Room
            </option>
        </select>

        <label>Price per Night</label>
        <input
            type="number"
            name="price"
            value="{{ $room->price }}"
            step="0.01"
            required
        >

        <label>Status</label>
        <select name="status" required>
            <option value="available" {{ $room->status == 'available' ? 'selected' : '' }}>
                Available
            </option>

            <option value="occupied" {{ $room->status == 'occupied' ? 'selected' : '' }}>
                Occupied
            </option>

            <option value="maintenance" {{ $room->status == 'maintenance' ? 'selected' : '' }}>
                Maintenance
            </option>
        </select>

        <button type="submit">
            Update Room
        </button>

    </form>

</div>

</body>
</html>