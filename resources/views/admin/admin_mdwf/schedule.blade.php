@include('admin.partials.__header')
@include('admin.partials.__nav')

<main id="main" class="main">
    <div class="pagetitle mb-5">
        <h1><strong>Schedule</strong></h1>
    </div>
    <section class="section schedule">
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
                            <th>Status</th>
                        </tr>
                    </thead>
                    {{--<tbody>
                        @forelse($bhwUsers as $user)
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->fullname }}</td>
                        @if ($user->bhwInfo) 
                            <td>{{ $user->bhwInfo->cover_type }}</td>
                            <td>{{ $user->bhwInfo->catchment_area }}</td>
                            <td>{{ $user->bhwInfo->accreditation_count }}</td>
                            <td>{{ $user->bhwInfo->household_covered }}</td>
                            <td>{{ \Carbon\Carbon::parse($user->bhwInfo->accreditation_date)->format('F d, Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($user->bhwInfo->service_start_date)->format('F d, Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($user->bhwInfo->date_of_registration)->format('F d, Y') }}</td>
                        @endif 
                        <td>
                            <!-- Buttons for Present and Absent -->
                            <button type="button" class="btn btn-success btn-sm" onclick="markAttendance('{{ $user->id }}', 'present')">Present</button>
                            <button type="button" class="btn btn-danger btn-sm" onclick="markAttendance('{{ $user->id }}', 'absent')">Absent</button>
                        </td>

                        @empty
                            <tr>
                                <td colspan="11" class="text-center">No BHW users found.</td>
                            </tr>
                        @endforelse
                    </tbody> --}}
                </table>
                <div class="mb-3 d-flex justify-content-end">
                    <a href="{{ route('admin.bhwregistration.index') }}" class="btn btn-success">Add Events</a>
                </div>
            </div>
        </div>
    </section>
</main>
@include('admin.partials.__footer')

<!-- Bootstrap JS (Ensure Bootstrap is included in your layout) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
