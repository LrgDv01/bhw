<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
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

        $total_population =  User::where('user_type', '=', '1')->count();
        $total_maternal = 3334;
        $total_deworming = 343;
        $total_women = 3455;

        $res = [
            'total_population' => $total_population,
            'total_maternal' => $total_maternal,
            'total_deworming' => $total_deworming,
            'total_women' => $total_women,
        ];
        return response()->json($res);
    }
    
}
