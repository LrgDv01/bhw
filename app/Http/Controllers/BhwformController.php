<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BhwForm;

class BhwFormController extends Controller
{
    

    public function showReport()
    {
        // Fetch the data from the database (make sure to adjust as per your table structure)
        $bhwData = BhwForm::all(); // Or use more specific queries to get the data

        return view('bhw.pages.print', compact('bhwData'));  // Pass the data to the view
    }


    public function bhwform()
    {
        return view('bhw.pages.bhwform');
    }

    public function store(Request $request)
    {
        $request->validate([
            'followed_up_pregnant_women' => 'required|integer',
            'newborn_babies' => 'required|integer',
            'newborn_screened' => 'required|integer',
            'home_births' => 'required|integer',
            'clinic_births' => 'required|integer',
            'hospital_births' => 'required|integer',
            'sputum_collected' => 'required|integer',
            'followed_up_for_vaccination' => 'required|integer',
            'followed_up_patients' => 'required|integer',
            'followed_up_patient' => 'required|integer',
            'mbhw_meeting_attendance' => 'required|integer',
            'pfbhw_meeting_attendance' => 'required|integer',
            'referred_patients' => 'required|integer',
            'non_referred_patients' => 'required|integer',
            'surveyed_families' => 'required|integer',
            'iodized_salt_sold' => 'required|integer',
            'clean_larvae_habitats' => 'required|integer',
            'total_births_in_area' => 'required|integer',
            'total_deaths_in_area' => 'required|integer',
        ]);

        BhwForm::create($request->all());
        return redirect()->route('bhw.Print')->with('success', 'BHW Form submitted successfully');
    }
}
