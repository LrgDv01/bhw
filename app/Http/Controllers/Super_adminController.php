<?php


namespace App\Http\Controllers;

use App\Models\Bhwregister;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Announcement;

class Super_adminController extends Controller
{

    public function announcement()
    {
        // Get the latest 5 announcements
        $announcements = Announcement::latest()->take(5)->get();

        // Return the view with the announcements data
        return view('admin.announcement', compact('announcements'));
    }
    public function summaryList()
    {
        // Return the view for the technician dashboard
        return view('admin.summary_list');
    }

    public function listBHW()
    {
        $bhwUsers = User::where('user_type', '2')
            ->whereHas('bhwInfo') 
            ->with('bhwInfo') 
            ->get(); 

        return view('admin.list_bhw', compact('bhwUsers'));
    }

    

    


}
