@include('bhw.partials.__header')
@include('bhw.partials.__nav')


<main id="main" class="main">
    <div class="pagetitle text-center mb-5">
        <h1 class="fw-bold">Census List</h1>
    </div>

    <!-- Announcement Button (Bell Icon) -->
    

    <div class="container shadow p-5 rounded bg-light">
        <div class="row">
            <!-- Mother Census List Section -->
            <div class="col-md-6">
                <h3 class="mb-4">Mother Census List</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($familyMembers as $familyMember)
                        <tr>
                            <td>{{ $familyMember->full_name }}</td>
                            <td>
                                <a href="{{ route('bhw.pages.viewData', $familyMember->id) }}" class="btn btn-info">View Data</a>

                                <!-- Delete Button Form -->
                                <form action="{{ route('bhw.pages.deleteData', $familyMember->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Child Census List Section -->
            <div class="col-md-6">
                <h3 class="mb-4">Child Census List</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($childs as $child)
                        <tr>
                            <td>{{ $child->complete_name }}</td>
                            <td>
                                <a href="{{ route('bhw.pages.viewChildData', $child->id) }}" class="btn btn-info">View Data</a>

                                <!-- Delete Button Form -->
                                <form action="{{ route('bhw.pages.deleteChildData', $child->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

@include('bhw.partials.__footer')
