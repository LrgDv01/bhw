@include('admin.partials.__header')
@include('admin.partials.__nav')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Settings</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                <li class="breadcrumb-item active">Settings</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section settings">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link text-dark fw-bold active" id="frontpage-tab" data-bs-toggle="tab" data-bs-target="#frontpage"
                    type="button" role="tab" aria-controls="frontpage" aria-selected="true">
                    Front Page
                </button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link text-dark fw-bold" id="mission-vision-tab" data-bs-toggle="tab" data-bs-target="#mission-vision"
                  type="button" role="tab" aria-controls="mission-vision" aria-selected="false">
                  Mission and Vission
              </button>
            </li>
            {{-- <li class="nav-item" role="presentation">
              <button class="nav-link text-dark fw-bold" id="guidelines-tab" data-bs-toggle="tab" data-bs-target="#guidelines"
                  type="button" role="tab" aria-controls="guidelines" aria-selected="false">
                  Guidelines to visit
              </button>
            </li> --}}
            <li class="nav-item" role="presentation">
                <button class="nav-link text-dark fw-bold" id="aboutus-tab" data-bs-toggle="tab" data-bs-target="#aboutus"
                    type="button" role="tab" aria-controls="aboutus" aria-selected="false">
                    About us
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link text-dark fw-bold" id="contactus-tab" data-bs-toggle="tab" data-bs-target="#contactus"
                    type="button" role="tab" aria-controls="contactus" aria-selected="false">
                    Contact us
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link text-dark fw-bold" id="terms_and_condition-tab" data-bs-toggle="tab"
                    data-bs-target="#terms_and_condition" type="button" role="tab"
                    aria-controls="terms_and_condition" aria-selected="false">
                    Terms and condition
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link text-dark fw-bold" id="changepassword-tab" data-bs-toggle="tab"
                    data-bs-target="#changepassword" type="button" role="tab"
                    aria-controls="changepassword" aria-selected="false">
                    Change Password
                </button>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane py-3 active" id="frontpage" role="tabpanel" aria-labelledby="frontpage-tab">
                @include('admin.pages.settings.frontpage')
            </div>
            <div class="tab-pane py-3" id="mission-vision" role="tabpanel" aria-labelledby="mission-vision-tab">
              @include('admin.pages.settings.mission-vision')
            </div>
            <div class="tab-pane py-3" id="guidelines" role="tabpanel" aria-labelledby="guidelines-tab">
              @include('admin.pages.settings.guidelines')
            </div>
            <div class="tab-pane py-3" id="aboutus" role="tabpanel" aria-labelledby="aboutus-tab">
                @include('admin.pages.settings.aboutus')
            </div>
            <div class="tab-pane py-3" id="contactus" role="tabpanel" aria-labelledby="contactus-tab">
                @include('admin.pages.settings.contactus')
            </div>
            <div class="tab-pane py-3" id="terms_and_condition" role="tabpanel" aria-labelledby="terms_and_condition-tab">
                @include('admin.pages.settings.terms-and-condition')
            </div>
            <div class="tab-pane py-3" id="changepassword" role="tabpanel" aria-labelledby="changepassword-tab">
                @include('admin.pages.settings.changepassword')
            </div>
        </div>
    </section>

</main>

@include('admin.partials.__footer')
