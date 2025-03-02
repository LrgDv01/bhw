<?php

namespace App\Http\Controllers;

use App\Models\BhwForm;
use Illuminate\Http\Request;

class SummaryListController extends Controller
{
    public function getCensus()
    {
        return view('user.summary-list.census');
    }
    public function getMaternalCare()
    {
        return view('user.summary-list.maternal_care');
    }
    public function getDeworming()
    {
        return view('user.summary-list.deworming');
    }
    public function getFamilyPlanning()
    {
        return view('user.summary-list.family_planning');
    }
    public function getWreproductiveAge()
    {
        return view('user.summary-list.women_reproductive');
    }
    public function getImmunization()
    {
        return view('user.summary-list.immunization');
    }
    public function getReport()
    {
        $bhwData = BhwForm::all();
        return view('user.summary-list.monthly_report', compact('bhwData')); 
    }


    public function getCensusAnalytics()
    {
        return view('user.analytics.census');
    }
    public function getMaternalCareAnalytics()
    {
        return view('user.analytics.maternal_care');
    }
    public function getDewormingAnalytics()
    {
        return view('user.analytics.deworming');
    }
    public function getFamilyPlanningAnalytics()
    {
        return view('user.analytics.family_planning');
    }
    public function getWreproductiveAgeAnalytics() 
    {
        return view('user.analytics.women_reproductive');
    }
    public function getImmunizationAnalytics()
    {
        return view('user.analytics.immunization');
    }

}
