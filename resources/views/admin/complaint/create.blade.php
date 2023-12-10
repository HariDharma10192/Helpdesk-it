@extends('admin.layouts.main')

@section('container')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Complaint</div>

                <div class="card-body">
                    <form action="{{ url('/complaints') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <!-- Username -->
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control" id="username" name="username" value="{{ auth()->user()->name }}" required readonly>
                        </div>

                        <!-- Department Name -->
                        <div class="form-group">
                            <label for="department_name">Department Name:</label>
                            <input type="text" class="form-control" id="department_name" name="department_name" required>
                        </div>

                        <!-- Department Destination -->
                        <div class="form-group">
                            <label for="department_destination">Department Destination:</label>
                            <select class="form-control" id="department_destination" name="department_destination" required>
                                @foreach($users as $user)
                                    <option value="{{ $user->name }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            
                        </div>

                        <!-- No Work Order -->
                        <div class="form-group">
                            <label for="no_workorder">No Work Order:</label>
                            <input type="text" class="form-control" id="no_workorder" name="no_workorder" required>
                        </div>

                        <!-- Complaint Date -->
                        <div class="form-group">
                            <label for="complaint_date">Complaint Date:</label>
                            <input type="date" class="form-control" id="complaint_date" name="complaint_date" required>
                        </div>
                        

                        <!-- Solved Date -->
                        {{-- <div class="form-group">
                            <label for="solved_date">Solved Date:</label>
                            <input type="date" class="form-control" id="solved_date" name="solved_date">
                        </div> --}}

                        <!-- Complaint Type -->
                        <div class="form-group">
                            <label for="complaint_type">Complaint Type:</label>
                            <select class="form-control" id="complaint_type" name="complaint_type" required>
                                <option value="ringan">Ringan</option>
                                <option value="sedang">Sedang</option>
                                <option value="berat">Berat</option>
                            </select>
                        </div>

                        <!-- Description -->
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                        </div>

                        <!-- Photo -->
                        <div class="form-group">
                            <label for="photo">Photo:</label>
                            <input type="file" class="form-control-file" id="photo" name="photo" accept="image/*">
                        </div>

                        <!-- Status -->
                        <div class="form-group">
                            <input type="text" class="form-control" id="status" name="status" value="dikirim" hidden>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
