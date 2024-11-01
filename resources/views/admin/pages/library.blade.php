@include('admin.partials.__header')
@include('admin.partials.__nav')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Jail Library</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                <li class="breadcrumb-item active">Jail Library</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section library">
        <div class="">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link text-dark fw-bold active" id="pdl-tab" data-bs-toggle="tab" data-bs-target="#pdl"
                        type="button" role="tab" aria-controls="pdl" aria-selected="true">
                        PDL
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link text-dark fw-bold" id="facilities-tab" data-bs-toggle="tab" data-bs-target="#facilities"
                      type="button" role="tab" aria-controls="facilities" aria-selected="true">
                      Facilities
                  </button>
              </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane py-3 active" id="pdl" role="tabpanel" aria-labelledby="pdl-tab">
                    @include('admin.pages.library.pdl')
                </div>
                <div class="tab-pane py-3" id="facilities" role="tabpanel" aria-labelledby="facilities-tab">
                    @include('admin.pages.library.facilities')
                </div>
            </div>
        </div>
    </section>

</main>

@include('admin.partials.__footer')
