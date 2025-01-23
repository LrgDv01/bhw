
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
                <a href="{{ route('admin.bhwregistration') }}" class="btn btn-success">Add BHW</a>
            </div>

            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Catchment Area</th>
                        <th>Cover Type</th>
                        <th>Accreditation Count</th>
                        <th>Household Covered</th>
                        <th>Service Start Date</th>
                        <th>Accreditation Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bhwUsers as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone_no }}</td>
                            <td>{{ $user->catchment_area }}</td>
                            <td>{{ $user->cover_type }}</td>
                            <td>{{ $user->accreditation_count }}</td>
                            <td>{{ $user->household_covered }}</td>
                            <td>{{ \Carbon\Carbon::parse($user->service_start_date)->format('F d, Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($user->accreditation_date)->format('F d, Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="text-center">No BHW users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</main>



@include('admin.partials.__footer')
