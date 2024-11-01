@include('admin.partials.__header')
@include('admin.partials.__nav')
<style>

</style>
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Add announcement</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                <li class="breadcrumb-item active">Announcement</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section announcement">
        <form id="announcementform">
            <div class="form-group mb-3">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label for="image">Image <small>(optional)</small></label>
                <input type="file" name="image" id="image" class="form-control" accept="image/*">
            </div>
            <div class="form-group mb-3">
                <textarea name="content" id="announcement_input" class="summernote_input" cols="30" rows="10"></textarea>
                @csrf
            </div>
            <div class="text-end"><button type="submit" class="btn btn-success px-4">Save</button></div>
        </form>
    </section>

</main>

@include('admin.partials.__footer')
