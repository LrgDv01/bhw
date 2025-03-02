<?php

namespace App\Http\Controllers;

use App\Models\BhwForm;
use App\Models\ChildCensus;
use App\Models\MaternalCare;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MaternalCareController extends Controller
{
    public function index()
    {
        return view('bhw.pages.maternal_care'); 
    }
    
    public function submitReport(Request $request)
    {
        $request->validate([
            'serial_no' => 'required|integer',
            'full_name' => 'required|string',
            'address' => 'required|string',
            'se_status' => 'required|string',
            'age' => 'required|integer',
            'lmp' => 'required|date',
            'edc' => 'required|date',
            'first_tri' => 'required|date',
            'second_tri' => 'required|date',
            'third_tri' => 'required|date',
            'td1' => 'required|date',
            'td2' => 'required|date',
            'td3' => 'required|date',
            'td4' => 'required|date',
            'td5' => 'required|date',
            'iron_visit1' => 'required|date',
            'iron_tablets_1' => 'required|integer',
            'iron_visit2' => 'required|date',
            'iron_tablets_2' => 'required|integer',
            'iron_visit3' => 'required|date',
            'iron_tablets_3' => 'required|integer',
            'iron_visit4' => 'required|date',
            'iron_tablets_4' => 'required|integer',
            'cal_visit2' => 'required|date',
            'cal_tablets_2' => 'required|integer',
            'cal_visit3' => 'required|date',
            'cal_tablets_3' => 'required|integer',
            'cal_visit4' => 'required|date',
            'cal_tablets_4' => 'required|integer',
            'iodine_visit1' => 'required|date',
            'bmi' => 'required|string',
            'deworming_tablet' => 'required|date',
            'syph' => 'required|date',
            'hepa' => 'required|date',
            'hiv' => 'required|date',
            'rpr_or_rdt' => 'required|string',
            'hbsag' => 'required|string',
        ]);

        MaternalCare::create($request->all());
        return redirect()->route('bhw.maternal-care')->with('success', 'Record added successfully.');
    }

    public function showList()
    {
        $familyMembers = MaternalCare::all(); 
        $childs = ChildCensus::all();
        return view('bhw.pages.list', compact('familyMembers','childs')); 
    }
    
    public function viewData($id)
    {
        $familyMember = MaternalCare::findOrFail($id);  
        return view('bhw.pages.viewData', compact('familyMember'));  
    }
    public function destroy($id)
    {
        $familyMember = MaternalCare::find($id);
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
                // 'YES' => DB::table('maternal_cares')->where('family_planning', 'Yes')->count(),
                // 'NO' => DB::table('maternal_cares')->where('family_planning', 'Yes')->count(),
            ],
            'own_toilet' => [
                'YES' => DB::table('households')->where('toilet_facility', 'Yes')->count(),
                'NO' => DB::table('households')->where('toilet_facility', 'No')->count(),
            ],
            'birth_plan' => [
                // 'YES' => DB::table('maternal_cares')->where('birth_plan', '')->count(),
                // 'NO' => DB::table('maternal_cares')->where('birth_plan', 'NO')->count(),
            ],
            'clean_water_source' => [
                'YES' => DB::table('households')->where('water_source', 'Yes')->count(),
                'NO' => DB::table('households')->where('water_source', 'No')->count(),
            ],
            'hypertension_experience' => [
                // 'YES' => DB::table('maternal_cares')->where('hypertension_experience', 'Yes')->count(),
                // 'NO' => DB::table('maternal_cares')->where('hypertension_experience', 'No')->count(),
            ],
            'pregnant' => [
                // 'YES' => DB::table('maternal_cares')->where('pregnant', 'Yes')->count(),
                // 'NO' => DB::table('maternal_cares')->where('pregnant', 'No')->count(),
            ],
            'tb_symptoms' => [
                // 'YES' => DB::table('maternal_cares')->where('tb_symptoms', 'Yes')->count(),
                // 'NO' => DB::table('maternal_cares')->where('tb_symptoms', 'No')->count(),
            ],
            'sputum_test' => [
                // 'YES' => DB::table('maternal_cares')->where('sputum_test', 'Yes')->count(),
                // 'NO' => DB::table('maternal_cares')->where('sputum_test', 'No')->count(),
            ],
            'tb_treatment_partner' => [
                // 'YES' => DB::table('maternal_cares')->where('tb_treatment_partner', 'Yes')->count(),
                // 'NO' => DB::table('maternal_cares')->where('tb_treatment_partner', 'No')->count(),
            ],
            'sputum_result' => [
                // 'YES' => DB::table('maternal_cares')->where('sputum_result', 'Positive')->count(),
                // 'NO' => DB::table('maternal_cares')->where('sputum_result', 'Negative')->count(),
            ],
        ];
        return view('bhw.pages.print', compact('bhwData', 'counts', 'childs'));
    }

}
