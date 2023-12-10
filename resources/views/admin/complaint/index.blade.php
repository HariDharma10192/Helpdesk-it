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
                        <th>No Workorder</th>
                        <th>Complaint Date</th>
                        <th>Solved Date</th>
                        <th>Complaint Type</th>
                        <th>Description</th>
                        <th>Photo</th>
                        <th>Status</th>
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
                            <td>{{ $complaint->no_workorder }}</td>
                            <td>{{ $complaint->complaint_date }}</td>
                            <td>{{ $complaint->solved_date }}</td>
                            <td>{{ $complaint->complaint_type }}</td>
                            <td>{{ $complaint->description }}</td>
                            <td>
                                @if($complaint->photo)
                                    <img src="{{ asset('storage/' . $complaint->photo) }}" alt="Complaint Photo" style="max-width: 100px;">
                                @else
                                    No Photo
                                @endif
                            </td>
                            <td>{{ $complaint->status }}</td>
                            <td>
                                <!-- Form for delete button -->
                                {{-- <form action="{{ route('complaints.destroy', $complaint->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form> --}}
                                
                                <a href="{{ route('a_complaint.show', ['a_complaint' => $complaint->id]) }}" class="btn btn-info">View</a>
                                
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
