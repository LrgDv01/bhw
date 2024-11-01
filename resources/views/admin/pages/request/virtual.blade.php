
@include('admin.partials.__header')
@include('admin.partials.__nav')

<main id="main" class="main">

    <div class="pagetitle">
        <h1 id="param_visit_type">Virtual visit</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                <li class="breadcrumb-item active">Visitation Request</li>
                <li class="breadcrumb-item active">Virtual visit</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section user_management">
        <div class="card">
            <div class="card-body py-3 table-responsive">
                <table class="table" id="bookingTable">
                    <thead>
                        <tr>
                            <th>Transaction ID</th>
                            <th>PDL Name</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
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

<div
    class="modal fade"
    id="meeting_link_modal"
    tabindex="-1"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    
    role="dialog"
    aria-labelledby="meeting_Code_title"
    aria-hidden="true"
>
    <div
        class="modal-dialog modal-dialog-centered"
        role="document"
    >
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="meeting_Code_title">
                    Meeting Link/Code
                </h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
                <form id="add_meeting_link_form">
                    @csrf
                    <input type="hidden" name="bookID">
                    <div class="form-group mb-3">
                        <label for="link_type">Meeting Type</label>
                        <select name="link_type" id="link_type" class="form-control" required>
                            <option value="">--choose--</option>
                            <option value="google">Google Meeting</option>
                            <option value="code">Custom Code Meeting</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="meeting_link_input" id="meeting_link_label">Add meeting (Gmeet/Code)</label>
                        <input class="form-control" id="meeting_link_input" name="meeting_link" placeholder="" required>
                    </div>
                    <div class="redirectfield text-center mb-3 fw-bold" style="display: none">
                        <a href="{{ url('/videocall') }}" target="__blank"> Click to generate meeting</a>
                    </div>
                    <div class="text-end">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal"
                        >
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@include('admin.partials.__footer')
