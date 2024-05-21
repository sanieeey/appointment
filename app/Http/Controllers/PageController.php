<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\User;
use App\Models\Doctor;

class PageController extends Controller
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
     * Display all the static pages when authenticated
     *
     * @param string $page
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $users = User::All();
        $usersRole = User::where('role','user')->count();
        $doctors = Doctor::All();
        $appointments = Appointment::All();
        $appointmentsInProgress = Appointment::where('status','in progress')->count();
        if (view()->exists("pages.dashboard")) {
            return view("pages.dashboard",compact(['users','doctors','appointments','usersRole','appointmentsInProgress',]));
        }

        return abort(404);
    }
}
