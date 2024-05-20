<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;

class PatientController extends Controller
{
    public function edit($id)
    {
        $patient = Patient::findOrFail($id);
        return response()->json($patient);
    }

    public function update(Request $request, $id)
    {
        $patient = Patient::findOrFail($id);

        $validatedData = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            // Update validation rules for birthdate_day, birthdate_month, and birthdate_year
            'birthdate_day' => 'required|integer',
            'birthdate_month' => 'required|string',
            'birthdate_year' => 'required|integer',
            'address' => 'required|string|max:255',
            'reason' => 'required|string|max:255',
        ]);

        $birthdate = $validatedData['birthdate_year'] . '-' . $validatedData['birthdate_month'] . '-' . $validatedData['birthdate_day'];


        $patient->firstname = $validatedData['firstname'];
        $patient->lastname = $validatedData['lastname'];
        $patient->birthdate = $birthdate;
        $patient->address = $validatedData['address'];
        $patient->reason = $validatedData['reason'];
        $patient->save();

        return response()->json($patient);
    }

    public function destroy($id)
    {
        $patient = Patient::findOrFail($id);
        $patient->delete();
        return response()->json(['message' => 'Patient deleted successfully']);
    }
    

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            // Add validation rules for birthdate_day, birthdate_month, and birthdate_year
            'birthdate_day' => 'required|integer',
            'birthdate_month' => 'required|string',
            'birthdate_year' => 'required|integer',
            'address' => 'required|string|max:255',
            'reason' => 'required|string|max:255',
        ]);

        $birthdate = $validatedData['birthdate_year'] . '-' . $validatedData['birthdate_month'] . '-' . $validatedData['birthdate_day'];

        $patient = new Patient();
        $patient->firstname = $validatedData['firstname'];
        $patient->lastname = $validatedData['lastname'];
        $patient->birthdate = $birthdate;
        $patient->address = $validatedData['address'];
        $patient->reason = $validatedData['reason'];
        $patient->save();

        return response()->json(['message' => 'Patient added successfully'], 200);
    }

    public function index()
        {
            $patients = Patient::all();
            return view('patients', compact('patients'));
        }

}
