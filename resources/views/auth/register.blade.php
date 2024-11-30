@include('partials.__header')
<main class="custombg min-vh-100 loginpagebg">
    @include('partials.__nav')
    <div class="container py-3">
        <div class="card logincardbg bg-transparent">
            <div class="card-body">
                <div class="text-center">
                    <h3 class="fw-bold text-white">REGISTRATION</h3>
                    <p class="text-white">Already Registered ? <a href="{{ url('/') }}" style="text-decoration:none;color:#188754">Login now</a></p>
                </div>
                <form id="registerform" class="container py-3 was-validated">
                  <div class="row text-white">
                      <div class="col-lg-4 mb-3">
                          <div class="form-group mb-3">
                              <label class="form-label fw-bold" for="user_name">USER NAME</label>
                              <input type="text" name="user_name" class="form-control py-3" id="user_name"
                                  placeholder="Enter your username" required>
                          </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group mb-3">
                            <label class="form-label fw-bold" for="full_name">FULL NAME</label>
                            <input type="text" name="full_name" class="form-control py-3" id="full_name"
                                placeholder="Enter your full name" required>
                        </div>
                    </div>

                {{-- <div class="col-lg-4">
                          <div class="form-group mb-3">
                              <label class="form-label fw-bold" for="lname">LAST NAME <small>(Opotional)</small></label>
                              <input type="text" name="last_name" class="form-control py-3" id="lname"
                                  placeholder="Enter your last name" required>
                          </div>
                      </div>  --}}
                      
                  </div>
                  <div class="row mb-3 text-white">

                    <div class="col-lg-4 mb-3">
                        <div class="form-group mb-3">
                            <label class="form-label fw-bold" for="contact">PHONE NUMBER</label>
                            <input type="text" name="contact" class="form-control py-3" id="contact"
                                placeholder="Enter your contact number" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group mb-3">
                            <label class="form-label fw-bold" for="email">EMAIL</label>
                            <input type="email" name="email" class="form-control py-3" id="email"
                                placeholder="Enter your email" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group mb-3">
                            <label for="password" class="form-label fw-bold">PASSWORD</label>
                            <input type="password" name="password" class="form-control py-3" id="password"
                                placeholder="Create your password" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group mb-3">
                            <label for="password_confirmation" class="form-label fw-bold">CONFIRM PASSWORD</label>
                            <input type="password" name="password_confirmation" class="form-control py-3" id="password"
                                placeholder="Confirm your password" required>
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group mb-3">
                            <label for="user_type" class="form-label fw-bold">USER TYPE</label>
                            <select name="user_type" class="form-select py-3" required>
                                <option value="" hidden>Select user type</option>
                                <option value="1" {{ old('user_type') == 1 ? 'selected' : '' }}>Farmer</option>
                                <option value="2" {{ old('user_type') == 2 ? 'selected' : '' }}>Technician</option>
                            </select>
                            @error('user_type')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                    {{--<div class="col-lg-6">
                        <div class="col-lg-4 mb-3">
                        <div class="form-group mb-3">
                            <label class="form-label fw-bold" for="gender">GENDER</label>
                            <select name="gender" id="gender" class="form-select py-3" required>
                                <option value="">--Choose--</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                    </div> 
                    <div class="col-lg-6">
                      <div class="form-group mb-3">
                          <label class="form-label fw-bold" for="address">ADDRESS</label>
                          <input type="text" name="address" class="form-control py-3" id="address"
                              placeholder="Enter your address" required>
                      </div>
                    </div> 
                    <div class="form-group mb-3">
                        <label class="form-label fw-bold" for="valid_id">Valid ID: </label>
                        <input type="file" name="valid_id" class="form-control py-3" id="valid_id" accept="image/*" required>
                    </div>
                  </div> --}}


                </div>
               {{-- <div class="mg-3">
                    <div class="mb-3">
                        <div class="form-check d-flex justify-content-center">
                            <input class="form-check-input me-2" type="checkbox" checked value="" id="terms-and-condition" required />
                            <label class="form-check-label" for="terms-and-condition">
                                I agree to the <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal">Terms and Conditions</a>
                            </label>
                        </div>
                    </div>
                </div> --}}
                @csrf
                <div class="text-center">
                  <button class="btn btn-success px-5 py-2 fw-100 rounded rounded-3" type="submit">CREATE ACCOUNT</button>
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
