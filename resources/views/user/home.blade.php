@include('user.partials.__header')
@include('user.partials.__nav')

<main id="main" class="main">

    <section class="section dashboard">
        <div class="text-center">
            <h4 class="fw-bold">VISITATION OPTIONS</h4>
        </div>
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-lg-6">
                        <img src="{{ URL::asset('img/virtual.jpg') }}" style="object-fit: cover; object-position: center;width:100%" height="300" alt="">
                        <a href="{{ url('/user/visit-form/physical') }}" class="py-2 w-100 rounded rounded-0 btn btn-primary">Onsite visit</a>
                        <div class="text-center mt-3">
                            <h5 class="fw-bold">NEED TO KNOW? IN Onsite visit</h5>
                            <p>Visitation hours are scheduled from 1 p.m. to 5 p.m. on Tuesdays, Wednesdays and Thursdays while on weekends the hours are from 8 a.m. to noon and from 1 p.m. to 5 p.m.</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <img src="{{ URL::asset('img/face-to-face.jpg') }}" style="object-fit: cover; object-position: center;width:100%" height="300" alt="">
                        <a href="{{ url('/user/visit-form/virtual') }}" class="py-2 w-100 rounded rounded-0 btn btn-primary">VIRTUAL VISIT</a>
                        <div class="text-center mt-3">
                            <h5 class="fw-bold">NEED TO KNOW IN VIRTUAL VISIT</h5>
                            <p>A visitor typically makes an online appointment for the visit with their incarcerated loved one in advance and pays any required fees. </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

@include('user.partials.__footer')
