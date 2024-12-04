@include('partials.__header')
  <main class="custombg min-vh-100 loginpagebg">
    @include('partials.__nav')
    <div class="container d-flex justify-content-center align-items-center py-3" style="height: 80vh">
        <div class="card shadow-lg logincardbg bg-transparent" style="width: 100vh">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 d-flex align-items-center justify-content-center mb-3">
                        <img src="{{ URL::asset('img/logo.png') }}" alt="" class="img-fluid d-none d-sm-block">
                    </div>
                    <div class="col-lg-6 d-flex align-items-center text-white">
                        <div class="w-100">
                        
                            <div class="text-center">
                                <h3 class="fw-bold text-white">LOGIN</h3>
                                <p>Sign in to continue</p>
                            </div>
                            <form id="loginform" class="was-validated">
                                
                                <div class="form-group mb-3">
                                    <label class="form-label fw-bold" for="email">EMAIL</label>
                                    <input type="email" name="email" class="form-control py-3" id="email" placeholder="Enter your email address" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label class="form-label fw-bold" for="password">PASSWORD</label>
                                    <input type="password" name="password" class="form-control py-3" id="password" placeholder="Enter your password address" required>
                                </div>
                                <div class="form-group d-flex justify-content-between align-items-center mb-4">
                                    <!-- Remember Me -->
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                        <label class="form-check-label text-white" for="remember">Remember Me</label>
                                    </div>

                                    <!-- Forgot Password -->
                                    <div>
                                        <a href="{{ url('/forgot-password') }}" class="text-white text-decoration-none"><u>Forgot Password?</u></a>
                                    </div>
                                </div>
                                @csrf
                                <div class="text-center">
                                    <button class="btn btn-success px-5 py-2 fw-100 rounded rounded-3" type="submit">LOGIN</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>        
        </div>
    </div>
    <!-- Terms and Conditions Modal -->
    <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="termsModalLabel">Terms and Conditions</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {!! isset($appInfo->terms_and_condition) ? $appInfo->terms_and_condition : 'Default terms and conditions content.' !!}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
  </main>
@include('partials.__footer')
  