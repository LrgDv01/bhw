@include('bhw.partials.__header')
@include('bhw.partials.__nav')

<main id="main" class="main">
    <div class="pagetitle mb-5">
        <h1><strong>Visit and Activity Schedule</strong></h1>
    </div>
    <section class="section schedule">
        <div class="content">
            <div class="container-fluid">
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
                            
                        </tr>
                    </thead>
                    <tbody>
                        @if ($schedules->isEmpty())
                            <tr>
                                <td colspan="8" class="text-center">No schedules available.</td>
                            </tr>
                        @else
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
                                        <!-- Action buttons here -->
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>

                <div class="mb-3 d-flex justify-content-end">
                    <a href="{{ route('bhw.duty') }}" class="btn btn-primary">Schedule of Duty</a>
                    <a href="{{ route('myschedules.index') }}" class="btn btn-primary">Create My shedule</a>
                </div>
            </div>
        </div>
    </section>
</main>

@include('bhw.partials.__footer')

<!-- Bootstrap JS (Ensure Bootstrap is included in your layout) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
