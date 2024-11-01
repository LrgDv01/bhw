<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Mail\WelcomeMail;
use App\Models\admin\QrModel;
use App\Models\AuditTrailModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AuthController extends Controller
{
  private function validateCsrfToken(Request $request)
  {
    if (!$request->has('_token') || $request->session()->token() !== $request->input('_token')) {
      return response()->json(['message' => 'Invalid CSRF token'], 419);
    }
    return null;
  }
  public function login(Request $request)
  {
    $csrfValidation = $this->validateCsrfToken($request);
    if ($csrfValidation) {
      return $csrfValidation;
    }
    // Check if code is provided for login
    if ($request->has('code')) {
      $validator = Validator::make($request->all(), [
        'code' => 'required|string',
      ]);

      if ($validator->fails()) {
        return response()->json(['errors' => 'Validation failed', 'errors' => $validator->errors()], 422);
      }

      $code = $request->input('code');
      $user = User::join('unique_qr as b', 'users.id', '=', 'b.userID')
        ->where('b.code', $code)
        ->select('users.*') // Select only user columns
        ->first();

      if ($user) {
        // Check if the user account is blocked
        if ($user->isBlocked()) {
          // Blocked account, log the attempt and return an error response
          AuditTrailModel::create([
            'userID' => $user->id,
            'user_email' => $user->email,
            'action' => 'login',
            'description' => 'Failed login attempt - account blocked',
            'ip_address' => $request->ip(),
          ]);
          return response()->json(['errors' => 'Account blocked'], 403);
        } else {
          Auth::login($user);
          AuditTrailModel::create([
            'userID' => $user->id,
            'user_email' => $user->email,
            'action' => 'login',
            'description' => 'User successfully logged in using code',
            'ip_address' => $request->ip(), // Fetch the IP address
          ]);
          $redirectRoute = $user->isAdmin() || $user->isSubAdmin() ? route('admin.dashboard') : route('user.home');
          return response()->json(['message' => 'Login successful', 'user' => $user, 'redirect' => $redirectRoute], 200);
        }
      } else {
        AuditTrailModel::create([
          'action' => 'login',
          'description' => 'Failed login attempt with code: ' . $code,
          'ip_address' => $request->ip(), // Fetch the IP address
        ]);
        return response()->json(['errors' => 'Invalid code'], 401);
      }
    } else {
      // Validate request data
      $validator = Validator::make($request->all(), [
        'email' => 'required|email',
        'password' => 'required',
      ]);
      if ($validator->fails()) {
        $email = $request->input('email');
        AuditTrailModel::create([
          'user_email' => $email,
          'action' => 'login',
          'description' => 'Failed login attempt for email: ' . $email,
          'ip_address' => $request->ip(), // Fetch the IP address

        ]);
        return response()->json(['errors' => 'Validation failed', 'errors' => $validator->errors()], 422);
      }
      // Attempt to log in the user
      $credentials = $request->only('email', 'password');
      $checkData = User::where('email', $request->email)->first();
      if($checkData) {
        if ($checkData->isBlocked()) {
          // Blocked account, log the attempt and return an error response
          AuditTrailModel::create([
            'userID' => $checkData->id,
            'user_email' => $checkData->email,
            'action' => 'login',
            'description' => 'Failed login attempt - account blocked',
            'ip_address' => $request->ip(),
          ]);
          return response()->json(['errors' => 'Account blocked'], 403);
        } else {
          if (Auth::attempt($credentials)) {
            // Authentication successful
            $user = Auth::user();
            AuditTrailModel::create([
              'userID' => $user->id,
              'user_email' => $user->email,
              'action' => 'login',
              'description' => 'User successfully logged in',
              'ip_address' => $request->ip(), // Fetch the IP address
    
            ]);
            $redirectRoute = $user->isAdmin() || $user->isSubAdmin() ? route('admin.dashboard') : route('user.home');
            return response()->json(['message' => 'Login successful', 'user' => $user, 'redirect' => $redirectRoute], 200);
          } else {
            // Authentication failed
            $email = $request->input('email');
            AuditTrailModel::create([
              'user_email' => $email,
              'action' => 'login',
              'description' => 'Failed login attempt for email: ' . $email,
              'ip_address' => $request->ip(), // Fetch the IP address
            ]);
            return response()->json(['errors' => 'Invalid credentials'], 401);
          }
        }
      } else {
        return response()->json(['errors' => 'Invalid credentials'], 401);
      }
    }
  }
  public function register(Request $request)
  {
    $csrfValidation = $this->validateCsrfToken($request);
    if ($csrfValidation) {
      return $csrfValidation;
    }

    // Validate the request data
    $validator = Validator::make($request->all(), [
      'first_name' => 'required|string|max:255',
      'middle_name' => 'nullable|string|max:255',
      'last_name' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:users',
      'address' => 'nullable|string|max:255',
      'gender' => 'required|string|max:255',
      'contact' => 'nullable|string|max:255|unique:users',
    ]);

    if ($validator->fails()) {
      AuditTrailModel::create([
        'user_email' => $request->input('email'),
        'action' => 'pre-registration',
        'description' => 'Pre registration failed: ' . $request->input('email'),
        'ip_address' => $request->ip(), // Fetch the IP address

      ]);
      return response()->json(['errors' => $validator->errors()], 422);
    }
    
    if ($request->hasFile('valid_id')) {
      // Store new logo
      $logoPath = $request->file('valid_id')->store('valid_ids', 'public');
      $valid_id = $logoPath;
    }
    
    // Autogenerate a password
    $password = Str::random(12); // Generates a random 12-character password
    // Create a new user
    $fullname = trim($request->first_name . ' ' . $request->middle_name . ' ' . $request->last_name);
    $user = User::create([
      'name' => $fullname,
      'first_name' => $request->first_name,
      'middle_name' => $request->middle_name,
      'last_name' => $request->last_name,
      'email' => $request->email,
      'address' => $request->address,
      'contact' => $request->contact,
      'password' => Hash::make($password),
      'gender' => $request->gender,
      'user_type' => 2,
      'valid_id' => $valid_id
    ]);
    $randomCode = uniqid();
    $insertVisitorData = [
      'userID' => $user->id,
      'code' => $randomCode,
      'is_deleted' => 0,
    ];
    QrModel::create($insertVisitorData);
    AuditTrailModel::create([
      'user_email' => $request->email,
      'action' => 'pre-registration',
      'description' => 'Account created successfully for ' . $fullname,
      'ip_address' => $request->ip(), // Fetch the IP address

    ]);
    // Send email with the autogenerated password
    Mail::to($request->email)->send(new WelcomeMail($fullname, $request->email, $password, $randomCode));

    // Return a success response
    return response()->json(['message' => 'User registered successfully'], 200);
  }
  public function logout(Request $request)
  {
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/');
  }
}
