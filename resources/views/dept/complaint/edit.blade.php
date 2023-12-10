@extends('dept.layouts.main')

@section('container')
    <div class="container">
        <h1>Edit Complaint</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('dept.update', $complaint->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Department Name -->
            <div class="mb-3">
                <label for="department_name" class="form-label">Department Name</label>
                <input type="text" class="form-control" id="department_name" name="department_name" value="{{ $complaint->department_name }}" readonly>
            </div>

            <!-- Department Destination -->
            <div class="mb-3">
                <label for="department_destination" class="form-label">Department Destination</label>
                <input type="text" class="form-control" id="department_destination" name="department_destination" value="{{ $complaint->department_destination }}" readonly>
            </div>

            <!-- No Work Order -->
            <div class="mb-3">
                <label for="no_workorder" class="form-label">No Work Order</label>
                <input type="text" class="form-control" id="no_workorder" name="no_workorder" value="{{ $complaint->no_workorder }}" readonly>
            </div>
            <!-- Solved Date -->
            <div class="mb-3">
                <label for="solved_date" class="form-label">Solved Date</label>
                <input type="date" class="form-control" id="solved_date" name="solved_date" value="{{ $complaint->solved_date }}" >
            </div>

            <!-- Description -->
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea readonly class="form-control" id="description" name="description" rows="4" required>{{ $complaint->description }} readonly </textarea>
            </div>

            <!-- Status -->
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="dikirim" {{ $complaint->status === 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                    <option value="proses" {{ $complaint->status === 'proses' ? 'selected' : '' }}>Proses</option>
                    <option value="done" {{ $complaint->status === 'done' ? 'selected' : '' }}>Done</option>
                </select>
            </div>

            <!-- Submit Button -->
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Update Complaint</button>
            </div>
        </form>

        <a href="{{ route('dept.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
@endsection
