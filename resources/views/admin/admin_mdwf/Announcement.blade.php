@include('admin.partials.__header')
@include('admin.partials.__nav')

<main id="main" class="main">
    <div class="pagetitle text-center mb-5">
        <h1 class="fw-bold">All Announcements</h1>
    </div>

    <div class="container shadow p-5 rounded bg-light">
        @if ($announcements->isEmpty())
            <div class="alert alert-warning">
                No announcements available.
            </div>
        @else
            <div class="list-group">
                @foreach($announcements as $announcement)
                    <div class="list-group-item list-group-item-action">
                        <h5>{{ $announcement->title }}</h5>
                        <p>{{ $announcement->content }}</p>
                        <p><small><strong>Posted on:</strong> {{ $announcement->created_at->format('F j, Y') }}</small></p>
                    </div>
                @endforeach
            </div>
        @endif
        <a href="{{ route('bhw.pages.list') }}" class="btn btn-secondary">Back</a>
    </div>
</main>

@include('bhw.partials.__footer')
