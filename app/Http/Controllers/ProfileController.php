<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index() {

        $user = auth()->user(); // Get the authenticated user
        // Return view with user data
        return view('user.pages.settings', ['user' => $user]);
    }

    public function updateField(Request $request) {
        $user = auth()->user();
        $field = $request->input('field');
        $value = $request->input('value');
    
        // if (in_array($field, ['user_name', 'age', 'gender', 'contact_number', 'email', 'municipality', 'district'])) {
        if (in_array($field, ['user_name', 'contact', 'email'])) {

            $user->$field = $value;
            $user->save();
    
            return response()->json(['success' => true]);
        }
    
        return response()->json(['success' => false], 400);
    }

    public function updateProfile(Request $request)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            // 'age' => 'nullable|integer|min:1|max:120',
            // 'gender' => 'nullable|string|max:50',
            'contact' => 'nullable|string|max:15',
            'email' => 'required|email|max:255',
            // 'district' => 'nullable|string|max:255',
            // 'municipality' => 'nullable|string|max:255',
        ]);

        // Get the currently authenticated user
        $user = auth()->user();
        try {
            // Update the user's profile with the validated data
            $user->update($validatedData);

            return response()->json(['success' => true, 'message' => 'Profile updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to update profile', 'error' => $e->getMessage()], 500);
        }
    }

}
