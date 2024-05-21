<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\Appointment;
use App\Models\Doctor;

class UserController extends Controller
{
    /**
     * Display the user dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function dashboard()
    // {
    //     return view('user.userdashboard');
    // }


    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        return view('users.index', ['users' => $model->paginate(15)]);
    }

    public function dashboard()
    {
        $appointments = Appointment::where('userId', auth()->id())->get();
        $appointmentsInProgress = Appointment::where('status','in progress')
                                            ->where('userId', auth()->id())
                                            ->count();
        return view('user.userdashboard',compact(['appointments','appointmentsInProgress']));
    }


}
