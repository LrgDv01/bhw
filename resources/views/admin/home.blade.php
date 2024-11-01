@include('admin.partials.__header')
@include('admin.partials.__nav')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Home</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Home</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="w-100">
        <img src="{!! isset($appInfo->banner) ? asset('storage/' . $appInfo->banner) : asset('img/banner.jpg') !!}" 
            style="object-fit: cover;object-position:center;height:80vh"
            class="img-fluid w-100" alt="">
    </div>

</main>

@include('admin.partials.__footer')
