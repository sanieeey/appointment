<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;

class HistoryController extends Controller
{
    function index(){
        $appointments = Appointment::All();
        return view('pages.history',compact('appointments'));
    }
}
