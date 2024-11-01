@include('admin.partials.__header')
@include('admin.partials.__nav')
<style>
    .table-responsive {
        overflow-x: auto;
    }

    .dataTables_wrapper .dataTables_scroll {
        overflow: auto;
    }

    table.dataTable td,
    table.dataTable th {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 200px;
    }
</style>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Announcement <a href="{{ url('/admin/add_announcement') }}" class="ms-3 btn btn-success btn-sm px-3"
                data-bs-toggle="tooltip" title="Add announcement">+</a></h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                <li class="breadcrumb-item active">Announcement</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section announcement">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="announcementTable">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Created at</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal for Reset Password Confirmation -->
    <div class="modal fade" id="deleteAnnouncement" tabindex="-1" aria-labelledby="deleteAnnouncementLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteAnnouncementLabel">Deactivate announcement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to deactivate this announcement?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-warning" id="deactivate_announcement">Confirm</button>
                </div>
            </div>
        </div>
    </div>
</main>

@include('admin.partials.__footer')
