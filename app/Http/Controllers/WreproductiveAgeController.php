<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WreproductiveAge;

class WreproductiveAgeController extends Controller
{
    public function index()
    {
        $data = WreproductiveAge::all();
        return view('bhw.pages.WreproductiveAge', compact('data'));
    }

    public function create()
    {
        return view('bhw.WreproductiveAge');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'birthday' => 'required|date',
            'age' => 'required|integer',
            'status' => 'required|string',
            'fp_used' => 'required|string',
            'address' => 'required|string',
            'nhts' => 'required|string',
        ]);

        WreproductiveAge::create($request->all());

        return redirect()->route('bhw.wreproductiveage.index')->with('success', 'Record added successfully!');
    }

    public function edit($id)
    {
        $record = WreproductiveAge::findOrFail($id);
        return view('bhw.editWreproductiveAge', compact('record'));
    }

    public function update(Request $request, $id)
    {
        $record = WreproductiveAge::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'birthday' => 'required|date',
            'age' => 'required|integer',
            'fp_used' => 'required|string',
            'address' => 'required|string',
        ]);

        $record->update($request->all());

        return redirect()->route('bhw.wreproductiveage.index')->with('success', 'Record updated successfully!');
    }

    public function destroy($id)
    {
        WreproductiveAge::findOrFail($id)->delete();
        return redirect()->route('bhw.wreproductiveage.index')->with('success', 'Record deleted successfully!');
    }
}
