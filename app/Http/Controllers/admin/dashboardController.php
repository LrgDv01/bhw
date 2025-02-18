<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\MapModel;
use App\Models\Dewormings;
use App\Models\Women;
use DateTime;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class dashboardController extends Controller
{
    
    public function display_dashboard() {
        return view('admin.dashboard');
    }

    // Helper function to convert age to months
    private function convertAgeToMonths($age)
    {
        preg_match('/(\d+)/', $age, $matches);
        $value = (int)$matches[0];  // Extract numeric value

        if (strpos($age, 'month') !== false) {
            return $value;  // If it's months
        } elseif (strpos($age, 'year') !== false) {
            return $value * 12;  // Convert years to months
        }

        return 0;
    }

    public function get_dashboard_info(Request $request)
    { 
        $brgys = MapModel::all();
            // ->pluck('name')
            // ->toArray();
        $residents = MapModel::selectRaw('SUM(population) as population,
            SUM(women) as women,
            SUM(child) as child')
            ->first();

        $year = $request->input('year');

        // Deworming Data
        $deworming = Dewormings::whereYear('created_at', $year)->get();
        $dewormingAgeRanges = [
            '12-23 months' => 0,
            '24-59 months' => 0,
            '5-9 years' => 0,
            '10-19 years' => 0,
        ];

        foreach ($deworming as $record) {
            $age = $record->age;
            $ageInMonths = 0;
            $ageInYears = 0;
    
            if (strpos($age, 'month') !== false) {
                preg_match('/(\d+)\s+months?/', $age, $matches);
                $ageInMonths = (int) $matches[1]; 
            } elseif (strpos($age, 'year') !== false) {
                preg_match('/(\d+)\s+years?/', $age, $matches);
                $ageInYears = (int) $matches[1]; 
            }
    
            if ($ageInMonths > 0) {
                if ($ageInMonths >= 12 && $ageInMonths <= 23) {
                    $dewormingAgeRanges['12-23 months']++;
                } elseif ($ageInMonths >= 24 && $ageInMonths <= 59) {
                    $dewormingAgeRanges['24-59 months']++;
                }
            }
    
            if ($ageInYears > 0) {
                if ($ageInYears >= 5 && $ageInYears <= 9) {
                    $dewormingAgeRanges['5-9 years']++;
                } elseif ($ageInYears >= 10 && $ageInYears <= 19) {
                    $dewormingAgeRanges['10-19 years']++;
                }
            }
        }

        // Women Reproductive Data
        $yearData = Women::whereYear('created_at', $year)->get(); 

        $womenAgeRanges = [
            '10-14' => [],
            '15-19' => [],
            '20-49' => []
        ];

        $yearDataWithMonth = $yearData->map(function ($item) use (&$womenAgeRanges) {
            $item->month = Carbon::parse($item->created_at)->format('F');

            if ($item->age >= 10 && $item->age <= 14) {
                $item->ageRange = '10-14';
                $womenAgeRanges['10-14'][] = $item;
            } elseif ($item->age >= 15 && $item->age <= 19) {
                $item->ageRange = '15-19';
                $womenAgeRanges['15-19'][] = $item;
            } elseif ($item->age >= 20 && $item->age <= 49) {
                $item->ageRange = '20-49';
                $womenAgeRanges['20-49'][] = $item;
            }

            return $item;
        });
        
        // Historical Data 

        // $historicalData = DB::table('dewormings')
        // ->selectRaw("
        //     YEAR(created_at) as year,
        //     CASE 
        //         WHEN age LIKE '%months' AND CAST(SUBSTRING_INDEX(age, ' ', 1) AS UNSIGNED) BETWEEN 12 AND 23 THEN '12-23 months'
        //         WHEN age LIKE '%months' AND CAST(SUBSTRING_INDEX(age, ' ', 1) AS UNSIGNED) BETWEEN 24 AND 59 THEN '24-59 months'
        //         WHEN age LIKE '%years' AND CAST(SUBSTRING_INDEX(age, ' ', 1) AS UNSIGNED) BETWEEN 5 AND 9 THEN '5-9 years'
        //         WHEN age LIKE '%years' AND CAST(SUBSTRING_INDEX(age, ' ', 1) AS UNSIGNED) BETWEEN 10 AND 19 THEN '10-19 years'
        //         ELSE 'Other'
        //     END as age_group,
        //     COUNT(*) as total
        // ")
        // ->whereRaw("created_at IS NOT NULL") 
        // ->groupBy('year', 'age_group')
        // ->orderBy('year', 'ASC')
        // ->get();

      
        // $formattedData = [];
        // foreach ($historicalData as $row) {
        //     $year = $row->year;
        //     $ageGroup = $row->age_group;
        //     $total = $row->total;

        //     if (!isset($formattedData[$year])) {
        //         $formattedData[$year] = [
        //             "12-23 months" => 0,
        //             "24-59 months" => 0,
        //             "5-9 years" => 0,
        //             "10-19 years" => 0
        //         ];
        //     }

        //     if (isset($formattedData[$year][$ageGroup])) {
        //         $formattedData[$year][$ageGroup] = $total;
        //     }
        // }

        $historicalData = DB::table('dewormings')
        ->selectRaw("
            DATE_FORMAT(created_at, '%Y-%m') as month_year,
            CASE 
                WHEN age LIKE '%months' AND CAST(SUBSTRING_INDEX(age, ' ', 1) AS UNSIGNED) BETWEEN 12 AND 23 THEN '12-23 months'
                WHEN age LIKE '%months' AND CAST(SUBSTRING_INDEX(age, ' ', 1) AS UNSIGNED) BETWEEN 24 AND 59 THEN '24-59 months'
                WHEN age LIKE '%years' AND CAST(SUBSTRING_INDEX(age, ' ', 1) AS UNSIGNED) BETWEEN 5 AND 9 THEN '5-9 years'
                WHEN age LIKE '%years' AND CAST(SUBSTRING_INDEX(age, ' ', 1) AS UNSIGNED) BETWEEN 10 AND 19 THEN '10-19 years'
                ELSE 'Other'
            END as age_group,
            COUNT(*) as total
        ")
        ->whereNotNull('created_at')
        ->groupBy('month_year', 'age_group')
        ->orderBy('month_year', 'ASC')
        ->get();

    // Organizing data into the format expected by the frontend
    $formattedData = [];
    foreach ($historicalData as $row) {
        $yearMonth = $row->month_year;
        $ageGroup = $row->age_group;
        $count = $row->total;

        if (!isset($formattedData[$yearMonth])) {
            $formattedData[$yearMonth] = [];
        }
        $formattedData[$yearMonth][$ageGroup] = $count;
    }
    

        $res = [
            'brgys' => $brgys,
            'residents' => $residents,
            'dewormingAgeRanges' => $dewormingAgeRanges,
            'historicalDewormingData' => $formattedData,
            'yearDataWithMonth' => $yearDataWithMonth,
            'womenAgeRanges' => $womenAgeRanges
        ]; 
        return response()->json($res);
    }
}
