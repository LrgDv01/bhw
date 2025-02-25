<?php

namespace App\Http\Controllers;

use App\Models\BhwForm;
use App\Models\ChildCensus;
use App\Models\MotherCensus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FormController extends Controller
{
    
    public function showForm()
    {
        return view('bhw.pages.mcensus'); 
    }

    public function saveForm(Request $request)
    {
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
        MotherCensus::create($request->all());
        return redirect()->route('bhw.mother-census')->with('success', 'Record added successfully.');
    }

    public function showList()
    {
        $familyMembers = MotherCensus::all(); 
        $childs = ChildCensus::all();
        return view('bhw.pages.list', compact('familyMembers','childs')); 
    }
    
    public function viewData($id)
    {
        $familyMember = MotherCensus::findOrFail($id);  
        return view('bhw.pages.viewData', compact('familyMember'));  
    }
    public function destroy($id)
    {
        $familyMember = MotherCensus::find($id);
        if ($familyMember) {
            $familyMember->delete();
            return redirect()->route('bhw.pages.list')->with('success', 'Family member deleted successfully!');
        }
        return redirect()->route('bhw.pages.familyMembersList')->with('error', 'Family member not found!');
    }
    public function print()
    {
        $bhwData = BhwForm::all();
        $childs = ChildCensus::all();
        $counts = [
            'vaccines' => [
                'BCG' => ChildCensus::whereJsonContains('vaccines', 'BCG')->count(),
                'VitaminA' => ChildCensus::whereJsonContains('vaccines', 'VitaminA')->count(),
            ],  
            'family_planning' => [
                'YES' => DB::table('mother_census')->where('family_planning', 'Yes')->count(),
                'NO' => DB::table('mother_census')->where('family_planning', 'Yes')->count(),
            ],
            'own_toilet' => [
                'YES' => DB::table('households')->where('toilet_facility', 'Yes')->count(),
                'NO' => DB::table('households')->where('toilet_facility', 'No')->count(),
            ],
            'birth_plan' => [
                'YES' => DB::table('mother_census')->where('birth_plan', '')->count(),
                'NO' => DB::table('mother_census')->where('birth_plan', 'NO')->count(),
            ],
            'clean_water_source' => [
                'YES' => DB::table('households')->where('water_source', 'Yes')->count(),
                'NO' => DB::table('households')->where('water_source', 'No')->count(),
            ],
            'hypertension_experience' => [
                'YES' => DB::table('mother_census')->where('hypertension_experience', 'Yes')->count(),
                'NO' => DB::table('mother_census')->where('hypertension_experience', 'No')->count(),
            ],
            'pregnant' => [
                'YES' => DB::table('mother_census')->where('pregnant', 'Yes')->count(),
                'NO' => DB::table('mother_census')->where('pregnant', 'No')->count(),
            ],
            'tb_symptoms' => [
                'YES' => DB::table('mother_census')->where('tb_symptoms', 'Yes')->count(),
                'NO' => DB::table('mother_census')->where('tb_symptoms', 'No')->count(),
            ],
            'sputum_test' => [
                'YES' => DB::table('mother_census')->where('sputum_test', 'Yes')->count(),
                'NO' => DB::table('mother_census')->where('sputum_test', 'No')->count(),
            ],
            'tb_treatment_partner' => [
                'YES' => DB::table('mother_census')->where('tb_treatment_partner', 'Yes')->count(),
                'NO' => DB::table('mother_census')->where('tb_treatment_partner', 'No')->count(),
            ],
            'sputum_result' => [
                'YES' => DB::table('mother_census')->where('sputum_result', 'Positive')->count(),
                'NO' => DB::table('mother_census')->where('sputum_result', 'Negative')->count(),
            ],
        ];
        return view('bhw.pages.print', compact('bhwData', 'counts', 'childs'));
    }


}
