<?php

namespace App\Http\Controllers;

use App\Models\ChildCensus;
use App\Models\FamilyMember;
use Illuminate\Http\Request;

class FormController extends Controller
{
    
    public function showForm()
    {
        return view('bhw.pages.services'); 
    }

    public function saveForm(Request $request)
    {
        
        $validatedData = $request->validate([
            'house_no' => 'required|string',
            'full_name' => 'required|string',
            'role' => 'required|string',
            'dob' => 'required|date',
            'age' => 'required|integer',
            'is_4ps' => 'required|string',
            'is_senior_citizen' => 'required|string',
            'is_pregnant' => 'required|string',
            'pregnancy_months' => 'nullable|integer',
            'birth_plan' => 'required|string',
            'civil_status' => 'required|string',
            'next_visit' => 'required|date',
            'family_planning_method' => 'required|string',
            'is_registered_voter' => 'required|string',
            'own_toilet' => 'required|string',
            'clean_water' => 'required|string',
            'hypertension' => 'required|string',
            'next_visit_clinic' => 'nullable|date',
            'has_tb_symptoms' => 'required|string',
            'sputum_test' => 'nullable|string',
            'sputum_result' => 'nullable|string',
            'treatment_partner' => 'required|string',
            'next_checkup' => 'nullable|date',
        ]);
        

       
        FamilyMember::create([
            'house_no' => $validatedData['house_no'],
            'full_name' => $validatedData['full_name'],
            'role' => $validatedData['role'],
            'dob' => $validatedData['dob'],
            'age' => $validatedData['age'],
            'is_4ps' => $validatedData['is_4ps'],
            'is_senior_citizen' => $validatedData['is_senior_citizen'],
            'is_pregnant' => $validatedData['is_pregnant'],
            'pregnancy_months' => $validatedData['pregnancy_months'],
            'birth_plan' => $validatedData['birth_plan'],
            'civil_status' => $validatedData['civil_status'],
            'next_visit' => $validatedData['next_visit'],
            'family_planning_method' => $validatedData['family_planning_method'],
            'is_registered_voter' => $validatedData['is_registered_voter'],
            'own_toilet' => $validatedData['own_toilet'],
            'clean_water' => $validatedData['clean_water'],
            'hypertension' => $validatedData['hypertension'],
            'next_visit_clinic' => $validatedData['next_visit_clinic'],
            'has_tb_symptoms' => $validatedData['has_tb_symptoms'],
            'sputum_test' => $validatedData['sputum_test'],
            'sputum_result' => $validatedData['sputum_result'],
            'treatment_partner' => $validatedData['treatment_partner'],
            'next_checkup' => $validatedData['next_checkup'],
        ]);

        // Redirect with a success message
        return redirect()->route('bhw.services')->with('success', 'Added successfully!');
    }
    // Add this method to your FormController
    public function showList()
    {
        $familyMembers = FamilyMember::all();  // Fetch all family members from the database
        $childs = ChildCensus::all();
        return view('bhw.pages.list', compact('familyMembers','childs'));  // Pass the family members to the view
    }
    
    public function viewData($id)
    {
        $familyMember = FamilyMember::findOrFail($id);  // Find the family member by ID
        return view('bhw.pages.viewData', compact('familyMember'));  // Pass the data to the view
    }
    public function destroy($id)
    {
        $familyMember = FamilyMember::find($id);

        if ($familyMember) {
            $familyMember->delete();
            return redirect()->route('bhw.pages.list')->with('success', 'Family member deleted successfully!');
        }

        return redirect()->route('bhw.pages.familyMembersList')->with('error', 'Family member not found!');
    }


}
