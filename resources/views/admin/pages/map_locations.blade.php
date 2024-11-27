@include('admin.partials.__header')
@include('admin.partials.__nav')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Map</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                <li class="breadcrumb-item active">Map</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">

        <div class="container d-flex justify-content-between">  
            <div class="card shadow-sm" style="width: 20rem;"> <!-- Adjust width -->
                <div class="card-header bg-primary text-white d-flex justify-content-center">
                    <h5 class="mb-0">Municipalities</h5>
                </div>
                <div class="card-body">
                    <!-- Dropdown for Location Selection -->
                    <div class="form-group mt-3">
                        <!-- <label for="location" class="form-label">Choose a Location:</label> -->
                        <select id="location" class="form-select">
                        <option value="All Municipal"selected >All Municipal</option>
                        </select>
                    </div>

                    <!-- Area to Display Selected Location Details -->
                    <div id="details" class="mt-4 alert alert-info" style="display: none;">
                        <h5 class="alert-heading">Location Details</h5>
                        <hr>
                        <p><strong>Lot Area:</strong> <span id="lot-area"></span> hectares</p>
                        <p><strong>Number of Trees:</strong> <span id="number-of-trees"></span></p>
                        <p><strong>Meters:</strong> <span id="meters"></span> meters</p>
                    </div>
                </div>
            </div>
        
            <div id="map_locations" style="width: 70%; height: 700px;"></div>
        </div>

        {{-- 
            <div class="card">
            <div class="card-body py-3 table-responsive">
                <div class="text-end">
                    <a href="{{ url('admin/add_account') }}" class="btn btn-primary btn-sm">Add account</a>
                </div>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link text-dark fw-bold choose-type active" id="personel-tab" data-bs-toggle="tab" data-bs-target="#personel"
                            type="button" role="tab" aria-controls="personel" aria-selected="true">
                            Personel
                        </button>
                    </li>
                    <!-- <li class="nav-item" role="presentation">
                      <button class="nav-link text-dark fw-bold choose-type" id="visitor-tab" data-bs-toggle="tab" data-bs-target="#visitor"
                          type="button" role="tab" aria-controls="visitor" aria-selected="true">
                          Visitor
                      </button>
                    </li>  -->
                </ul>
                <table class="table" id="users_table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
            --}}

    </section>
{{-- 
    <div class="modal fade" id="userProfileModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        role="dialog" aria-labelledby="userProfileTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        </div>
    </div>
    <div class="modal fade" id="moduleAccessModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        role="dialog" aria-labelledby="moduleAccessTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        </div>
    </div>
    --}}

</main>

@include('admin.partials.__footer')
