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
                            <div class="col-lg-6 d-flex align-items-center justify-content-center mb-5 rounded-circle bg-white p-3" style="width: 150px; height: 150px;">
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
                                                <a href="{{ url('/forgot-password') }}" class="text-white text-decoration-none">Forgot Password?</a>
                                            </div>
                                        </div>
                                        
                                        {{-- <div class="row">
                                            <div class="col-5 text-center"><hr style="width: 100%"></div>
                                            <div class="col-2 text-center">OR</div>
                                            <div class="col-5 text-center"><hr style="width: 100%"></div>
                                        </div> --}}
                                        {{-- <div class="text-center fw-bold mb-3"><h5>Login using <a href="{{ url('codelogin') }}" style="text-decoration: none">Code</a></h5></div> --}}
                                        {{-- <div class="mb-3 text-center">
                                            <div class="form-check d-flex justify-content-center">
                                                <input class="form-check-input me-2" type="checkbox" value="" checked id="terms-and-condition" required />
                                             <label class="form-check-label fs-6 text-white" for="terms-and-condition">
                                                    I agree to the <a href="#" data-bs-toggle="modal" class="text-white" data-bs-target="#termsModal">Terms and Conditions</a>
                                                </label> 
                                            </div>
                                        </div>--}}
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
       

        {{-- 
        <div class="container">
            <div class="row gy-4">
               
                <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
                    <h1>Title</h1>
                    <p>"Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatum aperiam doloremque voluptate
                        sapiente, est commodi aspernatur nam facere alias officiis molestias labore, maiores odio,
                        tempore praesentium cupiditate nobis doloribus velit."</p>
                   
                  <div>
                        <a href="{{ url('/register') }}" class="btn-get-started fw-bold" style="display: none">Request a
                            visit</a>
                        <a href="https://www.youtube.com/watch?v=LXb3EKWsInQ"
                            class="glightbox btn-watch-video d-flex align-items-center"></a>
                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2 hero-img d-flex justify-content-center">
                    <img src="{{ asset('img/famy-img.jpg') }}"
                        style="height:500px;border-radius:70% 30% 62% 38% / 37% 60% 40% 63%;box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);
                        -webkit-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);
                        -moz-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);"
                        class="img-fluid animated d-none d-sm-block" alt="">
                </div>
              
            </div>
        </div>
        --}}

    </section><!-- /Hero Section -->
    {{-- <section id="gallery" class="gallery section min-vh-100 bg-black bg">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="container section-title" data-aos="fade-up">
                <h2>About Us</h2>
            </div>
            <div class="card custombgcard">
                <div class="card-body" style="color:white">
                    {!! isset($appInfo->about_us)
                        ? $appInfo->about_us
                        : 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Facere expedita repellat neque amet! Id sit praesentium consequuntur harum, culpa ab tempore nisi alias dolorem hic consequatur a porro excepturi atque.' !!}
                </div>
            </div>
        </div>
    </section>
     <section id="services" class="services section bg-dark">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2 class=" text-white">Services</h2>
        </div><!-- End Section Title -->

        <div class="container">
            <div class="row gy-4">
                <div class="col-xl-6 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-item position-relative">
                        <i class="bi bi-person-bounding-box"></i>
                        <h4 class="fw-bold"><a href="" class="stretched-link">Onsite Visit</a></h4>
                        <p class="fw-bold">
                            We offer an online platform for scheduling visits to Persons Deprived of Liberty (PDL)
                            facilities.
                            Our system allows you to easily book an appointment at your convenience,
                            ensuring a smooth process without the need for in-person scheduling. Whether planning a
                            personal
                            visit or coordinating with staff, our user-friendly interface makes arranging your visit
                            simple and efficient.
                        </p>
                    </div>
                </div>
                <div class="col-xl-6 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="200">
                    <div class="service-item position-relative">
                        <i class="bi bi-camera-video"></i>
                        <h4 class="fw-bold"><a href="" class="stretched-link">Virtual Visit</a></h4>
                        <p class="fw-bold">
                            We provide an online platform for scheduling virtual visits with Persons Deprived of Liberty
                            (PDL),
                            allowing you to book an appointment at your convenience. Our user-friendly system ensures
                            a smooth and efficient process, making it easy to arrange a virtual visit from the comfort
                            of your home or office.</p>
                    </div>
                </div>
            </div>
        </div>

    </section>
    @if ($announcement->isNotEmpty())
        <section id="alt-services" class="alt-services section">
            <h2 class="text-center fw-bold">Announcement</h2>
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row gy-4">
                    @foreach ($announcement as $item)
                        <div class="col-lg-6" data-aos="zoom-in" data-aos-delay="200">
                            <div class="service-item position-relative">
                                <div class="img">
                                    <img src="{{ isset($item->image) ? asset('storage/' . $item->image) : asset('img/banner.jpg') }}"
                                        class="img-fluid" alt="">
                                </div>
                                <div class="details">
                                    <a href="{{ url('/announcement/' . $item->id) }}" class="stretched-link text-break">
                                        <h3>{{ $item->title }}</h3>
                                    </a>
                                    <p>Posted on: {{ date('F j, Y', strtotime($item->created_at)) }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    <section>
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="container section-title" data-aos="fade-up">
                <h2>Location</h2>
            </div>
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4839.832282418504!2d121.44514297599561!3d14.437753036029514!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397f1dfcf00932b%3A0xe7667396cc674def!2sFamy%20Municipal%20Hall%2C%20V.Maliwanag%20St%2C%20Famy%2C%20Laguna!5e1!3m2!1sen!2sph!4v1730431563294!5m2!1sen!2sph"
                width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section> --}}
     @include('partials.__footer')

