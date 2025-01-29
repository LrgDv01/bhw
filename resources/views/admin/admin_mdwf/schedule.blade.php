@include('admin.partials.__header')
@include('admin.partials.__nav')

<main id="main" class="main">
    <div class="pagetitle mb-5">
        <h1><strong>Visit and Activity Schedule</strong></h1>
    </div>
    <section class="section schedule">
        <div class="content">
            <div class="container-fluid">
                <div class="mb-3 d-flex justify-content-end">
                   
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addScheduleModal">Add Schedule</button>
                    
                    </div>
                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Activities</th>
                            <th>Date</th>
                            <th>Assigned</th>
                            <th>Address</th>
                            <th>Target</th>
                            <th>Status</th>
                            <th>Action</th>
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
                                <td>{{ $schedule->status ?? 'Pending' }}</td>
                                <td>
                                <!-- Delete Button -->
                                <form action="{{ route('admin.schedule.delete', $schedule->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                
                    <a href="{{ route('admin.duty.index') }}" class="btn btn-primary">Schedule of Duty-></a>
                
            </div>
        </div>
    </section>
</main>

<!-- Add Schedule Modal -->
<div class="modal fade" id="addScheduleModal" tabindex="-1" aria-labelledby="addScheduleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addScheduleModalLabel">Add New Schedule</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.schedule.add') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="activities" class="form-label">Activities</label>
                        <input type="text" class="form-control" id="activities" name="activities" required>
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" class="form-control" id="date" name="date" required>
                    </div>
                    <div class="mb-3">
                        <label for="assigned" class="form-label">Assigned</label>
                        <input type="text" class="form-control" id="assigned" name="assigned" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" required>
                    </div>
                    <div class="mb-3">
                        <label for="target" class="form-label">Target</label>
                        <input type="text" class="form-control" id="target" name="target" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Schedule</button>
                </form>
            </div>
        </div>
    </div>
</div>

@include('admin.partials.__footer')

<!-- Bootstrap JS (Ensure Bootstrap is included in your layout) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
