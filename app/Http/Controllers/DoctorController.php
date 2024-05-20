<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
// use Illuminate\Support\Facades\Validator;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::all();
        return view('pages.typography', compact('doctors'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
            'speciality' => 'required|string|max:255',
        ]);

        $doctor = new Doctor();
        $doctor->firstname = $validatedData['firstname'];
        $doctor->lastname = $validatedData['lastname'];
        $doctor->phone_number = $validatedData['phone_number'];
        $doctor->speciality = $validatedData['speciality'];
        $doctor->save();

        return response()->json(['message' => 'Doctor added successfully', 'doctor' => $doctor], 200);
    }

    public function edit($id)
    {
        $doctor = Doctor::findOrFail($id);
        return response()->json($doctor);
    }

    public function update(Request $request, $id)
    {
        $doctor = Doctor::findOrFail($id);

        $validatedData = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
            'speciality' => 'required|string|max:255',
        ]);

        $doctor->firstname = $validatedData['firstname'];
        $doctor->lastname = $validatedData['lastname'];
        $doctor->phone_number = $validatedData['phone_number'];
        $doctor->speciality = $validatedData['speciality'];
        $doctor->save();

        return response()->json($doctor);
    }

    public function destroy($id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->delete();
        return response()->json(['message' => 'Doctors deleted successfully']);
    }
}
