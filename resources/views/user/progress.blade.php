<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Book an Appointment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1000px; /* Increase the width here */
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        .menu-bar {
            background-color: #333;
            overflow: hidden;
        }

        .menu-bar a {
            float: left;
            display: block;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        .menu-bar a:hover {
            background-color: #ddd;
            color: black;
        }

    </style>
</head>
<body>
    <div class="menu-bar">
        <a href="{{ route('appointment') }}">Appointment</a>
        <a href="{{ route('progress') }}">Progress</a>
        <a href="{{ route('logout') }}">Logout</a>
        @if(auth()->check())
            <span style="float: right; color: #f2f2f2; padding: 14px 16px;">
                {{ auth()->user()->name }}({{ auth()->user()->role }})
            </span>
        @endif
    </div>

    <div class="container">
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card demo-icons">
                        <div class="card-header">
                            <h5 class="card-title">PROGRESS</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="text-primary">
                                        <th>ID</th>
                                        <th>FIRST NAME</th>
                                        <th>LAST NAME</th>
                                        <th>MIDDLE NAME</th>
                                        <th>BIRTHDATE</th>
                                        <th>ADDRESS</th>
                                        <th>EMAIL</th>
                                        <th>PHONE NUMBER</th>
                                        <th>REASON</th>
                                        <th>STATUS</th>
                                        <th>ACTIONS</th>
                                    </thead>
                                    <tbody>
                                        @foreach($appointments as $appointment)
                                            <tr>
                                                <td>{{$appointment->id}}</td>
                                                <td>{{$appointment->firstname}}</td>
                                                <td>{{$appointment->lastname}}</td>
                                                <td>{{$appointment->middlename}}</td>
                                                <td>{{$appointment->birthdate}}</td>
                                                <td>{{$appointment->address}}</td>
                                                <td>{{$appointment->email}}</td>
                                                <td>{{$appointment->phone_number}}</td>
                                                <td>{{$appointment->reason}}</td>
                                                <td>{{$appointment->status}}</td>
                                                <!-- <td>
                                                    <button class="btn btn-danger btn-sm delete-btn" data-id="{{ $appointment->id }}">
                                                        <i class="fas fa-trash"></i> 
                                                    </button>
                                                </td> -->
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
    </div>
</body>
</html>
