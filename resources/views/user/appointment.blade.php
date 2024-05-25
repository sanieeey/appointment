@php
    use Illuminate\Support\Facades\Crypt;
@endphp
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
            max-width: 800px;
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

        form {
            margin-top: 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        textarea {
            height: 100px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            width: 100%;
            padding: 10px;
            border-radius: 5px;
        }

        button:hover {
            background-color: #45a049;
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

        .column {
            width: calc(50% - 10px);
            margin-bottom: 20px;
        }

        @media screen and (max-width: 600px) {
            .column {
                width: 100%;
            }
        }
    </style>
</head>
<body>
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

@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'userAppointment'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card demo-icons">
                    <div class="card-header">
                        <h1>Book an Appointment</h1>
                    </div>
                    <div class="card-body">
                        <form id="appointmentform">
                            @csrf
                            <div class="column">
                                <label for="firstname">First Name:</label>
                                <input type="text" name="firstname" id="firstname" required>
    
                                <label for="lastname">Last Name:</label>
                                <input type="text" name="lastname" id="lastname" required>
    
                                <label for="middlename">Middle Name:</label>
                                <input type="text" name="middlename" id="middlename">
    
                                <label for="edit_birthdate">Birth Date</label>
                                <input type="date" class="form-control" name="birthday">
                                {{-- <select class="form-control" id="edit_birthdate_day" name="birthdate_day" required>
                                    <option value="">Day</option>
                                    @for ($day = 1; $day <= 31; $day++)
                                        <option value="{{ $day }}">{{ $day }}</option>
                                    @endfor
                                </select>
                                <select class="form-control mt-2" id="edit_birthdate_month" name="birthdate_month" required>
                                    <option value="">Month</option>
                                    @foreach (['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $month)
                                        <option value="{{ $month }}">{{ $month }}</option>
                                    @endforeach
                                </select>
                                <select class="form-control mt-2" id="edit_birthdate_year" name="birthdate_year" required>
                                    <option value="">Year</option>
                                    @for ($year = date('Y'); $year >= 1900; $year--)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endfor
                                </select> --}}
                            </div>
    
                            <div class="column">
                                <label for="address">Address:</label>
                                <input type="text" name="address" id="address">
    
                                <label for="email">Email:</label>
                                <input type="email" name="email" id="email" required>
    
                                <label for="phone_number">Phone Number:</label>
                                <input type="text" name="phone_number" id="phone_number">
    
                                <label for="reason">Reason for Checkup:</label>
                                <select name="reason" id="reason">
                                    <option value="">--Select a reason--</option>
                                    <option value="ophthalmology">Ophthalmology</option>
                                    <option value="dentistry">Dentistry</option>
                                    <option value="dermatology">Dermatology</option>
                                    <option value="surgery">Surgery</option>
                                    <option value="ent">ENT(ear, nose, throat)</option>
                                </select>
                            </div>
                            <button class="col-2" type="submit" id="submitbtn">SUBMIT APPOINTMENT</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#appointmentform').submit(function(e) {
                e.preventDefault(); // Prevent the default form submission
                $.ajax({
                    url: '{{ route("user.appointment") }}',
                    type: 'POST',
                    data: $(this).serialize(), // Serialize form data
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token
                    },
                    success: function(response) {
                        // Handle success response
                        Swal.fire('Success!', 'Appointment submitted successfully', 'success');
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        console.log(xhr.responseText);
                        Swal.fire('Error!', 'An error occurred. Please try again later.', 'error');
                    }
                });
            });
        });
    </script>
{{-- </body>
</html> --}}
