<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\BookVisitationModel;
use App\Models\User;
use App\Models\Farm\FarmModel;
use App\Models\admin\PCA;
use App\Models\admin\DOA;
use App\Models\user_verification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class dashboardController extends Controller
{
    public function display_dashboard() {
        // if((in_array(1, auth()->user()->module_access()) || !auth()->user()->isAdmin())) {
        //     return view("admin.home");
        // }
        return view('admin.dashboard');
    }
    public function get_dashboard_info()
    { 
        // Count Logins 
        $count_login = AuditTrailModel::where("action", "login")->whereDate("created_at", today())
        ->count();
        $today = Carbon::today()->toDateString(); // Get today's date in Y-m-d format
        // Count Booking Now

        // Get current month and year
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        // count total cost
        // $count_total_cost = PCA::all()->count();
        $count_total_cost = PCA::sum('total_cost');
         // count total farmers
        $count_farmers = User::where('user_type', '=', '1')->count();
         // count total farms
        $count_farms = FarmModel::all()->count();
        $count_doa = DOA::all()->count();
            
        // count verification request  
        $count_verification = user_verification::
            select(
                DB::raw('COUNT(CASE WHEN userStatus = "0" THEN 1 END) as pending'),
                DB::raw('COUNT(CASE WHEN userStatus = "1" THEN 1 END) as approved'),
                DB::raw('COUNT(CASE WHEN userStatus = "3" THEN 1 END) as declined')
            )->first();

        $ret = [
            'count_login' => $count_login,
            'count_total_cost' => $count_total_cost,
            'count_farmers' => $count_farmers,
            'count_farms' => $count_farms,
            'count_doa' => $count_doa,
            'user_verification_counts' => $count_verification
        ];
        return response()->json($ret);
    }


    // public function get_users(Request $request) {
    //     $type = $request->type == "personel"? 1 : 2;
    //     $get_users = User::where('user_type', '!=', '0')
    //     ->leftJoin('blocked_account', 'users.id', '=', 'blocked_account.userID')
    //     ->leftJoin('unique_qr', 'unique_qr.userID', '=', 'users.id')
    //     ->leftJoin('user_verification', 'user_verification.userID', '=', 'users.id')
    //     ->select(   
    //         'users.*', 
    //         DB::raw('MD5(users.id) as encrypt_id'),
    //         DB::raw('CASE WHEN blocked_account.userID IS NULL THEN "Active" ELSE "blocked" END as status'), 
    //         'unique_qr.code as code', 
    //         'user_verification.userStatus', 
    //         'user_verification.id_type',
    //         'user_verification.id_file_url',
    //         DB::raw('COALESCE(user_verification.userStatus, "3") as userStatus')
    //     )
    //     ->where('user_type', $type)
    //     ->get();
    //     return response()->json($get_users);
    // }



    public function get_monthly_counts(Request $request) {
        $year = $request->year;
        // Get counts of approved and rejected requests grouped by month
        $counts = BookVisitationModel::select(
                DB::raw('MONTH(start_visit) as month'),
                DB::raw('YEAR(start_visit) as year'),
                DB::raw('SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) as approved_count'),
                DB::raw('SUM(CASE WHEN status = 3 THEN 1 ELSE 0 END) as rejected_count')
            )
            ->whereYear('start_visit', $year)
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        return response()->json($counts);
    }
}
