@include('admin.partials.__header')
@include('admin.partials.__nav')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Virtual Booking Calendar</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                <li class="breadcrumb-item active">Virtual Booking Calendar</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section user_management">
      <div class="card">
        <div class="card-body p-3">
          <div class="mb-3 d-flex">
            <i class="mx-2 bi bi-circle-fill" style="color: blue"></i> Approved
            <i class="mx-2 bi bi-circle-fill" style="color: yellow"></i> Pending
            <i class="mx-2 bi bi-circle-fill" style="color: red"></i> Rejected
          </div>
          <div id="virtualCalendar"></div>
        </div>
      </div>
  </section>
</main>
<div
  class="modal fade"
  id="bookdetailmodal"
  tabindex="-1"
  data-bs-backdrop="static"
  data-bs-keyboard="false"
  
  role="dialog"
  aria-labelledby="bookdetailtitle"
  aria-hidden="true"
>
  <div
    class="modal-dialog modal-dialog-scrollable modal-dialog-centered"
    role="document"
  >
  </div>
</div>

<div class="modal fade" id="declineBookingModal" tabindex="-1" aria-labelledby="declineBookingModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="declineBookingModalLabel">Decline Booking</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <form id="declineBookingForm">
                  @csrf
                  <input type="hidden" name="bookID">
                  <input type="hidden" name="transaction_number">
                  <div class="form-group mb-3">
                      <label for="reason">Reason for declining</label>
                      <textarea class="form-control" id="reason" name="reason" placeholder="Type your reason" rows="3" required></textarea>
                  </div>
                  <div class="text-end">
                      <button type="button" class="btn btn-dark btn-sm" data-dismiss="modal" aria-label="Close">Close</button>
                      <button type="submit" class="btn btn-danger btn-sm">Decline Booking</button>
                  </div>
              </form>
          </div>
      </div>
  </div>
</div>
@include('admin.partials.__footer')
