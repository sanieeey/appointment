<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\AppointmentApproved;
use Illuminate\Support\Facades\Mail;
use App\Models\Appointment;

class AppointmentController extends Controller
{
    public function sendEmail(Request $request)
    {
        $request->validate([
            'recipientEmail' => 'required|email',
            'emailSubject' => 'required|string',
            'emailBody' => 'required|string',
            'appointmentDate' => 'required|date'
        ]);

        $email = $request->input('recipientEmail');
        $subject = $request->input('emailSubject');
        $body = $request->input('emailBody') . ' Your appointment date is ' . $request->input('appointmentDate');

        Mail::to($email)->send(new AppointmentApproved($subject, $body));

        return response()->json(['status' => 'success']);
    }
    
    public function approve($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->status = 'Approved';
        $appointment->save();

        //  // Send approval email
        // $this->sendApprovalEmail($appointment);

        return response()->json(['status' => 'success']);
    }


    public function cancel($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->status = 'Rejected';
        $appointment->save();

        return response()->json(['status' => 'success']);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'middlename' => 'required|string|max:255',
            'birthdate_day' => 'required|integer',
            'birthdate_month' => 'required|string',
            'birthdate_year' => 'required|integer',
            'address' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
            'reason' => 'required|string|max:255',
        ]);

        $birthdate = $validatedData['birthdate_year'] . '-' . $validatedData['birthdate_month'] . '-' . $validatedData['birthdate_day'];

        $appointment = new Appointment();
        $appointment->firstname = $validatedData['firstname'];
        $appointment->lastname = $validatedData['lastname'];
        $appointment->middlename = $validatedData['middlename'];
        $appointment->birthdate = $birthdate;
        $appointment->address = $validatedData['address'];
        $appointment->email = $validatedData['email'];
        $appointment->phone_number = $validatedData['phone_number'];
        $appointment->reason = $validatedData['reason'];
        $appointment->save();

        return response()->json(['message' => 'Appointment submitted successfully'], 200);
    }

    public function index()
    {
        $appointments = Appointment::all();
        return view('pages.icons', compact('appointments'));
    }
    



}
