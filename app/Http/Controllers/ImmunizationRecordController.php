<?php

namespace App\Http\Controllers;

use App\Models\Immunization;
use Illuminate\Http\Request;

class ImmunizationRecordController extends Controller
{
    public function index() {
        $immunizations = Immunization::all();
        $active = 'immunization';
        return view('admin.immunization', compact('active', 'immunizations'));
    }

    public function store(Request $request) {

        try {
            $validatedData = $request->validate([
                'name' => 'required|string',
                'age' => 'required|integer',
                'immunization_type' => 'required|string',
                'immunization_date' => 'required|date',
                'remarks' => 'required|string',
            ]);

            Immunization::create($validatedData);

            return redirect()->back()->with('success', 'Immunization record added successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong. Immunization record not added.');
        }
    }

    public function destroy(Request $request) {

        try {
            $immunization = Immunization::findOrFail($request->id);

            $immunization->delete();

            return redirect()->back()->with('success', 'Immunization record deleted successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Immunization record not found.');
        }
    }

    public function edit($id)
    {
        $immunization = Immunization::findOrFail($id);
        return response()->json(['immunization' => $immunization]);
    }

    public function update(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'id' => 'required|integer',
                'name' => 'required|string',
                'age' => 'required|integer',
                'immunization_type' => 'required|string',
                'immunization_date' => 'required|date',
                'remarks' => 'required|string',
            ]);

            $immunization = Immunization::findOrFail($validatedData['id']);
            $immunization->update($validatedData);

            return redirect()->back()->with('success', 'Immunization record updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Immunization record not found.');
        }
    }
}
