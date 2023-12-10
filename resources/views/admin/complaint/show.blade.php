@extends('admin.layouts.main')

@section('container')
    <div class="container-fluid">

        <div class="card">
            <div class="card-header">
                <h4 class="">Complaint Detail</h4>
            </div>

            <div class="card-body" id="printableContent">
                <table class="table">
                    <tr>
                        <th>No Workorder</th>
                        <td>{{ $complaint->no_workorder }}</td>
                    </tr>
                    <tr>
                        <th>Complaint Date</th>
                        <td>{{ \Carbon\Carbon::parse($complaint->complaint_date)->format('d/m/Y') }}</td>
                    </tr>
                    <tr>
                        <th>Username</th>
                        <td>{{ $complaint->username }}</td>
                    </tr>
                    <tr>
                        <th>Department Name</th>
                        <td>{{ $complaint->department_name }}</td>
                    </tr>
                    <tr>
                        <th>Department Destination</th>
                        <td>{{ $complaint->department_destination }}</td>
                    </tr>
                    
                    
                    
                    <tr>
                        <th>Complaint Type</th>
                        <td>{{ $complaint->complaint_type }}</td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td>{{ $complaint->description }}</td>
                    </tr>
                    <tr>
                        <th>Photo</th>
                        <td>
                            @if($complaint->photo)
                                <img src="{{ asset('storage/' . $complaint->photo) }}" alt="Complaint Photo" style="max-width: 100px;">
                            @else
                                No Photo
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Solved Date</th>
                        <td>{{ $complaint->solved_date ? \Carbon\Carbon::parse($complaint->solved_date)->format('d/m/Y') : '-' }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td style="color: @if($complaint->status == 'dikirim') red @elseif($complaint->status == 'proses') blue @elseif($complaint->status == 'done') green @endif">
                            {{ $complaint->status }}
                        </td>
                    </tr>
                </table>
            </div>
            <div class="card-footer">
                <a href="{{ route('dept.index') }}" class="btn btn-primary">Back to List</a>
                <button class="btn btn-success" onclick="printContent()">Print</button>

            </div>
        </div>
    </div>
    <script>
        function printContent() {
            var content = document.getElementById('printableContent').innerHTML;
            var printWindow = window.open('', '_blank');

            printWindow.document.open();
            printWindow.document.write('<html><head><title>Complaint Detail</title>');
            printWindow.document.write('<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">');
            printWindow.document.write('</head><body>');
            printWindow.document.write(content);
            printWindow.document.write('</body></html>');
            printWindow.document.close();

            printWindow.print();
        }
    </script>
@endsection
