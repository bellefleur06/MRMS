<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\Patient;
use App\Models\Immunization;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {

        $patient_count = Patient::count();
        $child_count = Child::count();
        $immunization_count = Immunization::count();
        $active = 'dashboard';
        return view('admin.dashboard', compact('active', 'patient_count', 'child_count', 'immunization_count'));
    }
}
