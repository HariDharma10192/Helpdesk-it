@extends('admin.layouts.main')


@section('container')
    <h1>Edit User</h1>


   
    <form action="{{ route('users.update', $user->id) }}" method="post">

        @method('PUT')
        @csrf

        <label for="name">Name:</label>
        <input type="text" name="name" value="{{ $user->name }}" required>
        <br>

        <label for="email">Email:</label>
        <input type="email" name="email" value="{{ $user->email }}" required>
        <br>

        <label for="password">New Password:</label>
        <input type="password" name="password">
        <br>

        <label for="password_confirmation">Confirm New Password:</label>
        <input type="password" name="password_confirmation">
        <br>

        <label for="role_id">Role:</label>
        <select name="role_id">
            @foreach($roles as $role)
                <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                    {{ $role->role }}
                </option>
            @endforeach
        </select>
        <br>

        <button type="submit">Update User</button>
    </form>

    <a href="{{ route('users') }}">Back to Users List</a>

@endsection