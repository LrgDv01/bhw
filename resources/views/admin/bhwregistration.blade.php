@include('partials.__header')
<main class="custombg min-vh-100 loginpagebg">
    <div class="container py-3">
        <div class="card bg-transparent border-0 mt-5 d-flex justify-content-center align-items-center" style="height: 80vh">
            <div class="card-body bg-white rounded rounded-4 bg-opacity-75" style="width: 70vh; border:none">
                <div class="text-center">
                    <h3 class="fw-bold text-black">BHW Registration</h3>
                    <p class="text-black">Already Have an Account ? <a href="{{ url('/login') }}" style="text-decoration:underline;color:black;">
                        <strong>Login now</strong></a></p>
                </div>
                <form id="registerform" class="container py-3 was-validated">
                    @csrf
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
                                    <label class="form-label fw-bold" for="catchment_area">Catchment Area</label>
                                    <input type="text" name="catchment_area" class="form-control py-2" id="catchment_area"
                                        placeholder="Enter your catchment area" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group mb-1">
                                    <label class="form-label fw-bold" for="cover_type">Cover Type</label>
                                    <input type="text" name="cover_type" class="form-control py-2" id="cover_type"
                                        placeholder="Enter your cover type" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group mb-1">
                                    <label class="form-label fw-bold" for="accreditation_count">Accreditation Count</label>
                                    <input type="text" name="accreditation_count" class="form-control py-2" id="accreditation_count"
                                        placeholder="Enter your accreditation count" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-5 text-black">
                            <div class="col-lg-12 mb-1">
                                <div class="form-group mb-1">
                                    <label class="form-label fw-bold" for="registration_date">Date of Registration</label>
                                    <input type="date" name="registration_date" class="form-control py-2" id="registration_date" required>
                                </div>
                            </div> 
                            <div class="col-lg-12 mb-1">
                                <div class="form-group mb-1">
                                    <label class="form-label fw-bold" for="service_start_date">Service Start Date</label>
                                    <input type="date" name="service_start_date" class="form-control py-2" id="service_start_date" required>
                                </div>
                            </div>
                            <div class="col-lg-12 mb-1">
                                <div class="form-group mb-1">
                                    <label class="form-label fw-bold" for="household_covered">Household Covered</label>
                                    <input type="text" name="household_covered" class="form-control py-2" id="household_covered"
                                        placeholder="Enter your household covered" required>
                                </div>
                            </div>
                            <div class="col-lg-12 mb-1">
                                <div class="form-group mb-1">
                                    <label class="form-label fw-bold" for="accreditation_date">Accreditation Date</label>
                                    <input type="date" name="accreditation_date" class="form-control py-2" id="accreditation_date" required>
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
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <a href="{{ route('admin.list_bhw') }}" class="btn btn-outline-dark fw-bold">← Back</a>
                        <button class="btn btn-secondary px-5 py-2 fw-bold rounded rounded-5" type="submit">Sign Up</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@include('partials.__footer')
