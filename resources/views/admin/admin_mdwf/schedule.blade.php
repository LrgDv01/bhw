@include('admin.partials.__header')
@include('admin.partials.__nav')

<main id="main" class="main">
    <div class="content">
        <div class="container-fluid">
            <h1 class="mb-4">SCHEDULE OF ACTIVITIES</h1>

            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Activities</th>
                        <th>Date</th>
                        <th>Assigned</th>
                        <th>Address</th>
                        <th>Target</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($schedules as $schedule)
                        <tr>
                            <td>{{ $schedule->id }}</td>
                            <td>{{ $schedule->activities }}</td>
                            <td>{{ $schedule->date }}</td>
                            <td>{{ $schedule->assigned }}</td>
                            <td>{{ $schedule->address }}</td>
                            <td>{{ $schedule->target }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mb-3 d-flex justify-content-end">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addEventModal">
                    Add Events
                </button>
            </div>
        </div>
    </div>
</main>

<!-- Add Event Modal -->
<div class="modal fade" id="addEventModal" tabindex="-1" aria-labelledby="addEventModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addEventModalLabel">Add New Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.schedule.add') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Activity</label>
                        <input type="text" name="activities" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Date</label>
                        <input type="date" name="date" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Assigned</label>
                        <input type="text" name="assigned" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <input type="text" name="address" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Target</label>
                        <input type="text" name="target" class="form-control" required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save Event</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@include('admin.partials.__footer')

<!-- Bootstrap JS (Ensure Bootstrap is included in your layout) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
