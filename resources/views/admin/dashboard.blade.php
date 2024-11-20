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
        <div class="row">
            <div class="col-lg-3 mb-1">
            
                <div class="col-lg-8">
                    <div class="card info-card cardiconbg cardborderleft-blue">
                        <div class="card-body">
                            <h5 class="card-title">Check <span>| for</span></h5>

                            <div id="checkboxList">
                                <label><input type="checkbox" id="monthlyFilter"> Monthly</label><br>
                                <label><input type="checkbox" id="yearlyFilter"> Yearly</label><br>
                            </div>

                            {{--    
                            <div class="d-flex align-items-center">
                                <div
                                    class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-hand-thumbs-up"></i>
                                </div>
                                <div class="ps-3">
                                    <h6 id="count_virtual_approved_book">0</h6>
                                </div>
                            </div>  --}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 mb-3">
                    <div class="card info-card cardiconbg cardborderleft-red">
                        <div class="card-body">
                            <h5 class="card-title">Check <span>| for</span></h5>
                            <div id="checkboxList">
                                <label><input type="checkbox" value="district_3"> District lll</label><br>
                                <label><input type="checkbox" value="district_4"> District lV </label><br>
                            
                            </div>
                            
                            {{-- 
                                <div class="d-flex align-items-center">
                                <div
                                    class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-hand-thumbs-down"></i>
                                </div>
                                <div class="ps-3">
                                    <h6 id="count_virtual_rejected_book">0</h6>
                                </div>
                            </div>
                                --}}
                            

                        </div>
                    </div>
                </div>
                <div class="col-lg-8 mb-3">
                    <div class="card info-card cardiconbg cardborderleft-yellow">
                        <div class="card-body">
                            <h5 class="card-title">Municipality <span>| This Month</span></h5>
                            <div id="checkboxList">
                                <label> San Pablo</label><br>
                                <label> Caluan</label><br>
                                <label> Liliw</label><br>
                                <label> Nagcarlan</label><br>
                                <label> Rizal</label><br>
                                <label> Victoria</label><br>
                            </div>
                            {{-- 
                            <div class="d-flex align-items-center">
                                <div
                                    class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-app-indicator"></i>
                                </div>
                                <div class="ps-3">
                                    <h6 id="count_virtual_pending_book">0</h6>
                                </div>
                            </div>
                                
                            --}}
                        
                        </div>
                    </div>
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
            
            </div>
        
            <div class="col">
                <div class="row">
                    <div class="col-lg-3 mb-3">
                        <!-- <div class="row">  -->
                            <!-- <h4>Login and Appointment</h4> -->
                            <div class="card info-card cardiconbg cardborderleft-blue">
                                <div class="card-body">
                                    <h5 class="card-title">Cost <span>| Today</span></h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-people"></i>
                                        </div>
                                        <div class="ps-6 d-flex flex-row">
                                            <h3 class="px-1">&#8369;</h3> <h6 id="count_today_total_cost">0</h6>
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
                                    <h5 class="card-title">Farmers <span>| Today</span></h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-calendar-check"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6 id="count_today_farmers">0</h6>
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
                                    <h5 class="card-title">Farms <span>| Today</span></h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-calendar-check"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6 id="count_today_farms">0</h6>
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
                                    <h5 class="card-title">DA <span>| Today</span></h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-calendar-check"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6 id="count_doa">0</h6>
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
                            <div class="col-lg-8 d-flex align-items-center"><h4>Diseases</h4></div>
                            <div class="col-lg-4 text-start mb-3">
                                <!-- Dropdown for selecting a specific year -->
                                <select id="yearSelect" class="form-select">
                                    <option value="all" place-holder="">Select Year</option> <!-- Option for all years -->
                                    <!-- Years will be added dynamically in JS -->
                                </select>

                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body p-3">
                                <div style="width: 100%; margin: auto;">
                                    <canvas id="diseases_chart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 mb-3">
                        <div class="row">
                            <div class="col-lg-8 d-flex align-items-center"><h4>Coconut Variety</h4></div>
                            <div class="col-lg-4 text-end mb-3">
                                <select id="yearSelect" class="form-select"></select>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body p-3">
                                <div style="width: 100%; margin: auto;">
                                    <canvas id="coconut_chart"></canvas>
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
