@include('admin.partials.__header')
@include('admin.partials.__nav')


<style>
    .card {
        background-color:grey;
        border-radius: 25px;
        height: auto;
    }
    .card.gray-card {
        background-color: #a6a6a6;
        border-radius: 15px;    
        color: black;
    }
    .card h5 {
        color:white;
    }

    .card h5 span{
        color:white;
    }
    .card #total_population,
          #total_maternal,
          #total_deworming,
          #total_women {
            color:white;
            font-size: 22px;
    }
    .card i {
        color:grey;
    }
    .card.women, .deworming, .forecast {
        background-color: white;
        border-radius: 15px; 
    }

    /* Optional: for smooth zoom transitions */
    #deworming_chart {
        transition: transform 0.2s ease;
    }


    #card-forecast {
        background-color: #fefefe;
        border: 1px solid #888;
        width: 100%;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    #hideForecastChartBtn {
        margin-top: 10px;
        margin-bottom: 10px;
        background-color: grey;
        color: white;
        border: none;
        padding: 8px 16px;
        font-size: 16px;
        cursor: pointer;
        border-radius: 10px;
    }
    #hideForecastChartBtn:hover {
        background-color: dark;
    }


</style>

<main id="main" class="main">
    <div class="pagetitle mt-5">
        <h1 class="fs-3"><strong>Dashboard</strong></h1>
    </div>
    <section class="section dashboard mt-4">
        <div class="row mt-3">
            <div class="d-flex justify-content-end align-item-center py-2"  style="position: fixed; top: 60px; z-index: 995; right:0; left:0; background-color: #f8f9fa; width:100%;">
                <div class="col-lg-3 d-flex align-items-center text-start">
                    <h5><strong>Barangay</strong></h5>
                    <div class="form-group">
                        <select id="location" class="form-select mx-3">
                            <option value="All Barangays" selected>All Barangay</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-2 d-flex align-items-center text-start">
                    <h5><strong>Year</strong></h5>
                    <select id="yearSelect" class="form-select mx-3">
                        <option value="all" selected>Select Year</option> 
                    </select>
                </div>
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
                        <div class="card info-card cardiconbg">
                            <div class="card-body">
                                <h5 class="card-title"><span> Today's | </span>Total <br> Population </h5>
                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3 d-flex flex-row">
                                        <h6 id="total_population">0</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 mb-3">
                        <div class="card info-card cardiconbg">
                            <div class="card-body">
                                <h5 class="card-title"><span> Today's | </span>Total Maternal Care Beneficiaries</h5>
                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="value ps-3">
                                        <h6 id="total_maternal">0</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 mb-3">
                        <div class="card info-card cardiconbg">
                            <div class="card-body">
                                <h5 class="card-title"><span> Today's | </span>Total Deworming <br> Beneficiaries</h5>
                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6 id="total_deworming">0</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 mb-3">
                        <div class="card info-card cardiconbg">
                            <div class="card-body">
                                <h5 class="card-title"><span> Today's | </span> Total Women in Reproductive Ages</h5>
                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6 id="total_women">0</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="row">
                    <div class="col-lg-7 mb-3">
                        <div class="card deworming">
                            <div class="card-body p-3">
                                <div style="width: 100%; height:auto; margin: auto;">
                                    <div id="deworming_chart" style="height: 370px; width: 100%;"></div>
                                    <div id="insight_container" class="mt-1 mb-0 p-2 text-center rounded" style="background-color:#d1dee7"></div>
                                    <div class="d-flex flex-row justify-content-center align-items-center py-2">
                                        <button id="showForecastChartBtn" type="button" class="btn btn-outline-secondary btn-sm rounded rounded-3">See Forecast</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card women">
                            <div class="card-body p-3">
                                <div id="chart" style="width: 100%; height:auto; margin: auto; ">
                                    <canvas id="womens_chart"></canvas>
                                </div>
                            </div>
                            <div class="d-flex flex-row justify-content-center">
                                <button id="resetZoomBtn1" class="btn btn-outline-secondary mb-2 btn-sm rounded rounded-3">Default View</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 mb-3">
                        <div class="card map">
                            <div class="card-body p-3">
                                <div id="map_locations" style="width: 100%; height: 500px; margin: auto;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="card-forecast" class="row" style="position: fixed; top: 20%; z-index: 995; right:0; left:20%; height:auto; width:70%;">
                    <div class="card forecast">
                        <div class="card-body">
                            <div class="d-flex justify-content-end">
                                <button id="hideForecastChartBtn" class="btn-close"></button>
                            </div>
                            <div class="d-flex flex-column align-items-center">
                                <div id="forecast_chart" class="mb-3" style="height: 350px; width: 90%;"></div> 
                                <div id="forecast_insight_container" class="p-3 pe-4 rounded" style="background-color:#d1dee7; height: auto; width:100%;"></div> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@include('admin.partials.__footer')
<script>
    window.userType = @json(auth()->user()->user_type);
    const card_forecast = document.getElementById('card-forecast');
    card_forecast.style.visibility = 'hidden'; 
</script>
