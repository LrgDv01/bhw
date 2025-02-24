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
            'se_status' => 'required',
            'client_type' => 'required',
            'source' => 'required',
            'previous_method' => 'required',
            'followup_month' => 'nullable|string|max:255',
            'schedule_date' => 'nullable|date',
            'actual_date' => 'nullable|date',
            'dropout_date' => 'nullable|date',
            'dropout_reason' => 'nullable|string',
        ]);
    
        FamilyPlanning::create($request->all());
    
        return redirect()->back()->with('success', 'Family Planning record added successfully.');
    }
    
}


