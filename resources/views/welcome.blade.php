@include('partials.__header')
{{-- <main class="custombg"> --}}
@include('partials.__nav')
<main class="main">
    <!-- Hero Section -->
    <section id="hero" class="hero section d-flex flex-row-reverse justify-content-end">
        <div class="container d-flex justify-content-end">
            <div class="bg-transparent bg-opacity-50" style="width: 100vh">
                <!-- <div class="card-body"> -->
                    <div class="d-flex flex-column align-items-center mx-0">
                        <div class="col-lg-6 mb-5 rounded-circle bg-white p-3" style="width: 150px; height: 150px;">
                            <img src="{{ URL::asset('img/logo.png') }}" alt="Logo" class="img-fluid rounded-5">
                        </div>
                        
                        <div class="col-lg-6 d-flex align-items-center text-white">
                            <div class="w-100">                          
                                <div class="text-center">
                                    <h3 class="fw-bold text-white">LOGIN</h3>
                                </div>
                                <form id="loginform" class="was-validated">
                                    
                                    <div class="form-group mb-3">
                                        <label class="form-label fw-bold" for="email">EMAIL</label>
                                        <input type="email" name="email" class="form-control py-3" id="email" 
                                                placeholder="Enter your email address" value="{{ old('email', session('email')) }}" required >
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="form-label fw-bold" for="password">PASSWORD</label>
                                        <input type="password" name="password" class="form-control py-3" id="password" placeholder="Enter your password address" required>
                                    </div>

                                    <div class="form-group d-flex justify-content-between align-items-center mb-4">
                                        <!-- Remember Me -->
                                        <div class="form-check">
                                            <input type="hidden" name="remember" value="0">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember"  value="1" 
                                                {{ session('remember_me') ? 'checked' : '' }}>
                                            <label class="form-check-label text-white" for="remember">Remember Me</label>
                                        </div>
                                        @if ($device) 
                                        <!-- Forgot Password -->
                                        <div>
                                            <a href="{{ route('request-form') }}" class="text-white text-decoration-none" 
                                                ><u>Forgot Password?</u></a>
                                        </div>
                                        @endif
                                    </div>
                                    @csrf
                                    <div class="form-group my-3">
                                        <div class="text-center mb-3">
                                            <button class="btn btn-success px-5 py-2 fw-100 rounded rounded-3" type="submit">LOGIN</button>
                                        </div>
                                        @if ($device) 
                                            <div class="text-center">
                                                <p class="text-white fs-6">Don't have an account yet, you can create one here.</p>
                                                <a href="{{ url('/register') }}" class="btn-get-started bg-success fw-bold px-5 rounded rounded-3 my-3">Sign Up Here</a>
                                            </div>
                                        @endif
                                    </div>
                                
                                </form>
                            </div>
                        </div>
                    </div>
                <!-- </div>         -->
            </div> 
        </div>
    </section><!-- /Hero Section -->
 @include('partials.__footer')

