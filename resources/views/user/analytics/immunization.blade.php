@include('admin.partials.__header')
@include('admin.partials.__nav')

<main id="main" class="main">
     <div class="pagetitle">
        <h1 class="fs-3"><strong>Summary List</strong></h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Summary List</li>
                <li class="breadcrumb-item"><a href="{{ route('admin.summary-list.immunization') }}" 
                    class="{{ Request::is('admin/summary-list/immunization') ? 'active' : '' }}">Immunization</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.analytics.immunization') }}" 
                    class="{{ Request::is('admin/analytics/immunization') ? 'active' : '' }}">Analytics</a></li>
            </ol>
        </nav>
    </div>
    <section class="section analytic mt-4">
        <div class="row mt-3 d-none">
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
        <h2 class="text-center"><strong>Immunization Anaytics</strong></h2>
        <div class="row mt-3">
            <div class="col">
                <div class="row py-0 my-0">
                    <div class="col-lg-6">
                        <div class="card women">
                            <div class="card-body p-3">
                                <div id="chart" style="width: 100%; height:auto; margin: auto; ">
                                    <canvas id="distributionImmunizationVaccine"></canvas>
                                </div>
                            </div>
                            <div class="d-flex flex-row justify-content-center">
                                <button id="distributionImmunizationVaccineResetZoomBtn" class="btn btn-outline-secondary mb-2 btn-sm rounded rounded-3">Default View</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card women">
                            <div class="card-body p-3">
                                <div id="chart" style="width: 100%; height:auto; margin: auto; ">
                                    <canvas id="distributionImmunizationAge"></canvas>
                                </div>
                            </div>
                            <div class="d-flex flex-row justify-content-center">
                                <button id="distributionImmunizationAgeResetZoomBtn" class="btn btn-outline-secondary mb-2 btn-sm rounded rounded-3">Default View</button>
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
</script>
