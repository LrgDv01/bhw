@include('partials.__header')
{{-- <main class="custombg "> --}}
<main class="custombg min-vh-100 loginpagebg">
    <!-- Hero Section -->
    <section id="hero" class="hero section d-flex flex-row-reverse justify-content-center align-items-center">
        <div class="container d-flex justify-content-center">
            <div class="bg-transparent bg-opacity-50" style="width: 100vh">
                <!-- <div class="card-body"> -->
                    <div class="d-flex flex-row justify-content-center align-items-center mx-0 mt-5">
                        <div class="col-lg-6 mb-4 rounded-circle bg-white p-3" style="width: 150px; height: 150px;">
                            <img src="{{ URL::asset('img/bhw-logo.png') }}" alt="Logo" class="img-fluid rounded-5">
                        </div>
                        <div class="d-flex flex-column justify-content-center align-items-center ">
                            <h1 class="text-white text-center"><strong>REPUBLIC OF THE PHILIPPINES</strong></h1><hr>
                            <h3 class="text-white text-center"><strong>DEPARTMENT OF HEALTH <br> BARANGAY HEALTH WORKERS</strong></h3>
                            <div class="d-flex">
                                <a href="{{ url('/register') }}" class="btn btn-secondary fw-bold px-5 mx-4 rounded rounded-5 my-3">Sign Up </a>
                                <a href="{{ url('/login') }}" class="btn btn-secondary fw-bold px-5 mx-4 rounded rounded-5 my-3">Login</a>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4 rounded-circle bg-white p-3" style="width: 150px; height: 150px;">
                            <img src="{{ URL::asset('img/laguna-logo.png') }}" alt="Logo" class="img-fluid rounded-5">
                        </div>
                    </div>
                <!-- </div>         -->
            </div> 
        </div>
    </section><!-- /Hero Section -->
 @include('partials.__footer')

