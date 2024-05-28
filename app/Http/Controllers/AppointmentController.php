<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\AppointmentApproved;
use Illuminate\Support\Facades\Mail;
use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Support\Facades\Crypt;

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
        $body = $request->input('emailBody');

        $id = Crypt::decryptString($request->appID);
        $appointment = Appointment::find($id);
        $appointment->doctor = $request->doctor;
        $appointment->save();
        
        // Mail::to($email)->send(new AppointmentApproved($subject, $body));

        return response()->json(['status' => 'success']);
    }
    
    public function approve($id)
    {
        $id = Crypt::decryptString($id);
        $appointment = Appointment::findOrFail($id);
        $appointment->status = 'Approved';
        $appointment->dateApproved = \CARBON\CARBON::NOW();
        $appointment->save();

        //  // Send approval email
        // $this->sendApprovalEmail($appointment);

        return response()->json(['status' => 'success', 'data' => $appointment]);
    }


    public function cancel($id)
    {
        $id = Crypt::decryptString($id);
        $appointment = Appointment::findOrFail($id);
        $appointment->status = 'Rejected';
        $appointment->save();

        return response()->json(['status' => 'success']);
    }

    public function store(Request $request)
    {
        // dd(Auth()->user()->email);
        $validatedData = $request->validate([
            // 'firstname' => 'required|string|max:255',
            // 'lastname' => 'required|string|max:255',
            // 'middlename' => 'required|string|max:255',
            'birthday' => 'required',
            'address' => 'required|string|max:255',
            // 'email' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
            'reason' => 'required|string|max:255',
        ]);

        // $birthdate = $validatedData['birthdate_year'] . '-' . $validatedData['birthdate_month'] . '-' . $validatedData['birthdate_day'];

        $appointment = new Appointment();
        $appointment->firstname = Auth()->user()->name;
        $appointment->lastname = ' ';
        $appointment->middlename =  ' ';
        $appointment->birthdate = $validatedData['birthday'];
        $appointment->address = $validatedData['address'];
        $appointment->email = Auth()->user()->email;
        $appointment->phone_number = $validatedData['phone_number'];
        $appointment->reason = $validatedData['reason'];
        $appointment->userId = auth()->id();
        $appointment->save();

        return response()->json(['message' => 'Appointment submitted successfully'], 200);
    }

    public function index()
    {
        $appointments = Appointment::all();
        $doctors = Doctor::all();
        return view('pages.icons', compact('appointments','doctors'));
    }
    
    function getAppointment($id){
        $id = Crypt::decryptString($id);
        $appointment = Appointment::findOrFail($id);
        return response()->json(['status' => 'success', 'data' =>  $appointment]);
    }
    function deleteAppointment($id){
        $id = Crypt::decryptString($id);
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();
        return response()->json(['status' => 'success']);
    }

    function saveAppointment(Request $request){
        $validatedData = $request->validate([
            // 'firstname' => 'required|string|max:255',
            // 'lastname' => 'required|string|max:255',
            // 'middlename' => 'required|string|max:255',
            'birthdate' => 'required',
            'address' => 'required|string|max:255',
            // 'email' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
            'reason' => 'required|string|max:255',
        ]);
        $id = Crypt::decryptString($request['appId']);
        $appointment = Appointment::findOrFail($id);
        // $appointment->firstname = $validatedData['firstname'];
        // $appointment->lastname = $validatedData['lastname'];
        // $appointment->middlename = $validatedData['middlename'];
        // $appointment->birthdate = $validatedData['birthdate'];
        // $appointment->address = $validatedData['address'];
        // $appointment->email = $validatedData['email'];
        $appointment->phone_number = $validatedData['phone_number'];
        $appointment->reason = $validatedData['reason'];
        $appointment->save();

        return response()->json(['message' => 'Appointment updated successfully', 'status' => 'success'],200);
    }


}
