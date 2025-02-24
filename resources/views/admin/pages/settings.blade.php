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
    </div>

    <section class="section settings">
   
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            
            <li class="nav-item" role="presentation">
                <button class="nav-link text-dark fw-bold" id="contactus-tab" data-bs-toggle="tab" data-bs-target="#contactus"
                    type="button" role="tab" aria-controls="contactus" aria-selected="false">
                    Contact us
                </button>
            </li>
    
        </ul>

        <div class="tab-content">
            <div class="tab-pane py-3" id="contactus" role="tabpanel" aria-labelledby="contactus-tab">
                @include('admin.pages.settings.contactus')
            </div>
        </div>
    </section>

</main>

@include('admin.partials.__footer')
