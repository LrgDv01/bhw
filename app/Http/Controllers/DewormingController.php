<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deworming;

class DewormingController extends Controller
{
    public function index()
    {
        // $records = Deworming::all();
        $records = Deworming::paginate(12); // Adjust the number (10) as needed
        return view('bhw.pages.deworming', compact('records'));
    }

    public function create()
    {
        return view('bhw.createDeworming');
    }

    public function store(Request $request)
    {
        // dd($request->full_name, $request->ageUnit, $request->gender, $request->age);
        $ageString = (string)$request->age;
        $fullAge = $ageString . ' ' . $request->ageUnit;
        // dd(gettype($fullAge));
        $request->merge(['age' => $fullAge]);
        $request->validate([
            'full_name' => 'required|string|max:255',
            'age'=> 'required|string|max:255',
            'gender' => 'required|in:Male,Female',
        ]);

        Deworming::create($request->all());
        // return view('bhw.pages.Deworming');
        // return response()->json($request->full_name);
        return redirect()->route('bhw.deworming.index')->with('success', 'Record added successfully!');
    }

    public function edit($id)
    {
        $record = Deworming::findOrFail($id);
        return view('bhw.editDeworming', compact('record'));
    }

    public function update(Request $request, $id)
    {
        $record = Deworming::findOrFail($id);

        $request->validate([
            'full_name' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'gender' => 'required|in:Male,Female',
        ]);

        $record->update($request->all());

        return redirect()->route('bhw.deworming.index')->with('success', 'Record updated successfully!');
    }

    public function destroy($id)
    {
        Deworming::findOrFail($id)->delete();
        return redirect()->route('bhw.deworming.index')->with('success', 'Record deleted successfully!');
    }
}
