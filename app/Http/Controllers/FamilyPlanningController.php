<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FamilyPlanning;

class FamilyPlanningController extends Controller
{
    public function index()
    {
        return view('bhw.pages.familyplanning');
    }

    public function store(Request $request)
    {
        $request->validate([
            'serial_no' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'age_dob' => 'required|date',
            'se_status' => 'required|string|max:255',
            'client_type' => 'required|string|max:255',
            'source' => 'required|string|max:255',
            'previous_method' => 'required|string|max:255',
            'month' => 'required|string|max:255',
            'schedule_date' => 'required|date',
            'actual_date' => 'required|date',
            'dropout_date' => 'required|date',
            'dropout_reason' => 'required|string|max:255',
        ]);
    
        FamilyPlanning::create($request->all());
    
        return redirect()->back()->with('success', 'Family Planning record added successfully.');
    }
    
}


