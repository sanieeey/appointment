<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'userProcess'
])
<body>
    @section('content')
    {{-- <div class="menu-bar">
        <a href="{{ route('appointment') }}">Appointment</a>
        <a href="{{ route('progress') }}">Progress</a>
        <a href="{{ route('logout') }}">Logout</a>
        @if(auth()->check())
            <span style="float: right; color: #f2f2f2; padding: 14px 16px;">
                {{ auth()->user()->name }}({{ auth()->user()->role }})
            </span>
        @endif
    </div> --}}

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
                                        {{-- <th>ID</th> --}}
                                        <th>NAME</th>
                                        <th>BIRTHDATE</th>
                                        <th>ADDRESS</th>
                                        <th>EMAIL</th>
                                        <th>PHONE</th>
                                        <th>REASON</th>
                                        <th>STATUS</th>
                                        <th>ACTIONS</th>
                                    </thead>
                                    <tbody>
                                        @foreach($appointments as $appointment)
                                            <tr>
                                                {{-- <td>{{$appointment->id}}</td> --}}
                                                <td>{{$appointment->firstname}} {{$appointment->lastname}}</td>
                                                {{-- <td></td>
                                                <td>{{$appointment->middlename}}</td> --}}
                                                <td>{{$appointment->birthdate}}</td>
                                                <td>{{$appointment->address}}</td>
                                                <td>{{$appointment->email}}</td>
                                                <td>{{$appointment->phone_number}}</td>
                                                <td>{{$appointment->reason}}</td>
                                                <td>{{$appointment->status}}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button class="btn btn-primary btn-sm edit-btn" appointment-id="{{ Crypt::encryptString($appointment->id) }}" data-toggle="modal" data-target="#editApp" id="editAppBtn">EDIT</button>
                                                        <button class="btn btn-danger btn-sm delete-btn" appointment-id="{{ Crypt::encryptString($appointment->id) }}" id="deleteAppBtn">DELETE</button>
                                                    </div>
                                                </td>
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
        <!-- Approve Modal -->
        <div class="modal fade" id="editApp" tabindex="-1" role="dialog" aria-labelledby="approveModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="approveModalLabel">Approve Appointment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editAppForm">
                            @csrf
                            <input class="d-none" type="text" id="appId" name="appId">
                            <div class="row">
                                {{-- <div class="form-group col-6">
                                    <label class="form-label" for="firstname">Firstname:</label>
                                    <input class="form-control" type="text" name="firstname" id="firstname">
                                </div> --}}
                                {{-- <div class="form-group col-6">                       
                                    <label class="form-label" for="lastname">Lastname:</label>
                                    <input class="form-control" type="text" name="lastname" id="lastname" required>
                                </div> --}}
                            </div>
                            <div class="row">
                                {{-- <div class="form-group col-6">                       
                                    <label class="form-label" for="middlename">MiddleName:</label>
                                    <input class="form-control" type="text" name="middlename" id="middlename" required>
                                </div> --}}
                                <div class="form-group col-6">                       
                                    <label class="form-label" for="birthdate">Birth Date:</label>
                                    <input class="form-control" type="date" name="birthdate" id="birthdate" required>
                                </div>
                                
                                <div class="form-group col-6">
                                    <label class="form-label" for="address">Address:</label>
                                    <input class="form-control" type="text" name="address" id="address">
                                </div>
                            </div>
                            <div class="row">
                                {{-- <div class="form-group col-6">                       
                                    <label class="form-label" for="email">Email:</label>
                                    <input class="form-control" type="email" name="email" id="email" required>
                                </div> --}}
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label class="form-label" for="phone_number">Phone Number:</label>
                                    <input class="form-control" type="number" name="phone_number" id="phone_number">
                                </div>
                                <div class="form-group col-6">
                                    <label class="form-label" for="reason">Reason for Checkup:</label>
                                    <select class="form-control" name="reason" id="reason">
                                        <option value="">--Select a reason--</option>
                                        <option value="ophthalmology">Ophthalmology</option>
                                        <option value="dentistry">Dentistry</option>
                                        <option value="dermatology">Dermatology</option>
                                        <option value="surgery">Surgery</option>
                                        <option value="ent">ENT(ear, nose, throat)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="confirmAppSave">Save</button>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>


<script>
    $(document).on('click','#editAppBtn',function(){
        var id = $(this).attr('appointment-id')
        $('#appId').val('')
        $('#firstname').val('')
        // $('#lastname').val('')
        // $('#middlename').val('')
        $('#email').val('')
        $('#address').val('')
        $('#birthdate').val('')
        $('#phone_number').val('')
        $('#reason').val('')
        $.ajax({
            url: '/appointment/' + id,
            method: 'get',
            data: {
                id: id
            },
            success: function(response) {
                if(response.status === 'success') {
                    $('#appId').val(id)
                    $('#firstname').val(response.data.firstname)
                    // $('#lastname').val(response.data.lastname)
                    // $('#middlename').val(response.data.middlename)
                    $('#email').val(response.data.email)
                    $('#address').val(response.data.address)
                    $('#birthdate').val(response.data.birthdate)
                    $('#phone_number').val(response.data.phone_number)
                    $('#reason').val(response.data.reason)
                }
            }
        });
    })

    $(document).on('click','#confirmAppSave',function(){
        $.ajax({
            url: '/appointment/save',
            method: 'post',
            data: $('#editAppForm').serialize(),
            success: function(response) {
                if(response.status === 'success') {
                    Swal.fire(
                        'Saved!',
                        'The appointment has been updated!',
                        'success'
                    );
                    location.reload();
                }
            }
        });
    })


    $(document).on('click','#deleteAppBtn',function(){
        var id = $(this).attr('appointment-id')
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/appointment/delete/' + id,
                    method: 'POST',
                    data: {
                        '_token': '{{ CSRF_TOKEN() }}'
                    },
                    success: function(response) {
                        if(response.status === 'success') {
                            Swal.fire(
                                'Deleted!',
                                'The appointment has been deleted!',
                                'success'
                            );
                            location.reload();
                        }
                    }
                });
            }
        });
    })
</script>

</body>
</html>
@endsection