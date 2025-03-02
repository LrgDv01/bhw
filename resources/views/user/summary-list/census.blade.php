@include('admin.partials.__header')
@include('admin.partials.__nav')

<main id="main" class="main">
    <div class="pagetitle mb-3">
        <h1 class="fs-3"><strong>Summary List</strong></h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Summary List</li>
                <li class="breadcrumb-item"><a href="{{ route('admin.summary-list.census') }}" class="{{ Request::is('admin/summary-list/census') ? 'active' : '' }}">Census</a></li>
            </ol>
        </nav>
    </div>
    <section class="section family-planning">
    <div class="mt-3">
        <h2 class="text-center"><strong>Census Report</strong></h2>
        {{--  <button onclick="window.location.href='{{ route('bhw.services') }}'">Back</button> --}}
   
        <div class="container mt-2">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>BARANGAY</th>
                        <th>REPORT NAME</th>
                        <th>SUBMISSION DATE</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                {{--  @foreach($records as $record)
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                       <td class="text-center">
                            <a href="{{ route('bhw.deworming.edit', $record->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('bhw.deworming.destroy', $record->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach--}}
                </tbody>
            </table>
         {{--   <div class="d-flex justify-content-end">
              {{ $records->links('pagination::bootstrap-5') }}
            </div>--}}
        </div>
        <div class="d-flex justify-content-end">
            <button class="btn btn-primary rounded rounded-3">
                <a class="text-white" href="{{route('admin.analytics.census')}}">View Analytics</a>
            </button>
        </div>
    </div>


    <div class="modal fade" id="addRecordModal" tabindex="-1" aria-labelledby="addRecordModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addRecordModalLabel"><strong>New Deworming</strong></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('bhw.deworming.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="full_name" class="form-label fw-bold">Full Name:</label>
                            <input type="text" name="full_name"  class="form-control w-full border rounded-lg p-2 mb-3" id="full_name" 
                                required autocomplete="full_name">
                        </div>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between">
                                <label for="age" class="form-label fw-bold">Age:</label>
                                <div class="d-flex">
                                    <div class="me-3">
                                        <label class="form-label fw-bold" for="age-months">Months:</label>
                                        <input type="radio" id="age-months" name="ageUnit" value="months" checked>
                                    </div>
                                    <div>
                                        <label class="form-label fw-bold" for="age-years">Years:</label>
                                        <input type="radio" id="age-years" name="ageUnit" value="years">
                                    </div>
                                </div>
                            </div>
                            <input type="number" name="age" class="form-control w-full border rounded-lg p-2 mb-3" id="age" 
                                required autocomplete="age">
                        </div>
                        <div class="mb-4">
                            <label for="gender" class="form-label fw-bold">Gender:</label>
                            <select name="gender" class="form-select w-full border rounded-lg p-2 mb-3">
                                <option value="">Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="d-flex justify-content-end mb-3">
                            <button type="submit" class="btn btn-success rounded rounded-3 fs-5"><strong>Save</strong></button>
                        </div>   
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </section>
</main>

@include('admin.partials.__footer')