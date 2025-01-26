@include('admin.partials.__header')
@include('admin.partials.__nav')

   

<main id="main" class="main">
    <!-- Sidebar -->
   
    <!-- Main Content -->
    <div class="content">
        <div class="container-fluid">
            <h1 class="mb-4">Welcome, Super Admin!</h1>
            <p>This is your Announcement.</p>

            <!-- Announcement Form -->
            <form action="{{ route('admin.announcement.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" id="title" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea name="content" id="content" class="form-control" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Post Announcement</button>
            </form>


            <h2>Announcements</h2>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @foreach ($announcements as $announcement)
                <div class="card mb-3">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>{{ $announcement->title }}</h5>
                        
                        <!-- Delete Button -->
                        <form action="{{ route('admin.announcement.destroy', $announcement->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this announcement?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </div>
                    <div class="card-body">
                        <p>{{ $announcement->content }}</p>
                    </div>
                    <div class="card-footer text-muted">
                        Posted on {{ $announcement->created_at->format('F d, Y \a\t h:i A') }}
                    </div>
                </div>
            @endforeach

        </div>
    </div>

 
</main>

@include('admin.partials.__footer')