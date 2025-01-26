@include('admin.partials.__header')
@include('admin.partials.__nav')

<main id="main" class="main">
    <div class="content">
        <div class="container-fluid">
            <div class="text-center">
                <h3 class="fw-bold text-black">Registration of BHW</h3>
            </div>
            <form id="bhw-register-form" class="container py-3 needs-validation" novalidate>
    @csrf
    <div class="row mb-1">
        <div class="col-lg-6 text-black">
            <div class="col-lg-12 mb-1">
                <div class="form-group mb-1">
                    <label class="form-label fw-bold" for="username">Username</label>
                    <input 
                        type="text" 
                        name="username" 
                        class="form-control py-2" 
                        id="username" 
                        placeholder="Enter your username" 
                        required 
                        autocomplete="username">
                    <div class="invalid-feedback">Please provide a valid email address, </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group mb-1">
                    <label class="form-label fw-bold" for="fullname">Full Name</label>
                    <input 
                        type="text" 
                        name="fullname" 
                        class="form-control py-2" 
                        id="fullname" 
                        placeholder="Enter your full name" 
                        required>
                    <div class="invalid-feedback"></div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group mb-1">
                    <label class="form-label fw-bold" for="email">Email</label>
                    <input 
                        type="email" 
                        name="email" 
                        class="form-control py-2" 
                        id="email" 
                        placeholder="Enter your email" 
                        required>
                    <div class="invalid-feedback">Please provide a valid email address, </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group mb-1">
                    <label class="form-label fw-bold" for="cover_type">Cover Type</label>
                    <input type="text" name="cover_type" class="form-control py-2" id="cover_type"
                        placeholder="Enter your cover type" required>
                    <div class="invalid-feedback"></div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group mb-1">
                    <label class="form-label fw-bold" for="catchment_area">Catchment Area</label>
                    <input 
                        type="text" 
                        name="catchment_area" 
                        class="form-control py-2" 
                        id="catchment_area"
                        placeholder="Enter your catchment area" 
                        required>
                    <div class="invalid-feedback"></div>
                </div>
            </div>
                        
            <div class="col-lg-12">
                <div class="form-group mb-1">
                    <label class="form-label fw-bold" for="accreditation_count">Accreditation Count</label>
                    <input type="text" name="accreditation_count" class="form-control py-2" id="accreditation_count"
                        placeholder="Enter your accreditation count" required>
                    <div class="invalid-feedback"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 text-black">
      
            <div class="col-lg-12 mb-1">
                <div class="form-group mb-1">
                    <label class="form-label fw-bold" for="household_covered">Household Covered</label>
                    <input type="text" name="household_covered" class="form-control py-2" id="household_covered"
                        placeholder="Enter your household covered" required>
                    <div class="invalid-feedback"></div>
                </div>
            </div>
            <div class="col-lg-12 mb-1">
                <div class="form-group mb-1">
                    <label class="form-label fw-bold" for="accreditation_date">Accreditation Date</label>
                    <input type="date" name="accreditation_date" class="form-control py-2" id="accreditation_date" required>
                    <div class="invalid-feedback"></div>
                </div>
            </div>
            <div class="col-lg-12 mb-1">
                <div class="form-group mb-1">
                    <label class="form-label fw-bold" for="service_start_date">Service Start Date</label>
                    <input type="date" name="service_start_date" class="form-control py-2" id="service_start_date" required>
                    <div class="invalid-feedback"></div>
                </div>
            </div>
          {{--  <div class="col-lg-12 mb-1">
                <div class="form-group mb-1">
                    <label class="form-label fw-bold" for="date_of_registration">Date of Registration</label>
                    <input type="date" name="date_of_registration" class="form-control py-2" id="date_of_registration" required>
                </div>
            </div> --}}
            <div class="col-lg-12">
                <div class="form-group mb-1">
                    <label for="password" class="form-label fw-bold">Password</label>
                    <input 
                        type="password" 
                        name="password" 
                        class="form-control py-2" 
                        id="password" 
                        placeholder="Create your password" 
                        required 
                        autocomplete="new-password">
                    <div class="invalid-feedback">Password must be provided, </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group mb-1">
                    <label for="password_confirmation" class="form-label fw-bold">Confirm Password</label>
                    <input 
                        type="password" 
                        name="password_confirmation" 
                        class="form-control py-2" 
                        id="password_confirmation" 
                        placeholder="Confirm your password" 
                        required 
                        autocomplete="new-password">
                    <div class="invalid-feedback">Passwords must match, </div>
                </div>
            </div>
        </div>
    </div>
    {{--<div class="form-group mb-5">
                    <label class="form-label fw-bold" for="profile_photo">Upload Profile</label>
                    <input type="file" name="profile_photo" class="form-control py-2" id="profile_photo" 
                        accept="image/*" required>
                    <img id="image_preview" src="#" alt="Image Preview" 
                        style="display:none; margin-top:10px; height:100px; width: 100px; border-radius: 150px;" />
                </div>--}}
    <div class="text-center d-flex justify-content-between">
        <a href="{{ route('admin.list_bhw') }}" class="btn btn-outline-dark fw-bold">← Back</a>
        <button class="btn btn-secondary px-5 py-2 fw-bold rounded rounded-5" type="submit">Add</button>
    </div>
</form>

         
        </div>
    </div>
</main>
@include('admin.partials.__footer')

<script>
    // document.getElementById('profile_photo').addEventListener('change', function(event) {
    //     const [file] = event.target.files;
    //     if (file) {
    //         const preview = document.getElementById('image_preview');
    //         preview.src = URL.createObjectURL(file);
    //         preview.style.display = 'block';
    //     }
    // });

    document.querySelector('.needs-validation').addEventListener('submit', function (event) {
        if (!this.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        }
        this.classList.add('was-validated');
        $('.invalid-feedback').append("This field is required.");

    });


    $(document).on('submit', '#bhw-register-form', function (e) { 
        e.preventDefault();
        let formData = new FormData(this);
        showLoading();
        $.ajax({
            method: "POST",
            url: "/admin/bhwregistration/submit", 
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) { 
                console.log("response >>>", response.message); 
                hideLoading();
                // $('#bhw-register-form')[0].reset();
                global_showalert(response.message, 'Registration Successful', 'green', '/admin/list_bhw');
                
            },
            error: function (xhr) {
                hideLoading();
                try {
                    let response = JSON.parse(xhr.responseText);
                    let errorMessage = 'An error occurred';
                    if (response.errors) {
                        errorMessage = Object.values(response.errors).map(err => err[0]).join('\n');
                    }
                    global_showalert(errorMessage, 'Failed !', 'red');
                } catch (err) {
                    global_showalert('An unexpected error occurred. Please try again.', 'Failed!', 'red');
                }
              
            }
        });
    });

</script>