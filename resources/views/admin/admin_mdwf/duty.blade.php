@include('admin.partials.__header')
@include('admin.partials.__nav')

<main id="main" class="main">
    <div class="pagetitle mb-5">
        <h1><strong>Duty Schedule</strong></h1>
    </div>
    <section class="section schedule">
        <div class="content">
            <div class="container-fluid">
                <div class="mb-3 d-flex justify-content-end">
                    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addDutyModal">Add Duty</button>
                </div>

                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Name of BHW</th>
                            <th>Barangay</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Remark</th>
                            <th>Attendance</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($duty_schedules as $schedule)
                        <tr>
                            <td>{{ $schedule->name_of_bhw }}</td>
                            <td>{{ $schedule->barangay }}</td>
                            <td>{{ $schedule->date }}</td>
                            <td>{{ $schedule->time }}</td>
                            <td>{{ $schedule->remark ?? 'N/A' }}</td>
                            <td>
                                @if($schedule->attendance == 'Pending')
                                    <span class="badge bg-warning">Pending</span>
                                @elseif($schedule->attendance == 'Absent')
                                    <span class="badge bg-danger">Absent</span>
                                @elseif($schedule->attendance == 'Present')
                                    <span class="badge bg-success">Present</span>
                                @endif
                            </td>
                            <td>
                                @if($schedule->attendance == 'Pending')
                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#attendanceModal{{ $schedule->id }}">Set Attendance</button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <a href="{{ route('admin.schedule.index') }}" class="btn btn-primary"><-Schedule of Visit</a>
            </div>
        </div>
    </section>
</main>

<!-- Add Schedule Modal -->
<div class="modal fade" id="addDutyModal" tabindex="-1" aria-labelledby="addDutyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addDutyModalLabel">Add Duty Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.duty.add') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name_of_bhw" class="form-label">Name of BHW</label>
                        <input type="text" class="form-control" id="name_of_bhw" name="name_of_bhw" required>
                    </div>
                    <div class="mb-3">
                        <label for="barangay" class="form-label">Barangay</label>
                        <input type="text" class="form-control" id="barangay" name="barangay" required>
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" class="form-control" id="date" name="date" required>
                    </div>
                    <div class="mb-3">
                        <label for="time" class="form-label">Time</label>
                        <input type="time" class="form-control" id="time" name="time" required>
                    </div>
                    <div class="mb-3">
                        <label for="remark" class="form-label">Remark</label>
                        <textarea class="form-control" id="remark" name="remark"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Event</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Attendance Modal -->
@foreach ($duty_schedules as $schedule)
<div class="modal fade" id="attendanceModal{{ $schedule->id }}" tabindex="-1" aria-labelledby="attendanceModalLabel{{ $schedule->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="attendanceModalLabel{{ $schedule->id }}">Set Attendance for {{ $schedule->name_of_bhw }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.duty.updateAttendance', $schedule->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="attendance" class="form-label">Attendance</label>
                        <select name="attendance" class="form-select">
                            <option value="Present">Present</option>
                            <option value="Absent">Absent</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Attendance</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

@include('admin.partials.__footer')


