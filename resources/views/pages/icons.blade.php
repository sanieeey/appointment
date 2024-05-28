@php
    use Illuminate\Support\Facades\Crypt;
@endphp
@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'icons'
])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/main.min.css" rel="stylesheet">
</head>
<body>
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card demo-icons">
                    <div class="card-header">
                        <h5 class="card-title">APPOINTMENTS</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="text-primary">
                                    {{-- <th>ID</th> --}}
                                    <th>NAME</th>
                                    {{-- <th>LAST NAME</th>
                                    <th>MIDDLE NAME</th> --}}
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
                                        <tr data-id="{{ $appointment->id }}">
                                            {{-- <td>{{ $appointment->id }}</td> --}}
                                            <td>{{ $appointment->firstname }}</td>
                                            {{-- <td>{{ $appointment->lastname }}</td>
                                            <td>{{ $appointment->middlename }}</td> --}}
                                            <td>{{ $appointment->birthdate }}</td>
                                            <td>{{ $appointment->address }}</td>
                                            <td class="email">{{ $appointment->email }}</td>
                                            <td>{{ $appointment->phone_number }}</td>
                                            <td>{{ $appointment->reason }}</td>
                                            <td class="status">{{ $appointment->status }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <button class="btn btn-primary btn-sm edit-btn" data-id="{{ Crypt::encryptString($appointment->id) }}" data-toggle="modal" data-target="#approveModal">APPROVE</button>
                                                    <button class="btn btn-danger btn-sm delete-btn" data-id="{{ Crypt::encryptString($appointment->id) }}">REJECT</button>
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
    <div class="modal fade" id="approveModal" tabindex="-1" role="dialog" aria-labelledby="approveModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="approveModalLabel">Approve Appointment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to approve this appointment?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="confirmApprove">Approve</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Email Modal -->
    <div class="modal fade" id="emailModal" tabindex="-1" role="dialog" aria-labelledby="emailModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="emailModalLabel">Send Email</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="emailForm">
                        <input type="hidden" id="appID" name="appID">
                        <div class="form-group">
                            <label for="recipientEmail">Recipient Email</label>
                            <input type="email" class="form-control" id="recipientEmail" name="recipientEmail" required>
                        </div>
                        <div class="form-group">
                            <label for="emailSubject">Subject</label>
                            <input type="text" class="form-control" id="emailSubject" name="emailSubject" required>
                        </div>
                        <div class="form-group">
                            <label for="emailBody">Body</label>
                            <textarea class="form-control mh-100 " style="resize: vertical" id="emailBody" name="emailBody" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="doctor">Select Doctor</label>
                            <select class="form-control" id="doctor" name="doctor" required>
                                @foreach ($doctors as $doctor)
                                    <option value="{{ $doctor->firstname }} {{ $doctor->lastname }}">{{ $doctor->firstname }} {{ $doctor->lastname }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="appointmentDate">Appointment Date</label>
                            <input class="form-control" id="appointmentDate" name="appointmentDate" type="datetime-local" min="{{ \CARBON\CARBON::now() }}" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="sendEmailBtn">Send Email</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/main.min.js"></script>
<script>
$(document).ready(function() {
var approvedId; // To store the id of the approved appointment
var name;
var formdoctor;
var formdate;


// Function to handle the approve button click
$('.edit-btn').on('click', function() {
    approvedId = $(this).data('id');
    var email = $(this).closest('tr').find('.email').text();
    $('#recipientEmail').val(email); // Populate recipient email field
});

// Function to handle the confirm approve button click
$('#confirmApprove').on('click', function() {
    var id = approvedId;
    var token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: '/appointment/' + id + '/approve',
        method: 'POST',
        data: {
            _token: token
        },
        success: function(response) {
            if(response.status === 'success') {
                name = response.data.firstname+' '+response.data.lastname
                var email = response.data.email;
                var subject = "Appointment Approved";
                var body = emailBody(name, $('#doctor').val())
                // var body = "Hi " + name + "! This is Baptist Hospital. Your request has been approved. Your doctor will be Dr."+ $('#doctor').val() +". Here's your appointment schedule: ";
                $('#appID').val(approvedId);
                $('#emailSubject').val(subject);
                $('#emailBody').val(body);
                // $('#approveModal').modal('toggle');
                $('#approveModal .close').click();
                $('.modal .fade').removeClass('show')
                $('.modal-backdrop.fade').hide()
                $('#emailModal').modal('show');
            }
        }
    });
});

function emailBody(name, doctor, date=""){
    var body = "Hi " + name + "! This is Baptist Hospital. Your request has been approved. Your doctor will be Dr."+ doctor +". Here's your appointment schedule: "+ date;

    return body
}

$('#doctor').on('change',function(){
    console.log('testdoctor')
    formdoctor = $(this).val()
    var bods = emailBody(name, formdoctor, formdate)
    $('#emailBody').val(bods);
})

$('#appointmentDate').on('change',function(){
    var datetimeValue = $(this).val();
    var date = new Date(datetimeValue);

    var formattedDate = formatDate(date);
    console.log(formattedDate);
    var body = $('#emailBody').val()+formattedDate
    $('#emailBody').val(body);
})

function formatDate(date) {
    var optionsDate = { year: 'numeric', month: 'long', day: 'numeric' };
    var optionsTime = { hour: 'numeric', minute: '2-digit', hour12: true };

    var formattedDate = date.toLocaleDateString('en-US', optionsDate);
    var formattedTime = date.toLocaleTimeString('en-US', optionsTime);

    formdate = formattedDate + ' ' + formattedTime
    return formattedDate + ' ' + formattedTime
}

// Function to handle the delete button click
$('.delete-btn').on('click', function() {
    var id = $(this).data('id');
    var token = $('meta[name="csrf-token"]').attr('content');

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, reject it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '/appointment/' + id + '/reject',
                method: 'POST',
                data: {
                    _token: token
                },
                success: function(response) {
                    if(response.status === 'success') {
                        Swal.fire(
                            'Rejected!',
                            'The appointment has been rejected.',
                            'success'
                        );
                        $('tr[data-id="' + id + '"] .status').text('Rejected');
                        location.reload()
                    }
                }
            });
        }
    });
});

// Initialize FullCalendar
// var calendarEl = document.getElementById('calendar');
// var calendar = new FullCalendar.Calendar(calendarEl, {
//     initialView: 'dayGridMonth',
//     selectable: true,
//     select: function(info) {
//         var selectedDate = info.startStr;
//         var name = $('tr[data-id="' + approvedId + '"] .firstname').text();
//         var email = $('#recipientEmail').val();
//         var subject = "Appointment Approved";
//         var body = "Hi " + name + "! This is Baptist Hospital. Your request has been approved. Here's your appointment schedule: " + selectedDate;
//         $('#emailSubject').val(subject);
//         $('#emailBody').val(body);
//         $('#appointmentDate').val(selectedDate); // Set the selected date
//         $('#emailModal').modal('show'); // Show the email modal when a date is selected
//     },
//     headerToolbar: {
//         left: 'prev,next today',
//         center: 'title',
//         right: 'dayGridMonth,timeGridWeek,timeGridDay'
//     },
//     dateClick: function(info) {
//         $('#appointmentDate').val(info.dateStr + 'T00:00'); // Set the selected date
//         $('#emailModal').modal('show'); // Show the email modal when a date is selected
//     }
// });
// calendar.render();


// Function to handle send email button click
$('#sendEmailBtn').on('click', function() {
    console.log('Send Email button clicked'); // Debugging statement
    var formData = {
        recipientEmail: $('#recipientEmail').val(),
        emailSubject: $('#emailSubject').val(),
        emailBody: $('#emailBody').val(),
        appointmentDate: $('#appointmentDate').val(),
        doctor: $('#doctor').val(),
        appID: $('#appID').val(),
        _token: $('meta[name="csrf-token"]').attr('content')
    };

    $.ajax({
        url: '/appointment/sendEmail',
        method: 'POST',
        data: formData,
        success: function(response) {
            if(response.status === 'success') {
                Swal.fire(
                    'Sent!',
                    'The email has been sent.',
                    'success'
                );
                $('#emailModal').modal('hide');
                location.reload()
            }
        }
    });
});

$('#emailModal').on('shown.bs.modal', function() {
    $.ajax({
        url: '/typography', // Replace '/doctors' with the actual route to fetch doctors
        method: 'GET',
        success: function(response) {
            if(response.status === 'success') {
                var doctors = response.doctors;
                var select = $('#doctor');
                select.empty(); // Clear previous options
                $.each(doctors, function(index, doctor) {
                    var fullName = doctor.firstname + ' ' + doctor.lastname;
                    select.append($('<option></option>').attr('value', doctor.id).text(fullName));
                });
            }
        }
    });
});
});
</script>
@endsection
</body>
</html>
