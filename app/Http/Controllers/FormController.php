<?php

namespace App\Http\Controllers;

use App\Models\BhwForm;
use App\Models\ChildCensus;
use App\Models\FamilyMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FormController extends Controller
{
    
    public function showForm()
    {
        return view('bhw.pages.services'); 
    }

    public function saveForm(Request $request)
    {
        // Validate request data
        $request->validate([
            'house_no' => 'required|integer',
            'first_name' => 'required|string',
            'middle_name' => 'nullable|string',
            'last_name' => 'required|string',
            'role_in_family' => 'required|string',
            'age' => 'required|integer',
            'date_of_birth' => 'required|date',
            'senior_citizen' => 'required|in:Yes,No',
            'next_midwife_visit' => 'nullable|date',
            'next_clinic_visit' => 'nullable|date',
            'civil_status' => 'required|in:Single,Married,Widowed,Divorced,Separated',
            'registered_voter' => 'required|in:Yes,No',
            'four_ps_member' => 'required|in:Yes,No',
            'months_pregnant' => 'nullable|integer',
            'next_checkup' => 'nullable|date',
            'family_planning' => 'required|in:Yes,No',
            'own_toilet' => 'required|in:Yes,No',
            'birth_plan' => 'required|in:Yes,No',
            'clean_water_source' => 'required|in:Yes,No',
            'hypertension_experience' => 'required|in:Yes,No',
            'pregnant' => 'required|in:Yes,No',
            'tb_symptoms' => 'required|in:Yes,No',
            'sputum_test' => 'nullable|in:Yes,No',
            'sputum_result' => 'nullable|in:Negative,Positive',
            'tb_treatment_partner' => 'required|in:Yes,No',
        ]);

        // Ensure the correct model is used
        FamilyMember::create($request->all());

        return redirect()->route('bhw.services')->with('success', 'Record added successfully.');
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
    public function print()
    {
        // Retrieve BHW data
        $bhwData = BhwForm::all(); // Or use more specific queries to get the data
        $childs = ChildCensus::all();
        // Retrieve counts
        $counts = [
            'vaccines' => [
                'BCG' => ChildCensus::whereJsonContains('vaccines', 'BCG')->count(),
                'VitaminA' => ChildCensus::whereJsonContains('vaccines', 'VitaminA')->count(),
            ],  
            'family_planning' => [
                'YES' => DB::table('family_members')->where('family_planning', 'YES')->count(),
                'NO' => DB::table('family_members')->where('family_planning', 'NO')->count(),
            ],
            'own_toilet' => [
                'YES' => DB::table('family_members')->where('own_toilet', 'YES')->count(),
                'NO' => DB::table('family_members')->where('own_toilet', 'NO')->count(),
            ],
            'birth_plan' => [
                'YES' => DB::table('family_members')->where('birth_plan', 'YES')->count(),
                'NO' => DB::table('family_members')->where('birth_plan', 'NO')->count(),
            ],
            'clean_water_source' => [
                'YES' => DB::table('family_members')->where('clean_water_source', 'YES')->count(),
                'NO' => DB::table('family_members')->where('clean_water_source', 'NO')->count(),
            ],
            'hypertension_experience' => [
                'YES' => DB::table('family_members')->where('hypertension_experience', 'YES')->count(),
                'NO' => DB::table('family_members')->where('hypertension_experience', 'NO')->count(),
            ],
            'pregnant' => [
                'YES' => DB::table('family_members')->where('pregnant', 'YES')->count(),
                'NO' => DB::table('family_members')->where('pregnant', 'NO')->count(),
            ],
            'tb_symptoms' => [
                'YES' => DB::table('family_members')->where('tb_symptoms', 'YES')->count(),
                'NO' => DB::table('family_members')->where('tb_symptoms', 'NO')->count(),
            ],
            'sputum_test' => [
                'YES' => DB::table('family_members')->where('sputum_test', 'YES')->count(),
                'NO' => DB::table('family_members')->where('sputum_test', 'NO')->count(),
            ],
            'tb_treatment_partner' => [
                'YES' => DB::table('family_members')->where('tb_treatment_partner', 'YES')->count(),
                'NO' => DB::table('family_members')->where('tb_treatment_partner', 'NO')->count(),
            ],
            'sputum_result' => [
                'YES' => DB::table('family_members')->where('sputum_result', 'Positive')->count(),
                'NO' => DB::table('family_members')->where('sputum_result', 'Negative')->count(),
            ],
        ];

        
        return view('bhw.pages.print', compact('bhwData', 'counts', 'childs'));
    }


}
