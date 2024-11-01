@include('partials.__header')
  <main class="custombg min-vh-100 loginpagebg">
    @include('partials.__nav')
    <div class="container d-flex justify-content-center align-items-center py-3" style="height: 100vh">
        <div class="card shadow-lg logincardbg" style="width: 80vh">
            <div class="card-body">
                <div class="text-center">
                    <img src="{{ URL::asset('img/logo.png') }}" alt="">
                    <h3 class="fw-bold">LOGIN USING CODE</h3>
                    <p>Sign in to continue</p>
                </div>
                <form id="loginform" class="was-validated">
                    <div class="form-group mb-4">
                        <label class="form-label fw-bold" for="password">AUTHORIZED CODE</label>
                        <input type="text" name="code" class="form-control py-3" id="code" placeholder="Enter your code here..." required>
                    </div>
                    <div class="mb-3 text-center">
                        <div class="form-check d-flex justify-content-center">
                            <input class="form-check-input me-2" type="checkbox" value="" checked id="terms-and-condition" required />
                            <label class="form-check-label" for="terms-and-condition">
                                I agree to the <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal">Terms and Conditions</a>
                            </label>
                        </div>
                    </div>
                    @csrf
                    <div class="text-center">
                        <button class="btn btn-primary px-5 py-2 fw-100 rounded rounded-0" type="submit">LOGIN</button>
                    </div>
                </form>
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
  