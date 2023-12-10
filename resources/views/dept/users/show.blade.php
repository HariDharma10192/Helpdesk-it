<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show User</title>
</head>
<body>

    <h1>User Details</h1>

    <p><strong>Name:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Role:</strong> {{ $user->role_id }}</p>

    <a href="{{ route('users') }}">Back to Users List</a>

</body>
</html>
