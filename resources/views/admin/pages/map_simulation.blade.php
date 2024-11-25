@include('admin.partials.__header')
@include('admin.partials.__nav')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Simulation</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                <li class="breadcrumb-item active">Simulation</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section user_management">

        <div class="container" >
            <div id="map" style="width: 100%; height: 700px;"></div>
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
