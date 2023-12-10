{{-- resources/views/admin/users/index.blade.php --}}

@extends('admin.layouts.main')

@section('container')
    <div class="container-fluid">
        
        <a href="{{ route('users.create') }}" class="btn-sm btn-success">Add User</a>
        <br><br>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"> User Management</h6>
            </div>
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
             @endif
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ getRoleName($user->role_id) }}</td>
                                    <td>
                                        <a href="{{ route('users.show', $user->id) }}" class="btn btn-info">View</a>
                                       <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Edit</a>
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                                        </form> 
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
       
    </div>
@endsection

