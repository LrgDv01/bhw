<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Mail\WelcomeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Password;
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

    $validator = Validator::make($request->all(), [
      'email' => 'required|email',
      'password' => 'required|string',
      'remember' => 'nullable|boolean', 
    ]);

    if ($validator->fails()) {
      $email = $request->input('email');
      return response()->json(['errors' => 'Validation failed', 'errors' => $validator->errors()], 422);
    }
    $credentials = $request->only('email', 'password');
    $remember = $request->boolean('remember'); 

    $checkData = User::where('email', $request->email)->first();
    if($checkData) {
        if (Auth::attempt($credentials, $remember)) {
          $request->session()->put('remember_me', $remember); 
          $user = Auth::user();
          $redirectRoute = $user->isSuperAdmin()
            ? route('admin.dashboard'): ($user->isAdmin() 
            ? route('admin.midwife.dashboard')
            : route('bhw.dashboard'));
          return response()->json(['message' => 'Login successful', 'user' => $user, 'redirect' => $redirectRoute], 200);
        } else {
          $request->session()->flash('email', $request->input('email'));
          return response()->json(['errors' => 'Invalid credentials'], 401);
        }
    } else {
      return response()->json(['errors' => 'Invalid credentials'], 401);
    }
    
  }

  public function register(Request $request)
  {
    $csrfValidation = $this->validateCsrfToken($request);
    if ($csrfValidation) {
      return $csrfValidation;
    }

    $password = Str::random(12); 
    $user = User::create([
      'user_type' => $request->user_type,
      'username' => $request->username,
      'fullname' => $request->fullname,
      'email' => $request->email,
      // 'catchment_area' => $request->catchment_area,
      // 'cover_type' => $request->cover_type,
      // 'accreditation_count' => $request->accreditation_count,
      // 'date_of_registration' => $request->date_of_registration,
      // 'service_start_date' => $request->service_start_date,
      // 'household_covered' => $request->household_covered,
      // 'accreditation_date' => $request->accreditation_date,
      'password' => Hash::make($request->password),
    ]);
   
    return response()->json(['message' => 'User registered successfully'], 200);
  }

  public function showRequestForm() {
    return view('auth.request_link_verification');
  }

  public function requestResetLink(Request $request)
  {
    $request->validate([
      'email' => 'required|email|exists:users,email',
    ]);

    $status = Password::sendResetLink(
      $request->only('email')
    );

    if ($status == Password::RESET_LINK_SENT) {
      return response()->json(['success' => true, 'message' => 'We have e-mailed your password reset link!']);
    } else {
      return response()->json(['success' => false, 'message' => 'Failed to send reset link, please try again.'], 422);
    }
  }

  public function showResetForm($token) {
    $email = request('email');
    return view('auth.reset_password', ['token' => $token, 'email' => $email]);
  }

  public function resetPassword(Request $request) {

    $request->validate([
      'token' => 'required',
      'email' => 'required|email|exists:users,email',
      'password' => 'required|confirmed|min:3',
    ]);

    $status = Password::reset(
      $request->only('email', 'password', 'password_confirmation', 'token'),
      function ($user, $password) {
        $user->forceFill([
          'password' => Hash::make($password),
        ])->save();
        Auth::login($user);
      }
    );

    if ($status === Password::PASSWORD_RESET) {
      $user = Auth::user();
      $redirectRoute = $user->isSuperAdmin()
        ? route('admin.dashboard'): ($user->isAdmin() 
        ? route('admin.midwife.dashboard')
        : route('bhw.dashboard'));
      return response()->json([
        'success' => true, 
        'message' => 'Password has been reset and you are now logged in.', 
        'user' => $user, 'redirect' => $redirectRoute], 200);
    } 
        // If reset fails, redirect back with an error
        return back()->withErrors(['success' => false, 'email' => __($status)]);
    // return response()->json([
    //   'success' => false,
    //   'message' => __($status),
    // ], 400);
  }


  public function logout(Request $request)
  {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('login');
  }
}
