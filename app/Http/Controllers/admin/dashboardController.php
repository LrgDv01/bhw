<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Farm\FarmModel;
use App\Models\admin\PCA;
use App\Models\admin\DOA;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class dashboardController extends Controller
{
    public function display_dashboard() {

        return view('admin.dashboard');
    }
    public function get_dashboard_info()
    { 

        // $count_total_cost = PCA::all()->count();
        $count_total_cost = PCA::sum('total_cost');
         // count total farmers
        $count_farmers = User::where('user_type', '=', '1')->count();
         // count total farms
        $count_farms = FarmModel::all()->count();
        $count_doa = DOA::all()->count();

        $res = [
            'count_total_cost' => $count_total_cost,
            'count_farmers' => $count_farmers,
            'count_farms' => $count_farms,
            'count_doa' => $count_doa,
        ];
        return response()->json($res);
    }

}
