@include('admin.partials.__header')
@include('admin.partials.__nav')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Manage Reports</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                <li class="breadcrumb-item active">Manage Reports</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section user_management">
        <div class="card" style="height: 80vh">
            <div class="card-body py-3 table-responsive">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link text-dark fw-bold choose-type active" id="personel-tab" data-bs-toggle="tab" data-bs-target="#personel"
                            type="button" role="tab" aria-controls="personel" aria-selected="true">
                            Reports
                        </button>
                    </li>
                    
                </ul>
                
                {{-- Filter Field --}}
                <div class="text-center d-flex align-items-center justify-content-center" style="height: 30vh">
                  <div>
                    <h1 class="py-3">Filter Field</h1>
                    <div class="dropdown open">
                      <button
                        class="btn btn-primary btn-sm dropdown-toggle"
                        type="button"
                        id="exportbtn"
                        data-bs-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                      >
                        Export Data
                      </button>
                      <div class="dropdown-menu" aria-labelledby="exportbtn">
                        <button class="dropdown-item" href="#">Export to PDF</button>
                        <button class="dropdown-item" href="#">Export to Excel</button>
                      </div>
                    </div>
                  </div>
                </div>
                
                <hr>
                <table class="table" id="report_table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name Respondent</th>
                            <th>Date Created</th>
                            <th>Dete Last Updated</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </section>
</main>
<script>
  $(document).ready(function () {
    $('#report_table').DataTable();
  });
</script>
@include('admin.partials.__footer')
