@extends('dept.layouts.main')

@section('container')

<div class="card shadow mb-4">
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

    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables Complaints</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Department Name</th>
                        <th>Department Destination</th>
                        <th>No Workorder</th>
                        <th>Complaint Date</th>
                        <th>Solved Date</th>
                        <th>Complaint Type</th>
                        <th>Description</th>
                        <th>Photo</th>
                        <th>Status</th>
                        <th>Action</th> <!-- New column for actions -->
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Department Name</th>
                        <th>Department Destination</th>
                        <th>No Workorder</th>
                        <th>Complaint Date</th>
                        <th>Solved Date</th>
                        <th>Complaint Type</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Photo</th>
                        <th>Action</th> <!-- New column for actions -->
                    </tr>
                </tfoot>
                <tbody>
                    @php $counter = 1 @endphp
                    @foreach($complaints as $complaint)
                        <tr>
                            <td>{{ $counter++ }}</td>
                            <td>{{ $complaint->username }}</td>
                            <td>{{ $complaint->department_name }}</td>
                            <td>{{ $complaint->department_destination }}</td>
                            <td>{{ $complaint->no_workorder }}</td>
                            <td>{{ \Carbon\Carbon::parse($complaint->complaint_date)->format('d-m-Y') }}</td>
                            <td>{{ $complaint->solved_date ? \Carbon\Carbon::parse($complaint->solved_date)->format('d-m-Y') : '-' }}</td>


                            <td>{{ $complaint->complaint_type }}</td>
                            <td>{{ $complaint->description }}</td>
                           
                            <td style="color: @if($complaint->status == 'dikirim') red @elseif($complaint->status == 'proses') blue @elseif($complaint->status == 'done') green @endif">
                                {{ $complaint->status }}
                            </td>
                            <td>
                                @if($complaint->photo)
                                    <img src="{{ asset('storage/' . $complaint->photo) }}" alt="Complaint Photo" style="max-width: 100px;">
                                @else
                                    No Photo
                                @endif
                            </td>
                             <td>
                                <!-- Tombol untuk melihat detail -->
                                <a href="{{ route('dept.show', $complaint->id) }}" class="btn btn-info">View</a>
                    
                                <!-- Tombol untuk mengedit -->
                                <a href="{{ route('dept.edit', $complaint->id) }}" class="btn btn-warning">Edit</a>
                    
                                <!-- Form untuk tombol delete -->
                                    {{-- <form action="{{ route('dept.destroy', $complaint->id) }}" method="post" style="display: inline;">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this complaint?')">Delete</button>
                                    </form> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
