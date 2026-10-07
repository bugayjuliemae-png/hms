<!DOCTYPE html>
<html>
<head>
    <title>Add Room</title>

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

    <h1>Add Room</h1>

    <a href="{{ route('rooms.index') }}" class="back">
        ← Back to Room Management
    </a>

    <form action="{{ route('rooms.store') }}" method="POST">

        @csrf

        <label>Room Number</label>
        <input type="text" name="room_number" placeholder="Example: 101" required>

        <label>Room Type</label>
        <select name="room_type" required>
            <option value="">Select Room Type</option>
            <option value="Standard Room">Standard Room</option>
            <option value="Deluxe Room">Deluxe Room</option>
            <option value="Family Room">Family Room</option>
            <option value="Suite Room">Suite Room</option>
        </select>

        <label>Price per Night</label>
        <input type="number" name="price" placeholder="Example: 1500" step="0.01" required>

        <label>Status</label>
        <select name="status" required>
            <option value="available">Available</option>
            <option value="occupied">Occupied</option>
            <option value="maintenance">Maintenance</option>
        </select>

        <button type="submit">Add Room</button>

    </form>

</div>

</body>
</html>