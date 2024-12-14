<?php

namespace App\Http\Controllers\user;
use App\Models\Farm\FarmModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FarmController extends Controller
{

    public function index() {
        $userId = Auth::id(); 
        $farms = FarmModel::where('user_id', $userId)
        // ->orderBy('created_at', 'desc')->limit(4) // Order by created_at, newest first
        ->orderBy('created_at', 'desc') // Order by created_at, newest first
        ->get();
        return view('user.home', compact('farms'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->merge(['user_id' => auth()->id()]);
        try {
            $validated = $request->validate([
                'user_id' => 'required|exists:users,id',
                'name' => 'required|string|max:255',
                'location' => 'required|string|max:255',
                'variety' => 'nullable|string|max:255',
                'hectares' => 'required|numeric|min:0',
                'tree_age' => 'nullable|integer|min:0',
                'planted_coconut' => 'nullable|integer|min:0',
                'soil_type' => 'nullable|string|max:255',
            ]);
        
            // Create the farm record
            $farm = FarmModel::create($validated);
            return response()->json(['success' => true, 'farm' => $farm]);
         
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'errors' => $e->errors()
            ], 422);
        }
        
    }

}
