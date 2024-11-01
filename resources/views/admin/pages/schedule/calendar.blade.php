@include('admin.partials.__header')
@include('admin.partials.__nav')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Calendar</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                <li class="breadcrumb-item active">Calendar</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section user_management">
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link text-dark fw-bold active" onclick="renderCalendar()" id="blocking-tab" data-bs-toggle="tab" data-bs-target="#blocking"
                type="button" role="tab" aria-controls="blocking" aria-selected="true">
                Date(s) Blocking
            </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link text-dark fw-bold" onclick="slotrenderCalendar()" id="slotCalendar-tab" data-bs-toggle="tab" data-bs-target="#slotCalendar"
              type="button" role="tab" aria-controls="slotCalendar" aria-selected="false">
              Date(s) Slot Setup
          </button>
        </li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane py-3 active" id="blocking" role="tabpanel" aria-labelledby="blocking-tab">
          @include('admin.pages.schedule.blocking')
        </div>
        <div class="tab-pane py-3" id="slotCalendar" role="tabpanel" aria-labelledby="slotCalendar-tab">
          @include('admin.pages.schedule.slot')
        </div>
      </div>
        
    </section>
</main>

@include('admin.partials.__footer')
