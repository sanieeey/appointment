<?php

namespace App\Http\Controllers;
use App\Http\Requests\UserRequest;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\User;
use App\Models\Appointment;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index(User $users)
    {
        $users = User::all();
        $isAdmin = auth()->user()->role === 'admin';
        return view('welcome', compact('users','isAdmin'));
    }


    public function pass()
    {
        $patients = Patient::all(); 
        return view('pages.tables', compact('patients'));

    }

    public function docpass()
    {
        $doctors = Doctor::all(); 
        return view('pages.typography', compact('doctors'));

    }

    public function progress()
    {
        $appointments = Appointment::where('userId',auth()->id())->get();
        return view('user.progress', compact('appointments'));
    }

    
}
