<?php

namespace App\Http\Controllers;

use App\Models\Child;
use Illuminate\Http\Request;

class ChildRecordController extends Controller
{
    public function index() {
        $childs = Child::all();
        $active = 'child';
        return view('admin.child', compact('active', 'childs'));
    }

    public function store(Request $request) {

        try {
            $validatedData = $request->validate([
                'mothers_name' => 'required|string',
                'last_name' => 'required|string',
                'first_name' => 'required|string',
                'middle_name' => 'nullable|string',
                'gender' => 'required|in:M,F',
                'birthdate' => 'required|date',
                'weight' => 'required|integer',
                'height' => 'required|integer',
            ]);

            Child::create($validatedData);

            return redirect()->back()->with('success', 'Child record added successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong. Child record not added.');
        }

    }

    public function destroy(Request $request) {

        try {
            $child = Child::findOrFail($request->id);

            $child->delete();

            return redirect()->back()->with('success', 'Child record deleted successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Child record not found.');
        }
    }

    public function edit($id)
    {
        $child = Child::findOrFail($id);
        return response()->json(['child' => $child]);
    }

    public function update(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'id' => 'required|integer',
                'mothers_name' => 'required|string',
                'last_name' => 'required|string',
                'first_name' => 'required|string',
                'middle_name' => 'nullable|string',
                'gender' => 'required|in:M,F',
                'birthdate' => 'required|date',
                'weight' => 'required|integer',
                'height' => 'required|integer',
            ]);

            $child = Child::findOrFail($validatedData['id']);
            $child->update($validatedData);

            return redirect()->back()->with('success', 'Child record updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Child record not found.');
        }
    }
}
