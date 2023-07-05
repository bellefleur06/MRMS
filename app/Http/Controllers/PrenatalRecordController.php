<?php

namespace App\Http\Controllers;

use App\Models\Prenatal;
use Illuminate\Http\Request;

class PrenatalRecordController extends Controller
{
    public function index() {

        $patientCode = $this->generatePatientCode();
        $prenatals = Prenatal::all();
        $active = 'prenatal';
        return view('admin.prenatal', compact('active', 'prenatals', 'patientCode'));
    }

    public function generatePatientCode() {
        $latestPatient = Prenatal::latest()->first();

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
                'patient_name' => 'required|string',
                'prenatal_schedule' => 'required|date',
                'nurse_midwife' => 'required|string',
                'blood_pressure' => 'required|string',
                'weight' => 'required|integer',
                'tummy_size' => 'required|integer',
                'remarks' => 'required|string',
            ]);

            Prenatal::create($validatedData);

            return redirect()->back()->with('success', 'Prenatal record added successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong. Prenatal record not added.');
        }

    }

    public function destroy(Request $request) {

        try {
            $prenatal = Prenatal::findOrFail($request->id);

            $prenatal->delete();

            return redirect()->back()->with('success', 'Prenatal record deleted successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Prenatal record not found.');
        }
    }

    public function edit($id)
    {
        $prenatal = Prenatal::findOrFail($id);
        return response()->json(['prenatal' => $prenatal]);
    }

    public function update(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'id' => 'required|integer',
                'patient_code' => 'required|string',
                'patient_name' => 'required|string',
                'prenatal_schedule' => 'required|date',
                'nurse_midwife' => 'required|string',
                'blood_pressure' => 'required|string',
                'weight' => 'required|integer',
                'tummy_size' => 'required|integer',
                'remarks' => 'required|string',
            ]);

            $prenatal = Prenatal::findOrFail($validatedData['id']);
            $prenatal->update($validatedData);

            return redirect()->back()->with('success', 'Prenatal record updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Prenatal record not found.');
        }
    }
}
