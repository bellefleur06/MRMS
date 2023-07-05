<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index() {

        $patientCode = $this->generatePatientCode();
        $patients = Patient::all();
        $active = 'patient';
        return view('admin.patient', compact('active', 'patients', 'patientCode'));
    }

    public function generatePatientCode() {
        $latestPatient = Patient::latest()->first();

        $nextId = null;
        if ($latestPatient) {
            $nextId = $latestPatient->id + 1;
        } else {
            $nextId = 1;
        }

        $formattedId = str_pad($nextId, 3, '0', STR_PAD_LEFT);
        $patientCode = 'PTN-' . $formattedId;

        return $patientCode;
    }

    public function store(Request $request) {

        try {
            $validatedData = $request->validate([
                'patient_code' => 'required|string',
                'first_name' => 'required|string',
                'middle_name' => 'nullable|string',
                'last_name' => 'required|string',
                'contact' => 'required|string',
                'email' => 'required|email',
                'address' => 'required|string',
                'birthdate' => 'required|date',
                'age' => 'required|integer',
            ]);

            $validatedData['status'] = 0;

            Patient::create($validatedData);

            return redirect()->back()->with('success', 'Patient record added successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong. Patient record not added.');
        }

    }

    public function destroy(Request $request) {

        try {
            $patient = Patient::findOrFail($request->id);

            $patient->delete();

            return redirect()->back()->with('success', 'Patient record deleted successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Patient record not found.');
        }
    }

    public function edit($id)
    {
        $patient = Patient::findOrFail($id);
        return response()->json(['patient' => $patient]);
    }

    public function update(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'id' => 'required|integer',
                'patient_code' => 'required|string',
                'first_name' => 'required|string',
                'middle_name' => 'nullable|string',
                'last_name' => 'required|string',
                'contact' => 'required|string',
                'email' => 'required|email',
                'address' => 'required|string',
                'birthdate' => 'required|date',
                'age' => 'required|integer',
                'status' => 'required|in:0,1'
            ]);

            $patient = Patient::findOrFail($validatedData['id']);
            $patient->update($validatedData);

            return redirect()->back()->with('success', 'Patient record updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Patient record not found.');
        }
    }
}
