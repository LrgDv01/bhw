<?php

namespace App\Http\Controllers;

use App\Models\ChildCensus;
use Illuminate\Http\Request;

class ChildCensusController extends Controller
{
    // Display the child census form
    public function create()
    {
        return view('bhw.pages.child');
    }

    // Handle form submission
    public function store(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'house_number' => 'required|string|max:255',
            'complete_name' => 'required|string|max:255',
            'role_in_family' => 'required|string|max:255',
            'dob' => 'required|date',
            'age' => 'required|integer',
            'vaccines' => 'array|nullable', // Ensure vaccines is an array
            'vaccines.*' => 'string', // Ensure each vaccine in the array is a string
        ]);

        // Store the validated data in the database
        ChildCensus::create($validated);

        // Redirect back with success message
        return redirect()->route('child.census.create')->with('success', 'Child census data submitted successfully!');
    }
   
    public function viewChildData($id)
    {
        // Find the child census by ID
        $childs = ChildCensus::findOrFail($id);

        // Return the view and pass the child data
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

