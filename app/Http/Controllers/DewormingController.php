<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deworming;

class DewormingController extends Controller
{
    public function index()
    {
        $records = Deworming::all();
        return view('bhw.pages.deworming', compact('records'));
    }

    public function create()
    {
        return view('bhw.createDeworming');
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'gender' => 'required|in:Male,Female',
        ]);

        Deworming::create($request->all());

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
