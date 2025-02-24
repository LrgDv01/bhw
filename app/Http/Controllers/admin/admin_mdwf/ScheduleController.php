<?php

namespace App\Http\Controllers\admin\admin_mdwf;

use App\Models\Announcement;
use App\Models\admin\admin_mdwf\Schedule;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    
    public function index()
    {
        $schedules = Schedule::all(); // Fetch all schedules from the database
        return view('admin.admin_mdwf.schedule', compact('schedules'));
    }
    public function announcement()
    {   
        $announcements = Announcement::all();
        return view('admin.admin_mdwf.Announcement',compact('announcements'));
    }
    

    public function store(Request $request)
    {
        $validated = $request->validate([
            'activities' => 'required|string|max:255',
            'date' => 'required|date',
            'assigned' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'target' => 'required|string|max:255',
        ]);

        Schedule::create([
            'activities' => $validated['activities'],
            'date' => $validated['date'],
            'assigned' => $validated['assigned'],
            'address' => $validated['address'],
            'target' => $validated['target'],
        ]);

        return redirect()->route('admin.schedule.index')->with('success', 'Event added successfully!');
    }
    
    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();

        return redirect()->route('admin.schedule.index')->with('success', 'Event deleted successfully!');
    }
   

}
