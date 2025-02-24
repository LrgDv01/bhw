@include('bhw.partials.__header')
@include('admin.partials.__nav')

<main id="main" class="main">
    <div class="pagetitle mb-5">
        <h1><strong>My Schedule</strong></h1>
    </div>
    <section class="section schedule">
        <div class="content">
            <div class="container-fluid">
                <div class="mb-3 d-flex justify-content-end">
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addEventModal">Add Event</button>
                </div>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Date of Delivery</th>
                            <th>Remarks</th>
                            <th>Time of Visit</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($myschedules as $myschedule)
                            <tr>
                                <td>{{ $myschedule->name }}</td>
                                <td>{{ $myschedule->date_of_delivery }}</td>
                                <td>{{ $myschedule->remarks }}</td>
                                <td>{{ $myschedule->time_of_visit }}</td>
                                <td>
                                    <a href="{{ route('myschedules.show', $myschedule->id) }}" class="btn btn-primary btn-sm">View</a>
                                    <form action="{{ route('myschedules.updateStatus', $myschedule->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm {{ $myschedule->status == 'Already Visit' ? 'btn-success' : 'btn-warning' }}">
                                            {{ $myschedule->status }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No schedules available.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mb-3 d-flex justify-content-end">
                    <a href="{{ route('bhw.duty') }}" class="btn btn-primary">Schedule of Duty</a>
                    <a href="{{ route('bhw.schedule') }}" class="btn btn-primary">Schedule of Visit</a>
                </div>
            </div>
        </div>
    </section>
</main>

<div class="modal fade" id="addEventModal" tabindex="-1" aria-labelledby="addEventModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addEventModalLabel">Add New Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('myschedules.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="date_of_delivery" class="form-label">Date of Delivery</label>
                        <input type="date" class="form-control" id="date_of_delivery" name="date_of_delivery" required>
                    </div>
                    <div class="mb-3">
                        <label for="remarks" class="form-label">Remarks</label>
                        <textarea class="form-control" id="remarks" name="remarks" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="time_of_visit" class="form-label">Time of Visit</label>
                        <input type="time" class="form-control" id="time_of_visit" name="time_of_visit" required>
                    </div>
                    <button type="submit" class="btn btn-success">Add Event</button>
                </form>
            </div>
        </div>
    </div>
</div>

@include('bhw.partials.__footer')


