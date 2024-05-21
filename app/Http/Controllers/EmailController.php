<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentApp;
// use Illuminate\Support\Facades\Validator;
// use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Notification;
use App\Notifications\InvoicePaid;
 

class EmailController extends Controller
{
    function sendEmail($userEmail, $userInvoice){
        Mail::to($userEmail)->send(new AppointmentApp($userEmail, $userInvoice));
    }
    function sendOTP($userEmail, $otp){
        Mail::to($userEmail)->send(new AppointmentApp($userEmail, $otp));
    }
    // public function generateOTP(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'email' => 'required|email',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json(['error' => $validator->errors()->first()]);
    //     }

    //     $subject = "Your OTP Code";
    //     $otp = strval(random_int(100000, 999999));

    //     session()->put('otp', $otp);

    //     Mail::to($request->email)->send(new OTPMail($request->email, $otp, $subject));

    //     return response()->json(['message' => 'success', 'otp' => $otp]);
    // }

    // public function verifyOTP(Request $request)
    // {
    //     $otp = $request->otp;
    //     $storedOTP = Session::get('otp');

    //     if ($otp === $storedOTP) {
    //         Session::forget('otp');
    //         return response()->json(['message' => 'OTP verified successfully']);
    //     } else {
    //         return response()->json(['error' => 'Invalid OTP']);
    //     }
    // }
}

