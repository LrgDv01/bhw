<?php

namespace App\Http\Controllers;

use App\Models\Bhwregister;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BhwregistrationController extends Controller
{
    public function bhwregistration(Request $request)
    {
        try {
            $validated = $request->validate([
                'username' => 'required|string|max:255',
                'email' => 'required|email|unique:bhwregisters,email',
                'password' => 'required|min:8|confirmed',
                'phone_no' => 'required|numeric|digits_between:10,15',
                'last_name' => 'required|string|max:255',
                'first_name' => 'required|string|max:255',
                'middle_name' => 'required|string|max:255',
                'catchment_area' => 'required|string|max:255',
                'cover_type' => 'required|string|max:255',
                'accreditation_count' => 'required|numeric',
                'service_start_date' => 'required|date',
                'household_covered' => 'required|numeric',
                'accreditation_date' => 'required|date',
            ]);

            $user = Bhwregister::create([
                'username' => $validated['username'],
                'email' => $validated['email'],
                'password' => bcrypt($validated['password']),
                'status' => 'BHW',
                'phone_no' => $validated['phone_no'],
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'middle_name' => $validated['middle_name'],
                'catchment_area' => $validated['catchment_area'],
                'cover_type' => $validated['cover_type'],
                'accreditation_count' => $validated['accreditation_count'],
                'service_start_date' => $validated['service_start_date'],
                'household_covered' => $validated['household_covered'],
                'accreditation_date' => $validated['accreditation_date'],
            ]);

            if (!$user) {
                session()->flash('error', 'Registration unsuccessful. Please try again.');
                return redirect()->back()->withInput();
            }

            Auth::guard('bhw')->login($user);

            session()->flash('success', 'Registration successful! Please log in.');
            return redirect()->route('admin.list_bhw');

        } catch (\Exception $e) {
            Log::error('Registration Error: ' . $e->getMessage());
            session()->flash('error', 'An unexpected error occurred: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }
}