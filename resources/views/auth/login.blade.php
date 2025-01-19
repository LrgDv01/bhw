@include('partials.__header')
  <main class="custombg min-vh-100 loginpagebg">
    @include('partials.__nav')
    <div class="container d-flex justify-content-center align-items-center py-3" style="height: 80vh">
        <div class="card logincardbg bg-transparent d-flex align-items-center b-none" style="width: 50vh; border:none">
            <div class="card-body bg-white rounded rounded-4 bg-opacity-75">
                <div class="col d-flex flex-column align-items-center justify-content-center text-white">
                    <div class="w-500"  style="width: 30vw">
                        <div class="text-center text-black">
                            <h3 class="fw-bold">LOGIN</h3>
                            <p>Sign in to continue</p>
                        </div>
                        <form id="loginform" class="was-validated text-black">
                            <div class="form-group mb-3">
                                <label class="form-label fw-bold" for="email">EMAIL</label>
                                <input type="email" name="email" class="form-control py-3" id="email" placeholder="Enter your email address" 
                                        required autocomplete="email">
                            </div>
                            <div class="form-group mb-4">
                                <label class="form-label fw-bold" for="password">PASSWORD</label>
                                <input type="password" name="password" class="form-control py-3" id="password" placeholder="Enter your password" 
                                        required autocomplete="current-password">
                            </div>
                            <div class="form-group d-flex justify-content-between align-items-center mb-4">
                                <!-- Remember Me -->
                                <div class="form-check">
                                    <input type="hidden" name="remember" value="0">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"  value="1" 
                                        {{ session('remember_me') ? 'checked' : '' }}>
                                    <label class="form-check-label text-black" for="remember">Remember Me</label>
                                </div>
                                <!-- Forgot Password -->
                                <div>
                                    <a href="{{ route('request-form') }}" class="text-black text-decoration-none" 
                                        ><u>Forgot Password?</u></a>
                                </div>
                            </div>
                            @csrf
                            <div class="text-center">
                                <button class="btn btn-secondary px-5 py-2 fw-100 rounded rounded-5" type="submit">LOGIN</button>
                            </div>
                            <div class="text-center mt-3">
                                <p class="text-black fs-6">Don't have an account yet? You can create one here.</p>
                                <a href="{{ url('/register') }}" class="btn btn-secondary fw-bold px-5 rounded rounded-5 my-2">Sign Up Here</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>        
        </div>
    </div>
  </main>
@include('partials.__footer')
  