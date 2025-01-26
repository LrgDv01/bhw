
@include('admin.partials.__header')
@include('admin.partials.__nav')

<main id="main" class="main">
    <!-- Sidebar -->
    <!-- Main Content -->
    <div class="content">
        <div class="container-fluid">
            <h1 class="mb-4">List of BHW Users</h1>

            <!-- Add BHW Button -->
            <div class="mb-3">
                <a href="{{ route('admin.bhwregistration.index') }}" class="btn btn-success">Add BHW</a>
            </div>
            {{-- <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Cover Type</th>
                        <th>Catchment Area</th>
                        <th>Accreditation Count</th>
                        <th>Household Covered</th>
                        <th>Accreditation Date</th>
                        <th>Service Start Date</th>
                        <th>Date of Registration</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bhwUsers as $user)
                        <tr>
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
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="text-center">No BHW users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table> --}}
        </div>
    </div>

</main>

@include('admin.partials.__footer')
