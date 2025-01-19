@include('partials.__header')
<main class="custombg min-vh-100 loginpagebg">
    <div class="container py-3">
        <div class="card bg-transparent border-0 mt-5 d-flex justify-content-center align-items-center" style="height: 80vh">
            <div class="card-body bg-white rounded rounded-4 bg-opacity-75" style="width: 70vh; border:none">
                <div class="text-center">
                    <h3 class="fw-bold text-black">SIGN UP</h3>
                    <p class="text-black">Already Have an Account ? <a href="{{ url('/login') }}" style="text-decoration:underline;color:black;">
                        <strong>Login now</strong></a></p>
                </div>
                <form id="registerform" class="container py-3 was-validated">
                    @csrf
                    <div class="d-flex justify-content-center align-items-center">
                            <div class="form-group mb-1 w-50">
                                <label for="user_type" class="form-label fw-bold">Sign up as</label>
                                <select name="user_type" class="form-select py-2" required>
                                    <option value="" hidden>Select user type</option>
                                    <option value="1" {{ old('user_type') == 1 ? 'selected' : '' }}>BHW President</option>
                                    <option value="2" {{ old('user_type') == 2 ? 'selected' : '' }}>Admin Midwife</option>
                                </select>
                                @error('user_type')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    <div class="row">
                        <div class="col-lg-6 mb-3 text-black">
                            <div class="col-lg-12 mb-1">
                                <div class="form-group mb-1">
                                    <label class="form-label fw-bold" for="user_name">Username</label>
                                    <input type="text" name="user_name" class="form-control py-2" id="user_name"
                                        placeholder="Enter your username" required autocomplete="username">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group mb-1">
                                    <label class="form-label fw-bold" for="full_name">Fullname</label>
                                    <input type="text" name="full_name" class="form-control py-2" id="full_name"
                                        placeholder="Enter your full name" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group mb-1">
                                    <label class="form-label fw-bold" for="email">EMAIL</label>
                                    <input type="email" name="email" class="form-control py-2" id="email"
                                        placeholder="Enter your email" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group mb-1">
                                    <label class="form-label fw-bold" for="full_name">Catchment Area</label>
                                    <input type="text" name="full_name" class="form-control py-2" id="full_name"
                                        placeholder="Enter your full name" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group mb-1">
                                    <label class="form-label fw-bold" for="full_name">Cover Type</label>
                                    <input type="text" name="full_name" class="form-control py-2" id="full_name"
                                        placeholder="Enter your Cover Type" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group mb-1">
                                    <label class="form-label fw-bold" for="full_name">Accreditation Count</label>
                                    <input type="text" name="full_name" class="form-control py-2" id="full_name"
                                        placeholder="Enter your Accreditation Count" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-5 text-black">
                            <div class="col-lg-12 mb-1">
                                <div class="form-group mb-1">
                                    <label class="form-label fw-bold" for="address">Date of Registration</label>
                                    <input type="text" name="address" class="form-control py-2" id="address"
                                        placeholder="Enter your address" required>
                                </div>
                            </div> 
                            <div class="col-lg-12 mb-1">
                                <div class="form-group mb-1">
                                    <label class="form-label fw-bold" for="contact">Service Start Date</label>
                                    <input type="text" name="contact" class="form-control py-2" id="contact"
                                        placeholder="Enter your Service Start Date" required>
                                </div>
                            </div>
                            <div class="col-lg-12 mb-1">
                                <div class="form-group mb-1">
                                    <label class="form-label fw-bold" for="contact">Household Covered</label>
                                    <input type="text" name="contact" class="form-control py-2" id="contact"
                                        placeholder="Enter your Household Covered" required>
                                </div>
                            </div>
                            <div class="col-lg-12 mb-1">
                                <div class="form-group mb-1">
                                    <label class="form-label fw-bold" for="contact">Accreditation Date</label>
                                    <input type="text" name="contact" class="form-control py-2" id="contact"
                                        placeholder="Enter your Accreditation Date" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group mb-1">
                                    <label for="password" class="form-label fw-bold">PASSWORD</label>
                                    <input type="password" name="password" class="form-control py-2" id="new-password"
                                        placeholder="Create your password" required autocomplete="new-password">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group mb-1">
                                    <label for="password_confirmation" class="form-label fw-bold">CONFIRM PASSWORD</label>
                                    <input type="password" name="confirm-password" class="form-control py-2" id="password"
                                        placeholder="Confirm your password" required autocomplete="new-password">
                                    @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-secondary px-5 py-2 fw-bold rounded rounded-5" type="submit">Sign Up</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@include('partials.__footer')
