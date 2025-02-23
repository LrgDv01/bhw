<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\MapModel;
use App\Models\Deworming;
use App\Models\WreproductiveAge;
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
        $value = (int)$matches[0];  

        if (strpos($age, 'month') !== false) {
            return $value; 
        } elseif (strpos($age, 'year') !== false) {
            return $value * 12;  
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
        $deworming = Deworming::whereYear('created_at', $year)->get();
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

        // Fetch historical deworming data 
        $historicalData = DB::table('dewormings')
            ->selectRaw("
                CONCAT(YEAR(created_at), '-', LPAD(MONTH(created_at) - MOD(MONTH(created_at) - 1, 6), 2, '0')) as period,
                CASE 
                    WHEN age LIKE '%months' THEN 
                        CASE 
                            WHEN CAST(SUBSTRING_INDEX(age, ' ', 1) AS UNSIGNED) BETWEEN 12 AND 23 THEN '12-23 months'
                            WHEN CAST(SUBSTRING_INDEX(age, ' ', 1) AS UNSIGNED) BETWEEN 24 AND 59 THEN '24-59 months'
                            ELSE 'Other'
                        END
                    WHEN age LIKE '%years' THEN 
                        CASE 
                            WHEN CAST(SUBSTRING_INDEX(age, ' ', 1) AS UNSIGNED) BETWEEN 5 AND 9 THEN '5-9 years'
                            WHEN CAST(SUBSTRING_INDEX(age, ' ', 1) AS UNSIGNED) BETWEEN 10 AND 19 THEN '10-19 years'
                            ELSE 'Other'
                        END
                    ELSE 'Other'
                END as age_group,
                COUNT(*) as total
            ")
            ->whereNotNull('created_at')
            ->groupBy('period', 'age_group')
            ->orderBy('period', 'ASC')
            ->get();
        $formattedData = [];
        foreach ($historicalData as $row) {
            $period = $row->period;
            $ageGroup = $row->age_group;
            $count = $row->total;
            if (!isset($formattedData[$period])) {
                $formattedData[$period] = [];
            }
            $formattedData[$period][$ageGroup] = ($formattedData[$period][$ageGroup] ?? 0) + $count;
        }

        // Forecasting functions with input validation
        function weightedMovingAverage(array $data, array $weights) {
            if (empty($data) || empty($weights) || count($data) !== count($weights)) {
                return 0;
            }
            $weightedSum = 0;
            $weightTotal = array_sum($weights);
            if ($weightTotal == 0) {
                return 0;
            }
            foreach ($data as $index => $value) {
                $weightedSum += $value * $weights[$index];
            }
            return round($weightedSum / $weightTotal);
        }
        function holtWintersForecast(array $data, float $alpha = 0.5) {
            if (empty($data)) {
                return 0;
            }
            $smoothed = [$data[0]]; 
            $alpha = max(0, min(1, $alpha)); 
            for ($i = 1; $i < count($data); $i++) {
                $smoothed[] = round($alpha * $data[$i] + (1 - $alpha) * end($smoothed));
            }
            return end($smoothed);
        }
        $forecastedData = [];
        $periods = array_keys($formattedData);
        if (empty($periods)) {
        return response()->json([
            'historicalDewormingData' => [],
            'forecastedDewormingData' => []
        ]);
        }

        $weights = [0.5, 0.3, 0.2]; 
        $ageGroups = ["12-23 months", "24-59 months", "5-9 years", "10-19 years"];
        sort($periods);
        $lastPeriods = array_slice($periods, -3); 
        foreach ($lastPeriods as $basePeriod) {
            $nextPeriod = date('Y-m', strtotime("+6 months", strtotime($basePeriod)));
            foreach ($ageGroups as $ageGroup) {
                $historicalValues = [];
                foreach ($periods as $period) {
                    $historicalValues[] = $formattedData[$period][$ageGroup] ?? 0;
                }
                if (empty(array_filter($historicalValues))) {
                    $forecastedData[$nextPeriod][$ageGroup] = 0;
                    continue;
                }
                $recentData = array_slice($historicalValues, -3, 3, true);
                $recentData = array_filter($recentData, fn($v) => $v > 0);
                if (count($recentData) >= 2) {
                    $forecastedData[$nextPeriod][$ageGroup] = weightedMovingAverage(
                        array_values($recentData),
                        $weights
                    );
                } else {
                    $forecastedData[$nextPeriod][$ageGroup] = holtWintersForecast(
                        array_values($recentData)
                    );
                }
                // Ensure non-negative forecast
                $forecastedData[$nextPeriod][$ageGroup] = max(0, $forecastedData[$nextPeriod][$ageGroup]);
            }
        }

        // Women Reproductive Data
        $yearData = WreproductiveAge::whereYear('created_at', $year)->get(); 
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
        
        $res = [
            'brgys' => $brgys,
            'residents' => $residents,
            'dewormingAgeRanges' => $dewormingAgeRanges,
            'historicalDewormingData' => $formattedData,
            'forecastedDewormingData' => $forecastedData,
            'yearDataWithMonth' => $yearDataWithMonth,
            'womenAgeRanges' => $womenAgeRanges
        ]; 
        return response()->json($res, 200, [], JSON_PRETTY_PRINT);

    }
}
