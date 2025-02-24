<?php

namespace App\Http\Controllers;

use App\Models\HouseHoldModel;
use App\Models\FamilyMemberModel;
use Illuminate\Http\Request;

class CensusModelController extends Controller
{
    public function index()
    {

    }

    public function create()
    {
        return view('bhw.pages.census_form');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'house_no' => 'required|string|max:255',
                'head_of_fam' => 'required|string|max:255',
                'toilet_facility' => 'required|in:Yes,No',
                'water_source' => 'required|in:Yes,No',
                'family_members' => 'required|array|min:1',
                'family_members.*.full_name' => 'required|string|max:255',
                'family_members.*.relation_to_hfam' => 'required|string|max:255',
                'family_members.*.birthday' => 'required|date|before:today',
                'family_members.*.age' => 'required|integer|min:0',
                'family_members.*.civil_status' => 'required|in:Single,Married,Widowed,Divorced,Annulled',
                'family_members.*.sex' => 'required|in:Male,Female',
                'family_members.*.edu_attainment' => 'required|in:College Graduate,College Undergraduate,High School Graduate,High School Undergraduate,Grade School,Elementary',
                'family_members.*.religion' => 'required|string|max:255',
                'family_members.*.fam_planning' => 'required|string|max:255',
                'family_members.*.phihealth_no' => 'required|string|max:255',
                'family_members.*.membership_type' => 'required|in:Dependent,Independent',
                'family_members.*.medical_history' => 'required|string|max:255',
                'family_members.*.voters' => 'required|in:Yes,No',
            ]);
    
            $household = HouseHoldModel::create([
                'house_no' => $validated['house_no'],
                'head_of_fam' => $validated['head_of_fam'],
                'toilet_facility' => $validated['toilet_facility'],
                'water_source' => $validated['water_source'],
            ]);
    
            foreach ($validated['family_members'] as $memberData) {
                \Log::info('Single member data: ' . json_encode($memberData));
                $household->familyMembers()->create([
                    'full_name' => $memberData['full_name'],
                    'relation_to_hfam' => $memberData['relation_to_hfam'],
                    'birthday' => $memberData['birthday'],
                    'age' => $memberData['age'],
                    'civil_status' => $memberData['civil_status'],
                    'sex' => $memberData['sex'],
                    'edu_attainment' => $memberData['edu_attainment'],
                    'religion' => $memberData['religion'],
                    'fam_planning' => $memberData['fam_planning'],
                    'phihealth_no' => $memberData['phihealth_no'],
                    'membership_type' => $memberData['membership_type'],
                    'voters' => $memberData['voters'],
                    'medical_history' => $memberData['medical_history'],
                ]);
            }
    
            return redirect()->route('bhw.census-form')->with('success', 'Census data submitted successfully!');
        } catch (\Exception $e) {
            \Log::error('Census form submission failed: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'An error occurred while saving the data.']);
        }
    }


    public function show(HouseHoldModel $household, FamilyMemberModel $family_member)
    {
        
    }

   
    public function edit(HouseHoldModel $household, FamilyMemberModel $family_member)
    {
        
    }


    public function update(Request $request, HouseHoldModel $household, FamilyMemberModel $family_member)
    {
    }

   
    public function destroy(HouseHoldModel $household, FamilyMemberModel $family_member)
    {
        
    }
}
