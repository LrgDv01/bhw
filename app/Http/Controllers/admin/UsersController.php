<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Mail\WelcomeMail;
use App\Models\AuditTrailModel;
use App\Models\User;
use App\Models\user_verification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function updateProfile(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'user_name' => 'required|string|max:255',
            'full_name' => 'nullable|string|max:255',
            // 'first_name' => 'required|string|max:255',
            // 'last_name' => 'required|string|max:255',
            // 'gender' => 'required|string',
            'contact' => 'required|string|max:15',
            // 'address' => 'required|string|max:255',
            'password' => 'nullable|min:8|confirmed',
            'user_type' => 'required|integer|in:1,2',
            'profile_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            // 'validID' => 'required|string',
            'verification_docs' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);
        $loggedInUser = Auth::user();
        if ($validator->fails()) {
            // Log the failed attempt
            AuditTrailModel::create([
                'userID' => $loggedInUser->id,
                'user_email' => $loggedInUser->email,
                'action' => 'update profile',
                'description' => 'Update profile failed: ' . json_encode($validator->errors()),
                'ip_address' => $request->ip(),
            ]);
    
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $user = Auth::user();
        $user->email = $request->email;
        $user->user_name = $request->user_name;
        $user->full_name = $request->full_name;
        $user->contact = $request->contact;
        // $user->first_name = $request->first_name;
        // $user->middle_name = $request->middle_name;
        // $user->last_name = $request->last_name;
        // $user->gender = $request->gender;
        // $user->address = $request->address;
        $user->first_open = 1;
    
        if ($request->hasFile('profile_img')) {
            $profilePath = $request->file('profile_img')->store('profile', 'public');
            $user->profile_img = $profilePath;
        }
        
        // $filePath = null;
        // if ($request->hasFile('verification_docs')) {
        //     $filePath = $request->file('verification_docs')->store('verification_docs', 'public');
        //     $user->valid_id = $filePath;
        // }
        
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        
        // $build_verification_data = [
        //     'userID' => $user->id,
        //     'id_type' => $request->validID,
        //     'id_file_url' => $filePath,
        //     'userStatus' => 0
        // ];
        
        // user_verification::insert($build_verification_data);
        
        // Log the successful update
        AuditTrailModel::create([
            'userID' => $loggedInUser->id,
            'user_email' => $loggedInUser->email,
            'action' => 'update profile',
            'description' => 'Profile updated successfully.',
            'ip_address' => $request->ip(),
        ]);
        return response()->json(['message' => 'Profile updated successfully.'], 200);
    }

    // public function get_users(Request $request) {
    //     $type = $request->type == "personel"? 1 : 2;
    //     $get_users = User::where('user_type', '!=', '0')
    //     ->leftJoin('blocked_account', 'users.id', '=', 'blocked_account.userID')
    //     ->leftJoin('unique_qr', 'unique_qr.userID', '=', 'users.id')
    //     ->leftJoin('user_verification', 'user_verification.userID', '=', 'users.id')
    //     ->select(   
    //         'users.*', 
    //         DB::raw('MD5(users.id) as encrypt_id'),
    //         DB::raw('CASE WHEN blocked_account.userID IS NULL THEN "Active" ELSE "blocked" END as status'), 
    //         'unique_qr.code as code', 
    //         'user_verification.userStatus', 
    //         'user_verification.id_type',
    //         'user_verification.id_file_url',
    //         DB::raw('COALESCE(user_verification.userStatus, "3") as userStatus')
    //     )
    //     ->where('user_type', $type)
    //     ->get();
    //     return response()->json($get_users);
    // }

    public function verifyUser(Request $request)
    {
        $user_verification = user_verification::where(DB::raw('MD5(userID)'), $request->id)->first();
        if ($user_verification) {
            $user_verification->userStatus = $request->action;
            $user_verification->save();

            $loggedInUser = Auth::user();
            AuditTrailModel::create([
                'userID' => $loggedInUser->id,
                'user_email' => $loggedInUser->email,
                'action' => 'user verification',
                'description' => 'User status updated to ' . ($request->action == 1 ? 'Approved' : 'Declined') . ' for user id: ' . $user_verification->userID,
                'ip_address' => $request->ip(), // Fetch the IP address
            ]);

            return response()->json(['success' => true, 'message' => 'User status updated successfully.']);
        }

        return response()->json(['success' => false, 'message' => 'User not found.']);
    }
    // public function get_specific_user(Request $request) {
    //     $qrcode = $request->qrcode;
    //     $get_users = User::where('user_type', '!=', '0')
    //     ->leftJoin('blocked_account', 'users.id', '=', 'blocked_account.userID')
    //     ->leftJoin('unique_qr', 'unique_qr.userID', '=', 'users.id')
    //     ->select('users.*', DB::raw('CASE WHEN blocked_account.userID IS NULL THEN "Active" ELSE "blocked" END as status'), 'unique_qr.code as code')
    //     ->where('unique_qr.code', $qrcode)
    //     ->get();
    //     return response()->json($get_users);
    // }

    // public function get_users_as_visitor(Request $request) {
    //     $get_users = User::where('user_type', 2)
    //     ->leftJoin('blocked_account', 'users.id', '=', 'blocked_account.userID')
    //     ->leftJoin('visitor_pdl', 'users.id', '=', 'visitor_pdl.userID')
    //     ->whereNull('blocked_account.userID') // Only get active users
    //     ->whereNull('visitor_pdl.userID') // Only get active users
    //     ->select('users.*', DB::raw('"Active" as status'))
    //     ->get();
    //     return response()->json($get_users);
    // }

    public function add_account_submit(Request $request) {
         // Validate the request data
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'address' => 'nullable|string|max:255',
            'contact' => 'nullable|string|max:255|unique:users',
        ]);
        $loggedInUser = Auth::user();
        
        if ($validator->fails()) {
            AuditTrailModel::create([
                'userID' => $loggedInUser->id,
                'user_email' => $loggedInUser->email,
                'action' => 'add account',
                'description' => 'Add account failed: ' . $request->input('email'),
                'ip_address' => $request->ip(), // Fetch the IP address
            ]);
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $fullname = $request->first_name . ' ' . $request->middle_name . ' ' . $request->last_name;
        
        $user = new User();
        $user->name = $fullname;
        $user->first_name = $request->input('first_name');
        $user->middle_name = $request->input('middle_name');
        $user->last_name = $request->input('last_name');
        $user->gender = $request->input('gender');
        $user->email = $request->input('email');
        $user->contact = $request->input('contact');
        $user->password = Hash::make($request->input('password'));
        $user->address = $request->input('address');
        $user->user_type = 1;
        $user->save();
        // Optionally, you can redirect the user to a success page
         // Add a flash session message for success
        Session::flash('success', 'Account created successfully');

        // Send email with the autogenerated password
        Mail::to($request->email)->send(new WelcomeMail($fullname, $request->email, $request->input('password'), $request->input('qr')));

        AuditTrailModel::create([
            'userID' => $loggedInUser->id,
            'user_email' => $loggedInUser->email,
            'action' => 'add account',
            'description' => 'Account created successfully for ' .$fullname,
            'ip_address' => $request->ip(), // Fetch the IP address
        ]);

        return response()->json(['message' => 'User registered successfully'], 200);
    }
    
    public function display_user_profile($id) {
        $userDetails = User::select("users.*", "b.code")
        ->where('users.id', $id)
        ->leftJoin('unique_qr as b', 'users.id', '=', 'b.userID')
        ->first();
        if ($userDetails) {
            $html = view('admin.pages.user_profile', [
                'userID' => $id,
                'user_data' => $userDetails
            ])->render();
            
            return response()->json(['html' => $html]);
        } else {
            return response()->json(['error' => 'User not found'], 404);
        }
    }
    
    public function changePassword(Request $request)
    {
        // Validate the request data
        $request->validate([
            'old_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed', // confirmed rule requires an input named new_password_confirmation
        ]);

        // Check if the old password matches the user's current password
        if (!Hash::check($request->old_password, Auth::user()->password)) {
            AuditTrailModel::create([
                'userID' => Auth::user()->id,
                'user_email' => Auth::user()->email,
                'action' => 'Edit password',
                'description' => 'Edit password failed: ' . Auth::user()->email,
                'ip_address' => $request->ip(), // Fetch the IP address
            ]);
            return response()->json(['message' => 'The provided old password is incorrect.'], 500);
        }

        // Update the user's password
        Auth::user()->update([
            'password' => Hash::make($request->password),
        ]);
        AuditTrailModel::create([
            'userID' => Auth::user()->id,
            'user_email' => Auth::user()->email,
            'action' => 'Edit password',
            'description' => 'Edit password success: ' . Auth::user()->email,
            'ip_address' => $request->ip(), // Fetch the IP address
        ]);
        // Redirect the user back with a success message
        return response()->json(['message' => 'Password changed successfully.'], 200);
    }
    public function resetPassword(Request $request)
    {
        $user = User::find($request->user_id);

        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }
        AuditTrailModel::create([
            'userID' => Auth::user()->id,
            'user_email' => Auth::user()->email,
            'action' => 'reset password',
            'description' => 'Password reset for user: ' . $user->email,
            'ip_address' => $request->ip(), // Fetch the IP address
        ]);
        $newPassword = 'Ebisita1234'; // Generate or specify the new password
        $user->password = Hash::make($newPassword);
        $user->save();

        return response()->json(['message' => 'Password reset successfully.'], 200);
    }
}
