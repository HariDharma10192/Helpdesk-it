@extends('admin.layouts.main')

@section('container')

<div class="card shadow mb-4">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('message') }}
        </div>
    @endif

    <!-- Contoh Form Pencarian -->
    <form action="{{ route('a_complaint.indexReport') }}" method="GET" class="mb-4">
        <div class="row ml-2 mt-3">
            <div class="col-md-3">
                <!-- Input Tanggal -->
                <label for="start_date" class="form-label">Start Date:</label>
                <input type="date" name="start_date" id="start_date" class="form-control" required>
            </div>
            <div class="col-md-3">
                <!-- Input Tanggal -->
                <label for="end_date" class="form-label">End Date:</label>
                <input type="date" name="end_date" id="end_date" class="form-control" required>
            </div>
            <div class="col-md-4">
                <!-- Input department_name -->
                <label for="department_name" class="form-label">Department Name:</label>
                <input type="text" name="department_name" id="department_name" class="form-control" required>
            </div>
            <div class="col-md-2 " style="margin-top: 2rem;">
                <!-- Tombol Submit -->
                <button type="submit" class="btn btn-primary btn-mt-5">Search</button>
            </div>
        </div>
    </form>
    
<br><hr>
<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Complaint Date</th>
                <th>Department Name</th>
                <th>Department Destination</th>
                <th>No Workorder</th>
                <th>Complaint Type</th>
                <th>Description</th>
                <!-- Tambahkan kolom-kolom lain sesuai kebutuhan -->
            </tr>
        </thead>
        <tbody>
            @isset($complaintsReport)
                @forelse($complaintsReport as $complaint)
                    <tr>
                        <td>{{ $complaint->complaint_date }}</td>
                        <td>{{ $complaint->department_name }}</td>
                        <td>{{ $complaint->department_destination }}</td>
                        <td>{{ $complaint->no_workorder }}</td>
                        <td>{{ $complaint->complaint_type }}</td>
                        <td>{{ $complaint->description }}</td>
                        <!-- Tambahkan kolom-kolom lain sesuai kebutuhan -->
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-primary">Tidak ada data yang ditemukan</td>
                        
                    </tr>
                @endforelse
            @endisset
        </tbody>
    </table>
    </div>
</div>
</div>

@endsection
