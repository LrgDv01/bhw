<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\MapModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class dashboardController extends Controller
{
    
    public function display_dashboard() {

        return view('admin.dashboard');
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
        
        // $year = $request->input('year'); 
        // $yearData = MapModel::whereYear('created_at', $year)->get();


        $year = $request->input('year');
        $yearData = MapModel::whereYear('created_at', $year)->get();

        $yearDataWithMonth = $yearData->map(function ($item) {
            $item->month = Carbon::parse($item->created_at)->format('F'); // Get the month
            return $item;
        });

        $res = [
            'brgys' => $brgys,
            'residents' => $residents,
            'yearData' => $yearDataWithMonth
        ]; 
        return response()->json($res);
    }
}
