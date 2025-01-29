<?php

namespace App\Http\Controllers;

use App\Models\Myschedule;
use Illuminate\Http\Request;

class MyscheduleController extends Controller
{
    public function index()
    {
        $myschedules = Myschedule::all();
        return view('bhw.pages.myschedule', compact('myschedules'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'date_of_delivery' => 'required|date',
            'remarks' => 'nullable|string',
            'time_of_visit' => 'required|date_format:H:i',
        ]);

        Myschedule::create($validatedData);

        return redirect()->route('myschedules.index')->with('success', 'Schedule added successfully!');
    }


    public function show($id)
    {
        $myschedule = Myschedule::findOrFail($id);
        return view('myschedule-view', compact('myschedule'));
    }
    public function updateStatus($id)
    {
        $myschedule = Myschedule::findOrFail($id);
        $myschedule->status = $myschedule->status == 'Already Visit' ? 'Pending' : 'Already Visit';
        $myschedule->save();

        return redirect()->route('myschedules.index')->with('success', 'Status updated successfully.');
    }

}