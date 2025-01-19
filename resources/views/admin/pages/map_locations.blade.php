@include('admin.partials.__header')
@include('admin.partials.__nav')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Map</h1>
    </div>
    <section class="section map mt-4">

        <div class="container d-flex justify-content-between">  
            <div class="card shadow-sm" style="width: 20rem;"> <!-- Adjust width -->
                <div class="card-header bg-primary text-white d-flex justify-content-center">
                    <h5 class="mb-0">Barangays</h5>
                </div>
                <div class="card-body">
                    <!-- Dropdown for Location Selection -->
                    <div class="form-group mt-3">
                        <select id="location" class="form-select">
                        <option value="All Municipal"selected >All Barangay</option>
                        </select>
                    </div>

                    <!-- Area to Display Selected Location Details -->
                    <div id="details" class="mt-4 alert alert-info" style="display: none;">
                        <h5 class="alert-heading">Location Details</h5>
                        <hr>
                        <p><strong>Populations:</strong> <span id="populations"></span> </p>
                        <p><strong>Womens:</strong> <span id="Womens"></span></p>
                        <p><strong>Childs:</strong> <span id="childs"></span> </p>
                    </div>
                </div>
            </div>
            <div id="map_locations" style="width: 70%; height: 700px;"></div>
        </div>
    </section>
</main>

@include('admin.partials.__footer')
