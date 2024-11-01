@include('partials.__header')
{{-- <main class="custombg"> --}}
@include('partials.__nav')
<main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section min-vh-100">

        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
                    <h1>Title</h1>
                    <p>"Description"</p>
                    <div class="d-flex">
                        <a href="{{ url('/register') }}" class="btn-get-started fw-bold" style="display: none">Request a visit</a>
                        <a href="https://www.youtube.com/watch?v=LXb3EKWsInQ"
                            class="glightbox btn-watch-video d-flex align-items-center"></a>
                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2 hero-img d-flex justify-content-center">
                    <img src="{{ asset('img/frontimg.png') }}" style="height:500px;"
                        class="img-fluid animated d-none d-sm-block" alt="">
                </div>
            </div>
        </div>

    </section><!-- /Hero Section -->
    <section id="gallery" class="gallery section min-vh-100 bg-black bg">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="container section-title" data-aos="fade-up">
                <h2>About Us</h2>
            </div>
            <div class="card custombgcard">
                <div class="card-body" style="color:white">
                    {!! isset($appInfo->about_us) ? $appInfo->about_us : 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Facere expedita repellat neque amet! Id sit praesentium consequuntur harum, culpa ab tempore nisi alias dolorem hic consequatur a porro excepturi atque.' !!}
                </div>
            </div>
        </div>
    </section>
    {{-- <section id="services" class="services section bg-dark">

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

    </section> --}}
    @if($announcement->isNotEmpty())
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
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4839.832282418504!2d121.44514297599561!3d14.437753036029514!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397f1dfcf00932b%3A0xe7667396cc674def!2sFamy%20Municipal%20Hall%2C%20V.Maliwanag%20St%2C%20Famy%2C%20Laguna!5e1!3m2!1sen!2sph!4v1730431563294!5m2!1sen!2sph" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>
@include('partials.__footer')
