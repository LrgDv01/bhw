@include('admin.partials.__header')
@include('admin.partials.__nav')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Users Logging / Audit trails</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                <li class="breadcrumb-item active">Users Logging / Audit trails</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section user_management">
        <div class="card">
            <div class="card-body py-3 table-responsive">
                
                <div class="row">
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4 text-end">
                        <input type="date" id="audit_date" value="{{ \Carbon\Carbon::now()->format('Y-m-d')  }}" class="form-control">
                    </div>
                </div>
                <table class="table" id="audit_table">
                    <thead>
                        <tr>
                            <th>IP</th>
                            <th>User ID</th>
                            <th>Type</th>
                            <th>Content</th>
                            <th>Date</th>
                            <th>Time</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </section>
</main>

@include('admin.partials.__footer')
