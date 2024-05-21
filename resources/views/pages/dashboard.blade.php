@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'dashboard'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="icon-big text-center icon-warning">
                                    {{-- <i class="nc-icon nc-globe text-warning"></i> --}}
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category">Total Appointment</p>
                                    <p class="card-title"> {{ count($appointments) }} 
                                        <p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats">
                            {{-- <i class="fa fa-refresh"></i> Update Now --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="icon-big text-center icon-warning">
                                    {{-- <i class="nc-icon nc-money-coins text-success"></i> --}}
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category">Total Doctors</p>
                                    <p class="card-title">{{ count($doctors)  }}
                                        <p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats">
                            {{-- <i class="fa fa-calendar-o"></i> Last day --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="icon-big text-center icon-warning">
                                    {{-- <i class="nc-icon nc-vector text-danger"></i> --}}
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category">In-Progress Appointment</p>
                                    <p class="card-title">{{ $appointmentsInProgress }}
                                        <p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats">
                            {{-- <i class="fa fa-clock-o"></i> In the last hour --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="icon-big text-center icon-warning">
                                    {{-- <i class="nc-icon nc-favourite-28 text-primary"></i> --}}
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category">Total Users</p>
                                    <p class="card-title"> {{ $usersRole }}
                                        <p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats">
                            {{-- <i class="fa fa-refresh"></i> Update now --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header ">
                        <h5 class="card-title">User's Appointments</h5>
                        {{-- <p class="card-category">24 Hours performance</p> --}}
                    </div>
                    <div class="card-body ">
                        <table class="table">
                            <thead>
                                <th>User Name</th>
                                <th>Address</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Purpose</th>
                                <th>Status</th>
                                <th>Date Create</th>                            
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
                                        <td>{{ \Carbon\Carbon::parse($appointment->created_at)->format('F m Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- <div class="card-footer ">
                        <hr>
                        <div class="stats">
                            <i class="fa fa-history"></i> Updated 3 minutes ago
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card ">
                    <div class="card-header ">
                        <h5 class="card-title">Doctors</h5>
                        {{-- <p class="card-category">Last Campaign Performance</p> --}}
                    </div>
                    <div class="card-body ">
                        <table class="table">
                            <thead>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Specialty</th>
                                <th>Date Added</th>                            
                            </thead>
                            <tbody>
                                @foreach ($doctors as $doctor)
                                    <tr>
                                        <td>{{ $doctor->firstname }} {{ $doctor->lastname }}</td>
                                        <td>{{ $doctor->phone_number }}</td>
                                        <td>{{ $doctor->speciality }}</td>
                                        <td>{{ \Carbon\Carbon::parse($doctor->created_at)->format('F m Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- <div class="card-footer ">
                        <div class="legend">
                            <i class="fa fa-circle text-primary"></i> Opened
                            <i class="fa fa-circle text-warning"></i> Read
                            <i class="fa fa-circle text-danger"></i> Deleted
                            <i class="fa fa-circle text-gray"></i> Unopened
                        </div>
                        <hr>
                        <div class="stats">
                            <i class="fa fa-calendar"></i> Number of emails sent
                        </div>
                    </div> --}}
                </div>
            </div>
            <div class="col-md-8">
                <div class="card card-chart">
                    <div class="card-header">
                        <h5 class="card-title">Users</h5>
                        {{-- <p class="card-category">Line Chart with Points</p> --}}
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <th>Name</th>
                                <th>email</th>
                                <th>Role</th>
                                <th>Date Added</th>                            
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->role }}</td>
                                        <td>{{ \Carbon\Carbon::parse($user->created_at)->format('F m Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- <div class="card-footer">
                       
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Javascript method's body can be found in assets/assets-for-demo/js/demo.js
            demo.initChartsPages();
        });
    </script>
@endpush