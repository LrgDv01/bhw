<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AuditTrailModel;
use App\Models\BookVisitationModel;
use App\Models\User;
use App\Models\user_verification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class dashboardController extends Controller
{
    public function display_dashboard() {
        if((in_array(1, auth()->user()->module_access()) || !auth()->user()->isAdmin())) {
            return view("admin.home");
        }
        return view('admin.dashboard');
    }
    public function get_dashboard_info()
    {
        // Count Logins 
        $count_login = AuditTrailModel::where("action", "login")->whereDate("created_at", today())
        ->count();
        $today = Carbon::today()->toDateString(); // Get today's date in Y-m-d format
        // Count Booking Now
        $count_today_book = BookVisitationModel::whereDate('start_visit', $today . '00:00:00')->count();

        // Get current month and year
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        // Count approved bookings for the current month
        $count_virtual_approved_book = BookVisitationModel::where('status', 1)->where('type', "Virtual")
            ->whereMonth('start_visit', $currentMonth)
            ->whereYear('start_visit', $currentYear)
            ->count();

        // Count rejected bookings for the current month
        $count_virtual_rejected_book = BookVisitationModel::where('status', 3)->where('type', "Virtual")
            ->whereMonth('start_visit', $currentMonth)
            ->whereYear('start_visit', $currentYear)
            ->count();

        // Count pending bookings for the current month
        $count_virtual_pending_book = BookVisitationModel::where('status', 0)->where('type', "Virtual")
            ->whereMonth('start_visit', $currentMonth)
            ->whereYear('start_visit', $currentYear)
            ->count();

        // Count approved bookings for the current month
        $count_physical_approved_book = BookVisitationModel::where('status', 1)->where('type', "Physical")
            ->whereMonth('start_visit', $currentMonth)
            ->whereYear('start_visit', $currentYear)
            ->count();

        // Count rejected bookings for the current month
        $count_physical_rejected_book = BookVisitationModel::where('status', 3)->where('type', "Physical")
            ->whereMonth('start_visit', $currentMonth)
            ->whereYear('start_visit', $currentYear)
            ->count();

        // Count pending bookings for the current month
        $count_physical_pending_book = BookVisitationModel::where('status', 0)->where('type', "Physical")
            ->whereMonth('start_visit', $currentMonth)
            ->whereYear('start_visit', $currentYear)
            ->count();

        // count farmers
        $count_farmers = User::where('user_type', '!=', '0')->count();
            
        // count verification request 
        $count_verification = user_verification::
            select(
                DB::raw('COUNT(CASE WHEN userStatus = "0" THEN 1 END) as pending'),
                DB::raw('COUNT(CASE WHEN userStatus = "1" THEN 1 END) as approved'),
                DB::raw('COUNT(CASE WHEN userStatus = "3" THEN 1 END) as declined')
            )->first();

    

        $ret = [
            'count_login' => $count_login,
            'count_today_book' => $count_today_book,
            'count_virtual_approved_book' => $count_virtual_approved_book,
            'count_virtual_rejected_book' => $count_virtual_rejected_book,
            'count_virtual_pending_book' => $count_virtual_pending_book,
            'count_physical_approved_book' => $count_physical_approved_book,
            'count_physical_rejected_book' => $count_physical_rejected_book,
            'count_physical_pending_book' => $count_physical_pending_book,
            'count_farmers' => $count_farmers,
            'user_verification_counts' => $count_verification
        ];
        return response()->json($ret);
    }


    public function get_users(Request $request) {
        $type = $request->type == "personel"? 1 : 2;
        $get_users = User::where('user_type', '!=', '0')
        ->leftJoin('blocked_account', 'users.id', '=', 'blocked_account.userID')
        ->leftJoin('unique_qr', 'unique_qr.userID', '=', 'users.id')
        ->leftJoin('user_verification', 'user_verification.userID', '=', 'users.id')
        ->select(   
            'users.*', 
            DB::raw('MD5(users.id) as encrypt_id'),
            DB::raw('CASE WHEN blocked_account.userID IS NULL THEN "Active" ELSE "blocked" END as status'), 
            'unique_qr.code as code', 
            'user_verification.userStatus', 
            'user_verification.id_type',
            'user_verification.id_file_url',
            DB::raw('COALESCE(user_verification.userStatus, "3") as userStatus')
        )
        ->where('user_type', $type)
        ->get();
        return response()->json($get_users);
    }



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
