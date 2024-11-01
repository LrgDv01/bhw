@include('admin.partials.__header')
@include('admin.partials.__nav')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>PDL Information</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                <li class="breadcrumb-item active">PDL Information</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section pdl_profile">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link text-dark fw-bold active" id="profile-tab" data-bs-toggle="tab"
                    data-bs-target="#profile" type="button" role="tab" aria-controls="profile"
                    aria-selected="true">
                    Profile
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link text-dark fw-bold" id="visitor-tab" data-bs-toggle="tab"
                    data-bs-target="#visitor" type="button" role="tab" aria-controls="visitor"
                    aria-selected="true">
                    Visitor
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link text-dark fw-bold" id="visitation-tab" data-bs-toggle="tab"
                    data-bs-target="#visitation" type="button" role="tab" aria-controls="visitation"
                    aria-selected="true">
                    Visitation
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link text-dark fw-bold" id="custom-booking-tab" data-bs-toggle="tab"
                    data-bs-target="#custom-booking" type="button" role="tab" aria-controls="custom-booking"
                    aria-selected="true">
                    Custom Booking
                </button>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane py-3 active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="card">
                    <div class="card-body p-3">
                        <form id="update_pdl_form" method="POST" class="was-validated">
                            <input type="hidden" value="{{ $pdl_data->id }}" id="data_id" name="data_id">
                            <div class="row">
                                <div class="col-lg-3 mb-3">
                                    <div>
                                        <a href="{{ isset($pdl_data->profile_img) ? asset('storage/' . $pdl_data->profile_img) : asset('img/no-image-icon-4.png') }}"
                                            data-lightbox="PDL Profile" data-title="PDL Profile" class="bg-white mb-3">
                                            <img src="{{ isset($pdl_data->profile_img) ? asset('storage/' . $pdl_data->profile_img) : asset('img/no-image-icon-4.png') }}"
                                                class="img-fluid w-100" id="preview_profile_img"
                                                style="object-fit: cover; onject-possition:center;height:350px"
                                                alt="banner">
                                        </a>
                                        <label for="" class="form-label">PDL img (jpeg, jpg, png) format</label>
                                        <input type="file" name="pdl_img" id="pdl_img" accept="image/*"
                                            class="form-control rounded rounded-0" />
                                    </div>
                                </div>
                                <div class="col-lg-9">
                                    <div class="row p-0 m-0">
                                        <div class="col-lg-6 mb-3">
                                            <div class="mb-3">
                                                <label for="" class="form-label">PDL ID</label>
                                                <input type="text" name="pdl_id" id="pdl_id"
                                                    class="form-control rounded rounded-0" placeholder="type here..."
                                                    value="{{ $pdl_data->pdl_id }}" required />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <div class="mb-3">
                                                <label for="" class="form-label">Name</label>
                                                <input type="text" name="name" id="name"
                                                    class="form-control rounded rounded-0" placeholder="type here..."
                                                    value="{{ $pdl_data->name }}" required />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <div class="mb-3">
                                                <label for="" class="form-label">Gender</label>
                                                <select class="form-select" name="gender" id="gender" required>
                                                    <option value="">Select one</option>
                                                    <option value="Male"
                                                        {{ $pdl_data->gender == 'Male' ? 'selected' : '' }}>Male
                                                    </option>
                                                    <option value="Female"
                                                        {{ $pdl_data->gender == 'Female' ? 'selected' : '' }}>Female
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <div class="mb-3">
                                                <label for="" class="form-label">Birth day</label>
                                                <input type="date" name="birthday" id="birthday"
                                                    class="form-control rounded rounded-0" placeholder="type here..."
                                                    value="{{ $pdl_data->birthday }}" required />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <div class="form-group">
                                                <label for="crimeCategory">Select Crime Category</label>
                                                <select class="form-control" name="crimeCategory" id="crimeCategory" required>
                                                    <option value="">-- Select Crime Category --</option>
                                                    <option value="theft" {{ $pdl_data->crimeCategory == 'theft' ? 'selected' : '' }}>Theft</option>
                                                    <option value="robbery" {{ $pdl_data->crimeCategory == 'robbery' ? 'selected' : '' }}>Robbery</option>
                                                    <option value="assault" {{ $pdl_data->crimeCategory == 'assault' ? 'selected' : '' }}>Assault</option>
                                                    <option value="murder" {{ $pdl_data->crimeCategory == 'murder' ? 'selected' : '' }}>Murder</option>
                                                    <option value="cybercrime" {{ $pdl_data->crimeCategory == 'cybercrime' ? 'selected' : '' }}>Cybercrime</option>
                                                    <option value="drug-related" {{ $pdl_data->crimeCategory == 'drug-related' ? 'selected' : '' }}>Drug-Related</option>
                                                    <option value="homicide" {{ $pdl_data->crimeCategory == 'homicide' ? 'selected' : '' }}>Homicide</option>
                                                    <option value="kidnapping" {{ $pdl_data->crimeCategory == 'kidnapping' ? 'selected' : '' }}>Kidnapping</option>
                                                    <option value="rape" {{ $pdl_data->crimeCategory == 'rape' ? 'selected' : '' }}>Rape</option>
                                                    <option value="fraud" {{ $pdl_data->crimeCategory == 'fraud' ? 'selected' : '' }}>Fraud</option>
                                                    <option value="domestic-violence" {{ $pdl_data->crimeCategory == 'domestic-violence' ? 'selected' : '' }}>Domestic Violence</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <div class="form-group">
                                                <label for="crimeCategory">Specify Case</label>
                                                <input type="text" value="{{ $pdl_data->specify_case }}" class="form-control" name="specify_case" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @csrf
                        </form>
                    </div>
                    <div class="card-footer border-0">
                        <div class="text-end">
                            <a href="{{ url('/admin/library') }}" class="btn btn-dark rounded rounded-0">Back</a>
                            <button type="submit" form="update_pdl_form"
                                class="btn btn-primary rounded rounded-0">Save
                                Changes</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane py-3" id="visitor" role="tabpanel" aria-labelledby="visitor-tab">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="text-end">
                            <a href="{{ url('admin/add_visitor/' . $pdl_data->id) }}" class="btn btn-primary btn-sm"
                                data-bs-toggle="tooltip" title="Add visitor">
                                <i class="bi bi-plus"></i> Add
                            </a>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#tagAccountForm"
                                class="btn btn-success btn-sm tagAccountbtn" data-bs-toggle="tooltip"
                                title="Tag existing account">
                                <i class="bi bi-tag"></i> Tag
                            </a>
                        </div>
                        <table id="visitorTable" class="table w-100">
                            <thead>
                                <tr>
                                    <td>Name</td>
                                    <td>Gender</td>
                                    <td>Contact</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane py-3" id="visitation" role="tabpanel" aria-labelledby="visitation-tab">
                <div class="card">
                    <div class="card-body p-3">
                        <table id="visitationTable" class="table w-100">
                            <thead>
                                <tr>
                                    <td># Transaction</td>
                                    <td>Type</td>
                                    <td>Date</td>
                                    <td>Time</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane py-3" id="custom-booking" role="tabpanel" aria-labelledby="custom-booking-tab">  
              <div class="card">
                <div class="card-header text-white" style="background-color:#2D8BBA">
                  Add Custom Booking
                </div>
                <div class="card-body p-3">
                  <form id="custom_booking_form">
                    <input type="hidden" value="{{ $pdl_data->id }}" name="pdl_id">
                    @csrf
                    <div class="row">
                      <div class="col-lg-3">
                        <div class="mb-3">
                          <label for="" class="form-label">Visitor</label>
                          <select name="visitorID" id="visitor_custom_book_select" class="form-select">
                            <option value="">--choose--</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="mb-3">
                          <label for="" class="form-label">Date</label>
                          <input type="date" name="book_date" class="form-control">
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="mb-3">
                          <label for="" class="form-label">Remark</label>
                          <input type="text" name="remark" class="form-control" placeholder="type anything">
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="mb-3">
                          <label for="" class="form-label">Book type</label>
                          <select name="book_type" class="form-select">
                            <option value="">--choose--</option>
                            <option value="Physical">Onsite</option>
                            <option value="Virtual">Virtual</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-lg-12 text-end">
                        <div class="mb-3">
                          <button class="btn btn-primary px-5">Save</button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <div class="card">
                  <div class="card-body p-3">
                      <table id="custom-bookingTable" class="table w-100">
                          <thead>
                              <tr>
                                  <td># Transaction</td>
                                  <td>Type</td>
                                  <td>Date</td>
                              </tr>
                          </thead>
                          <tbody></tbody>
                      </table>
                  </div>
              </div>
          </div>
        </div>
    </section>

</main>
<form class="modal fade" id="tagAccountForm" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
    role="dialog" aria-labelledby="tagAccountTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="tagAccountTitle">
                    Tag visitor
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <select name="select_user" class="form-select" id="select_user" required>
                </select>
                <input type="hidden" name="pdlID" value="{{ $pdl_data->id }}">
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-sm btn-secondary px-3" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="submit" class="btn btn-sm btn-primary px-3">Save</button>
            </div>
        </div>
    </div>
</form>
<div class="modal fade" id="bookdetailmodal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
    role="dialog" aria-labelledby="bookdetailtitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
    </div>
</div>
@include('admin.partials.__footer')
