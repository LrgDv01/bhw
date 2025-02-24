<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Bhwregister;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class BhwregistrationController extends Controller
{

    public function index()
    {
        return view('admin.pages.bhwregistration');
    }

    public function bhwregistration(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'username' => 'required|string|max:255|unique:users,username',
                'fullname' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:3|confirmed',
                'cover_type' => 'required|string',
                'catchment_area' => 'required|string',
                'accreditation_count' => 'required|integer',
                'household_covered' => 'required|integer',
                'accreditation_date' => 'required|date',
                'service_start_date' => 'required|date',
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors(),
                ], 422);
            }
    
            $validated = $validator->validated();
    
            $user = User::create([
                'user_type' => '2',
                'username' => $validated['username'],
                'fullname' => $validated['fullname'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);


            $user = Bhwregister::create([
                'bhw_id' => $user->id,
                'cover_type' => $validated['cover_type'],
                'catchment_area' => $validated['catchment_area'],
                'accreditation_count' => $validated['accreditation_count'],
                'household_covered' => $validated['household_covered'],
                'accreditation_date' => $validated['accreditation_date'],
                'service_start_date' => $validated['service_start_date'],
                'date_of_registration' => now(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'User registered successfully!',
                'user' => $user,
            ], 201);
    
        } catch (Exception $e) {
            \Log::error('User registration failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while registering the user. Please try again later.',
                'error' => $e->getMessage(), 
            ], 500);
        }
    }
}