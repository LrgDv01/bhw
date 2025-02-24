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
        $announcements = Announcement::latest()->take(5)->get();
        return view('admin.announcement', compact('announcements'));
    }
    public function summaryList()
    {
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
    public function sched()
    {
        return view('bhw.pages.schedule');
    }
}
