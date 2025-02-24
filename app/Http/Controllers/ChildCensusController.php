<?php

namespace App\Http\Controllers;

use App\Models\ChildCensus;
use Illuminate\Http\Request;

class ChildCensusController extends Controller
{
    public function create()
    {
        return view('bhw.pages.child');
    }

    public function store(Request $request)
    {
       
        $validated = $request->validate([
            'house_number' => 'required|string|max:255',
            'complete_name' => 'required|string|max:255',
            'role_in_family' => 'required|string|max:255',
            'dob' => 'required|date',
            'age' => 'required|integer',
            'vaccines' => 'array|nullable',
            'vaccines.*' => 'string', 
        ]);


        ChildCensus::create($validated);

        return redirect()->route('child.census.create')->with('success', 'Child census data submitted successfully!');
    }
   
    public function viewChildData($id)
    {
        $childs = ChildCensus::findOrFail($id);

        return view('bhw.pages.viewChildData', compact('childs'));
    }
    public function deleteChildData($id)
    {
        $childs = ChildCensus::findOrFail($id);

        if ($childs) {
            $childs->delete();
            return redirect()->route('bhw.pages.list')->with('success', 'Family member deleted successfully!');
        }

        return redirect()->route('bhw.pages.list')->with('error', 'Family member not found!');
    }
}

