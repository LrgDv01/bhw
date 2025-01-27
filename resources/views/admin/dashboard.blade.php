@include('admin.partials.__header')
@include('admin.partials.__nav')


<style>
    .card.gray-card {
        background-color: #a6a6a6;
        border-radius: 15px;    
        color: black;
    }
    .card h5 {
        color:black;
    }
    .card h5 span{
        color:black;
    }
    .card #total_population,
          #total_maternal,
          #total_deworming,
          #total_women {
            color:white;
    }
    .card i {
        color:green;
    }
    .card.women-chart, .child-chart {
        background-color: white;
        border-radius: 15px; 
    }

</style>

<main id="main" class="main">
    <div class="pagetitle">
        <h1><strong>Dashboard</strong></h1>
    </div>
    <section class="section dashboard mt-4">
        <div class="row">
            <div class="col-lg-3 d-flex align-items-center text-start mb-3">
                <h4><strong>Barangay</strong></h4>
                <select id="selectBarangay" class="form-select mx-3">
                    <option value="all" place-holder="">Select Barangay</option>
                </select>
            </div>
            <div class="col-lg-3 d-flex align-items-center text-start mb-3">
                <h4><strong>Year</strong></h4>
                <select id="yearSelect" class="form-select mx-3">
                    <option value="all" place-holder="">Select Year</option> 
                </select>
            </div>
        </div>
        <div id="checkboxList" class="d-none">
            <label><input type="checkbox" id="monthlyFilter"> </label><br>
            <label><input type="checkbox" id="yearlyFilter"> </label><br>
         </div>
        <div class="row">
            <div class="col">
                <div class="row">
                    <div class="col-lg-3 mb-3">
                        <div class="card info-card cardiconbg gray-card">
                            <div class="card-body">
                                <h5 class="card-title"><span> Today's | </span>Total <br> Population </h5>
                                <div class="d-flex align-items-center">
                                    <div class="ps-3 d-flex flex-row">
                                        <h6 id="total_population">0</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 mb-3">
                        <div class="card info-card cardiconbg gray-card">
                            <div class="card-body">
                                <h5 class="card-title"><span> Today's | </span>Total Maternal Care Beneficiaries</h5>
                                <div class="d-flex align-items-center">
                                    <div class="ps-3">
                                        <h6 id="total_maternal">0</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 mb-3">
                        <div class="card info-card cardiconbg gray-card">
                            <div class="card-body">
                                <h5 class="card-title"><span> Today's | </span>Total Deworming Beneficiaries</h5>
                                <div class="d-flex align-items-center">
                                    <div class="ps-3">
                                        <h6 id="total_deworming">0</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 mb-3">
                        <div class="card info-card cardiconbg gray-card">
                            <div class="card-body">
                                <h5 class="card-title"><span> Today's | </span> Total Women in Reproductive Ages</h5>
                                <div class="d-flex align-items-center">
                                    <div class="ps-3">
                                        <h6 id="total_women">0</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-8 mb-3">
                        <div class="card women-chart">
                            <div class="card-body p-3">
                                <div style="width: 100%; margin: auto;">
                                    <canvas id="womens_chart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 mb-3">
                        <div class="card child-chart">
                            <div class="card-body p-3">
                                <div style="width: 100%; margin: auto;">
                                    <canvas id="childs_chart"></canvas>
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
