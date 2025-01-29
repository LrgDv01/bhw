<?php

namespace App\Http\Controllers;

use App\Models\DutySchedule;  
use Illuminate\Http\Request;

class DutyScheduleController extends Controller
{
    

    public function index()
    {
        $duty_schedules = DutySchedule::all();  // Fetch all duty schedules
        return view('admin.admin_mdwf.duty', compact('duty_schedules'));
    }


    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name_of_bhw' => 'required|string',
            'barangay' => 'required|string',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'remark' => 'nullable|string',
        ]);

        // Store the data into the database with attendance set to 'Pending'
        DutySchedule::create([
            'name_of_bhw' => $request->name_of_bhw,
            'barangay' => $request->barangay,
            'date' => $request->date,
            'time' => $request->time,
            'remark' => $request->remark,
            'attendance' => 'Pending', // Default attendance is Pending
        ]);

        // Redirect with success message
        return redirect()->route('admin.duty.index')->with('success', 'Duty event added successfully!');
    }



    public function destroy($id)
    {
        // Find the schedule by ID and delete it
        $duty_schedule = DutySchedule::findOrFail($id);
        $duty_schedule->delete();

        
        return redirect()->route('admin.duty.index')->with('success', 'Event deleted successfully!');
    }
    public function updateAttendance($id, Request $request)
    {
        // Validate the attendance input
        $request->validate([
            'attendance' => 'required|string|in:Present,Absent',
        ]);

        // Find the duty schedule by ID
        $duty_schedule = DutySchedule::findOrFail($id);

        // Update the attendance value
        $duty_schedule->attendance = $request->attendance;
        $duty_schedule->save();

        // Redirect back with a success message
        return redirect()->route('admin.duty.index')->with('success', 'Attendance updated successfully!');
    }



}