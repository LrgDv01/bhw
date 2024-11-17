@include('admin.partials.__header')
@include('admin.partials.__nav')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">


    <h4>Accomplishment Report (Virtual visit)</h4>
        <!-- <div class="row"></div> -->
        <div class="row">
            <div class="col">
                <!-- <div class="col-lg-8 mb-3"> -->
                    <div class="col">
                        <div class="col-lg-7">
                            <div class="card info-card cardiconbg cardborderleft-blue">
                                <div class="card-body">
                                    <h5 class="card-title">Approved <span>| This Month</span></h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-hand-thumbs-up"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6 id="count_virtual_approved_book">0</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 mb-3">
                            <div class="card info-card cardiconbg cardborderleft-red">
                                <div class="card-body">
                                    <h5 class="card-title">Disapproved <span>| This Month</span></h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-hand-thumbs-down"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6 id="count_virtual_rejected_book">0</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 mb-3">
                            <div class="card info-card cardiconbg cardborderleft-yellow">
                                <div class="card-body">
                                    <h5 class="card-title">Pending <span>| This Month</span></h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-app-indicator"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6 id="count_virtual_pending_book">0</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                <!-- </div> -->
            </div>
   
            {{--     <h4>Accomplishment Report (Onsite visit)</h4>
            <div class="row">
                <div class="col-lg-8 mb-3">
                    <div class="row">
                        <div class="col-lg-4 mb-3">
                            <div class="card info-card cardiconbg cardborderleft-blue">
                                <div class="card-body">
                                    <h5 class="card-title">Approved <span>| This Month</span></h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-hand-thumbs-up"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6 id="count_physical_approved_book">0</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <div class="card info-card cardiconbg cardborderleft-red">
                                <div class="card-body">
                                    <h5 class="card-title">Disapproved <span>| This Month</span></h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-hand-thumbs-down"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6 id="count_physical_rejected_book">0</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <div class="card info-card cardiconbg cardborderleft-yellow">
                                <div class="card-body">
                                    <h5 class="card-title">Pending <span>| This Month</span></h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-app-indicator"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6 id="count_physical_pending_book">0</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  --}}
        
      
            <div class="col">
                <div class="row">
                    <div class="col-lg-3 mb-3">
                        <!-- <div class="row">  -->
                            <!-- <h4>Login and Appointment</h4> -->
                            <div class="card info-card cardiconbg cardborderleft-blue">
                                <div class="card-body">
                                    <h5 class="card-title">Login <span>| Today</span></h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-people"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6 id="count_login">0</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- </div>      -->
                    </div>
                    <div class="col-lg-3 mb-3">
                        <!-- <div class="row">  -->
                            <div class="card info-card cardiconbg cardborderleft-blue">
                                <div class="card-body">
                                    <h5 class="card-title">Appointment <span>| Today</span></h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-calendar-check"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6 id="count_today_book">0</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- </div> -->
                    </div>

                    <div class="col-lg-3 mb-3">
                        <!-- <div class="row">  -->
                            <div class="card info-card cardiconbg cardborderleft-blue">
                                <div class="card-body">
                                    <h5 class="card-title">Appointment <span>| Today</span></h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-calendar-check"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6 id="count_today_book">0</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- </div> -->
                    </div>
                    <div class="col-lg-3 mb-3">
                        <!-- <div class="row">  -->
                            <div class="card info-card cardiconbg cardborderleft-blue">
                                <div class="card-body">
                                    <h5 class="card-title">Appointment <span>| Today</span></h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-calendar-check"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6 id="count_today_book">0</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- </div> -->
                    </div>
  
                </div>

                <div class="row">
                    <div class="col-lg-8 mb-3">
                        <div class="row">
                            <div class="col-lg-8 d-flex align-items-center"><h4>Monthly Data</h4></div>
                            <div class="col-lg-4 text-end mb-3">
                                <select id="yearSelect" class="form-select"></select>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body p-3">
                                <div style="width: 100%; margin: auto;">
                                    <canvas id="monthlyChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 mb-3">
                        <div class="row">
                            <div class="col-lg-8 d-flex align-items-center"><h4>Monthly Data</h4></div>
                            <div class="col-lg-4 text-end mb-3">
                                <select id="yearSelect" class="form-select"></select>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body p-3">
                                <div style="width: 100%; margin: auto;">
                                    <canvas id="monthlyChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
       
        </div>
    </section>

</main>

@include('admin.partials.__footer')
