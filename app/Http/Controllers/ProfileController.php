<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;


class ProfileController extends Controller
{
    public function index() {

        $user = auth()->user(); 
 
        return view('user.pages.settings', ['user' => $user]);
    }

    public function updateField(Request $request) {
        $user = auth()->user();
        $field = $request->input('field');
        $value = $request->input('value');
        if (in_array($field, ['user_name', 'full_name', 'email'])) {
            $user->$field = $value;
            $user->save();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 400);
    }

    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_name' => 'required|string|max:255',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors()
            ], 422);
        }
        $user = Auth::user();
        $user->user_name = $request->input('user_name');
        $user->full_name = $request->input('full_name');
        $user->email = $request->input('email');
        if ($user->save()) {
            return response()->json(['success' => true, 'message' => 'Profile updated successfully.'], 200);
        }
    
        return response()->json([
            'success' => false,
            'message' => 'Failed to update profile. Please try again later.'
        ], 500);
    }
}
