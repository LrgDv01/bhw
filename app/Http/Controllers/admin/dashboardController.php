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

        $res = [
            'brgys' => $brgys,
            'residents' => $residents
        ]; 
        return response()->json($res);
    }
}
