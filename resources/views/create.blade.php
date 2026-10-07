<!DOCTYPE html>
<html>

<head>
    <title>Add User</title>
</head>

<body style="font-family:Arial;background:#f4f7fb;padding:40px">

<div style="background:white;padding:30px;max-width:600px;margin:auto;border-radius:12px">

<h1>➕ Add User</h1>

<a href="{{ route('users.index') }}">← Back</a>

<br><br>

@if($errors->any())

<div style="color:red">

@foreach($errors->all() as $error)

<p>{{ $error }}</p>

@endforeach

</div>

@endif

<form method="POST" action="{{ route('users.store') }}">

@csrf

<label>Name</label><br>

<input type="text"
       name="name"
       value="{{ old('name') }}"
       style="width:100%;padding:10px"
       required>

<br><br>

<label>Email</label><br>

<input type="email"
       name="email"
       value="{{ old('email') }}"
       style="width:100%;padding:10px"
       required>

<br><br>

<label>Password</label><br>

<input type="password"
       name="password"
       style="width:100%;padding:10px"
       required>

<br><br>

<label>Confirm Password</label><br>

<input type="password"
       name="password_confirmation"
       style="width:100%;padding:10px"
       required>

<br><br>

<label>Role</label><br>

<select name="role"
        style="width:100%;padding:10px"
        required>

<option value="Administrator">
Administrator
</option>

<option value="Hotel Staff">
Hotel Staff
</option>

<option value="Customer/Guest">
Customer/Guest
</option>

</select>

<br><br>

<button type="submit"
        style="background:#17324d;color:white;padding:12px 20px;border:0;border-radius:6px">

Save User

</button>

</form>

</div>

</body>
</html>