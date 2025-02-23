@include('bhw.partials.__header')
@include('admin.partials.__nav')

<main id="main" class="main">
    <div class="pagetitle mb-5">
        <h1><strong>Duty Schedule</strong></h1>
    </div>
    <section class="section schedule">
        <div class="content">
            <div class="container-fluid">
                

                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                        <th>Name of BHW</th>
                        <th>Barangay</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Remark</th>
                        <th>Attendance</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($duty_schedules as $schedule)
                        <tr>
                            <td>{{ $schedule->name_of_bhw }}</td>
                            <td>{{ $schedule->barangay }}</td>
                            <td>{{ $schedule->date }}</td>
                            <td>{{ $schedule->time }}</td>
                            <td>{{ $schedule->remark ?? 'N/A' }}</td>
                            <td>{{ $schedule->attendance }}</td>
                            
                                
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No duty schedules available.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>

                <div class="mb-3 d-flex justify-content-end">
                    <a href="{{ route('bhw.schedule') }}" class="btn btn-primary">Schedule of Visit</a>
                    <a href="{{ route('myschedules.index') }}" class="btn btn-primary">Create My shedule</a>
                </div>
            </div>
        </div>
    </section>
</main>



@include('bhw.partials.__footer')


