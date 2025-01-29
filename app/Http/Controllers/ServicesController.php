<?php

namespace App\Http\Controllers;
use App\Models\admin\admin_mdwf\Schedule;
use App\Models\User;
use App\Models\Announcement;
use App\Models\ServicesModel;
use App\Models\DutySchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class ServicesController extends Controller
{
    
    public function announcement()
    {   
        $announcements = Announcement::all();
        return view('bhw.pages.Announcement',compact('announcements'));
    }


    public function schedule() {
        $schedules = Schedule::all();
        return view('bhw.pages.schedule', compact('schedules'));

    }
    public function duty() {
        $duty_schedules = DutySchedule::all();
        return view('bhw.pages.duty', compact('duty_schedules'));

    }

    
    public function child() {
        return view('bhw.pages.child');
        
    }

    public function updateStatus(Request $request, $id, $status)
    {
        try {
            
            $requestDetails = ServicesModel::findOrFail($id);
            $requestDetails->status = $status;
            $requestDetails->save();
    
            return response()->json([
                'success' => true,
                'message' => "Request has been successfully {$status}."
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing your request.'
            ], 500);
        }
    }
    
}
