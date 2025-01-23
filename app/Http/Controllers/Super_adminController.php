<?php


namespace App\Http\Controllers;

use App\Models\Bhwregister;
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
    public function summary()
    {
        // Return the view for the technician dashboard
        return view('super_admin.summary');
    }
    public function list_bhw()
    {
        // Return the view for the technician dashboard
        return view('admin.list_bhw');
    }
    public function bhwregistration()
    {
        return view('admin.bhwregistration');
    }

    public function listBHW()
    {
        $bhwUsers = Bhwregister::all(); // Fetch all BHW users
        return view('admin.list_bhw', compact('bhwUsers'));
    }

    

    


}
