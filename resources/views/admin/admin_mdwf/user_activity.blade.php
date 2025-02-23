@include('admin.partials.__header')
@include('admin.partials.__nav')

<main id="main" class="main">
    <div class="pagetitle mb-5">
        <h1 class="fs-3"><strong>User Activity</strong></h1>
    </div>

    <section class="section user_activity">
        <div class="container">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0"><strong>BHW Activity Logs</strong></h5>
                </div>
                <div class="card-body">
                    
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>BHW Name</th>
                                        <th>Person's Name</th>
                                        <th>Details</th>
                                        <th>Date & Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                            </table>
                        </div>
                    
                </div>
            </div>
        </div>
    </section>
</main>

@include('admin.partials.__footer')
