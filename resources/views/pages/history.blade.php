@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'history'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header ">
                        <h5 class="card-title">User's Appointments</h5>
                    </div>
                    <div class="card-body ">
                        <table class="table" id="myTable">
                            <thead>
                                <th>User Name</th>
                                <th>Address</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Purpose</th>
                                <th>Status</th>
                                <th>Doctor</th>                            
                            </thead>
                            <tbody>
                                @foreach ($appointments as $appointment)
                                    <tr>
                                        <td>{{ $appointment->firstname }} {{ $appointment->lastname }}</td>
                                        <td>{{ $appointment->address }}</td>
                                        <td>{{ $appointment->email }}</td>
                                        <td>{{ $appointment->phone_number }}</td>
                                        <td>{{ $appointment->reason }}</td>
                                        <td>{{ $appointment->status }}</td>
                                        <td>{{ $appointment->doctor}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
@endsection

@push('scripts')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css" />
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
    
    <script>
        // let table = new DataTable('#myTable');

        $(document).ready(function() {
            $('#myTable').DataTable({
                "lengthChange": false
            });
        });


        // Javascript method's body can be found in assets/assets-for-demo/js/demo.js
        // demo.initChartsPages();
    </script>
@endpush