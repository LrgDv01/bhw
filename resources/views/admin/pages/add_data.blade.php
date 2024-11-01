@include('admin.partials.__header')
@include('admin.partials.__nav')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Add Data</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                <li class="breadcrumb-item active">Add Data</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section user_management">
        <div class="card">
            <div class="card-body py-3 table-responsive">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="identification-tab" data-bs-toggle="tab"
                            data-bs-target="#identification" type="button" role="tab"
                            aria-controls="identification" aria-selected="true">
                            A. IDENTIFICATION
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                            type="button" role="tab" aria-controls="profile" aria-selected="false">
                            B. INTERVIEW INFORMATION
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="messages-tab" data-bs-toggle="tab" data-bs-target="#messages"
                            type="button" role="tab" aria-controls="messages" aria-selected="false">
                            C. ENCODING INFORMATION
                        </button>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane p-3 active" id="identification" role="tabpanel"
                        aria-labelledby="identification-tab">
                        <div class="row justify-content-center align-items-center g-2">
                            <h4>Name: </h4>
                            <div class="col-lg-3 mb-2">
                                <label for="first_name">First Name</label>
                                <input type="text" class="form-control" name="first_name" placeholder="type here..."
                                    value="" required>
                            </div>
                            <div class="col-lg-3 mb-2">
                                <label for="middle_name">Middle Name</label>
                                <input type="text" class="form-control" name="middle_name" placeholder="type here..."
                                    value="" required>
                            </div>
                            <div class="col-lg-3 mb-2">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control" name="last_name" placeholder="type here..."
                                    value="" required>
                            </div>
                            <div class="col-lg-3 mb-2">
                                <label for="extension_name">Extension Name</label>
                                <input type="text" class="form-control" name="ex_name" placeholder="type here..."
                                    value="" required>
                            </div>
                            <div class="col-lg-3 mb-2">
                                <label for="gender">Gender</label>
                                <select name="gender" class="form-select" required>
                                    <option value="">--choose gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="col-lg-3 mb-2">
                                <label for="date_of_birth">Date of birth</label>
                                <input type="date" class="form-control" name="date_of_birth" value="" required>
                            </div>
                            <div class="col-lg-3 mb-2">
                                <label for="place_of_birth">Place of birth</label>
                                <input type="text" class="form-control" name="place_of_birth"
                                    placeholder="type here..." value="" required>
                            </div>
                            <div class="col-lg-3 mb-2">
                                <label for="household_head">Household Head</label>
                                <input type="text" class="form-control" name="household_head"
                                    placeholder="type here..." value="" required>
                            </div>
                            {{-- <div class="col-lg-3 mb-2">
                                <label for="total_household_member">Total No. of Household Members</label>
                                <input type="number" class="form-control" name="total_household_member"
                                    placeholder="0" value="" required>
                            </div> --}}
                            <h4>Location: </h4>
                            <div class="col-lg-3 mb-2">
                                <label for="house_no">Room/Floor/Unit No. and Building Name</label>
                                <input type="text" class="form-control" name="house_no"
                                    placeholder="type here..." value="">
                            </div>
                            <div class="col-lg-3 mb-2">
                                <label for="block_no">House/lot and Block No.</label>
                                <input type="text" class="form-control" name="block_no"
                                    placeholder="type here..." value="">
                            </div>
                            <div class="col-lg-3 mb-2">
                                <label for="street">Street Name</label>
                                <input type="text" class="form-control" name="street" placeholder="type here..."
                                    value="">
                            </div>
                            <div class="col-lg-3 mb-2">
                                <label for="barangay">Select Barangay in Famy, Laguna:</label>
                                <select id="barangay" class="form-select" name="barangay">
                                    <option value="">Select Barangay</option>
                                    <option value="Asana">Asana</option>
                                    <option value="Bacong-Sigsigan">Bacong-Sigsigan</option>
                                    <option value="Bagong Pag-asa">Bagong Pag-asa</option>
                                    <option value="Balitoc">Balitoc</option>
                                    <option value="Banaba">Banaba</option>
                                    <option value="Batuhan">Batuhan</option>
                                    <option value="Bulihan">Bulihan</option>
                                    <option value="Caballero">Caballero</option>
                                    <option value="Calumpang">Calumpang</option>
                                    <option value="Cuebang Bato">Cuebang Bato</option>
                                    <option value="Damayan">Damayan</option>
                                    <option value="Kapatalan">Kapatalan</option>
                                    <option value="Kataypuanan">Kataypuanan</option>
                                    <option value="Liyang">Liyang</option>
                                    <option value="Maate">Maate</option>
                                    <option value="Magdalo">Magdalo</option>
                                    <option value="Mayatba">Mayatba</option>
                                    <option value="Minayutan">Minayutan</option>
                                    <option value="Salangbato">Salangbato</option>
                                    <option value="Tunhac">Tunhac</option>
                                </select>
                            </div>

                            <div class="col-lg-3 mb-2">
                                <label for="province">City/Municipality</label>
                                <input type="text" class="form-control" name="city" placeholder="type here..."
                                    value="Famy">
                            </div>
                            <div class="col-lg-3 mb-2">
                                <label for="province">Province</label>
                                <input type="text" class="form-control" name="province"
                                    placeholder="type here..." value="Laguna">
                            </div>
                            <div class="col-lg-3 mb-2">
                                <label for="nationality">Nationality</label>
                                <select name="nationality" class="form-select" required>
                                    <option value="">Select Nationality</option>
                                    <option value="Filipino">Filipino</option>
                                    <option value="Non-Filipino">Non-Filipino</option>
                                </select>
                            </div>
                            <div class="col-lg-3 mb-2">
                                <label for="marital-status">Marital Status:</label>
                                <select id="marital-status" class="form-select" name="marital_status" required>
                                    <option value="">Select Marital Status</option>
                                    <option value="single">Single</option>
                                    <option value="married">Married</option>
                                    <option value="widowed">Widowed</option>
                                    <option value="divorced">Divorced</option>
                                    <option value="separated">Separated</option>
                                    <option value="annulled">Annulled</option>
                                </select>
                            </div>
                            <div class="col-lg-3 mb-2">
                                <label for="religion">Religion:</label>
                                <select id="religion" name="religion" class="form-select" required>
                                    <option value="">Select Religion</option>
                                    <option value="Roman Catholic">Roman Catholic</option>
                                    <option value="Islam">Islam</option>
                                    <option value="Iglesia ni Cristo">Iglesia ni Cristo</option>
                                    <option value="Evangelical">Evangelical</option>
                                    <option value="Buddhism">Buddhism</option>
                                    <option value="Judaism">Judaism</option>
                                    <option value="Hinduism">Hinduism</option>
                                    <option value="Protestant">Protestant</option>
                                    <option value="Orthodox Christian">Orthodox Christian</option>
                                    <option value="Other Christian Denominations">Other Christian Denominations
                                    </option>
                                    <option value="Other">Other</option>
                                    <option value="None">None</option>
                                </select>
                            </div>
                            <div class="col-lg-3 mb-2">
                                <label for="ethnicity">Ethnicity</label>
                                <input type="text" class="form-control" name="ethnicity"
                                    placeholder="type here..." value="">
                            </div>
                            <h4>Education: </h4>
                            <div class="col-lg-3 mb-2">
                                <label for="education-level">Highest Level of Education:</label>
                                <select id="education-level" class="form-select" name="education_level" required>
                                    <option value="">Select Education Level</option>
                                    <option value="No Formal Education">No Formal Education</option>
                                    <option value="Pre-school">Pre-school</option>
                                    <option value="Elementary Level">Elementary Level</option>
                                    <option value="Elementary Graduate">Elementary Graduate</option>
                                    <option value="High School Level">High School Level</option>
                                    <option value="High School Graduate">High School Graduate</option>
                                    <option value="Junior School Level">Junior School Level</option>
                                    <option value="Junior School Graduate">Junior School Graduate</option>
                                    <option value="Senior School Level">Senior School Level</option>
                                    <option value="Senior School Graduate">Senior School Graduate</option>
                                    <option value="Vocational/Tech">Vocational/Tech</option>
                                    <option value="College Level">College Level</option>
                                    <option value="College Graduate">College Graduate</option>
                                    <option value="Post Graduate">Post Graduate</option>
                                    <option value="Associate Degree">Associate Degree</option>
                                    <option value="Master's Degree">Master's Degree</option>
                                    <option value="Doctorate">Doctorate</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="col-lg-3 mb-2">
                                <label for="enrollment_status">Currently Enrolled</label>
                                <select name="enrollment_status" class="form-select">
                                    <option value="">Select Status</option>
                                    <option value="Public">Yes, Public</option>
                                    <option value="Private">Yes, Private</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                            <div class="col-lg-3 mb-2">
                                <label for="school_level">School Level</label>
                                <select name="school_level" class="form-select">
                                    <option value="">Select School Level</option>
                                    <option value="Pre-school">Pre-school</option>
                                    <option value="Elementary">Elementary</option>
                                    <option value="Junior High School">Junior High School</option>
                                    <option value="Senior High School">Senior High School</option>
                                    <option value="Vocational/University">Vocational/University</option>
                                </select>
                            </div>
                            <div class="col-lg-3 mb-2">
                                <label for="place_of_school">Place of School</label>
                                <input type="text" class="form-control" name="place_of_school"
                                    placeholder="type here..." value="">
                            </div>
                            <h4>Work: </h4>
                            <div class="col-lg-3 mb-2">
                                <label for="monthly_income">Monthly Income</label>
                                <input type="number" class="form-control" name="monthly_income"
                                    placeholder="type here..." value="">
                            </div>
                            <div class="col-lg-3 mb-2">
                                <label for="source_income">Source of Income</label>
                                <select name="source_income" class="form-select">
                                    <option value="">Select Source of Income</option>
                                    <option value="Employment">Employment</option>
                                    <option value="Business">Business</option>
                                    <option value="Remittance">Remittance</option>
                                    <option value="Investment">Investment</option>
                                    <option value="Others">Others</option>
                                </select>
                            </div>
                            <div class="col-lg-3 mb-2">
                                <label for="work_business_status">Status of Work/Business</label>
                                <select name="work_business_status" class="form-select">
                                    <option value="">Select Status of Work/Business</option>
                                    <option value="Permanent work">Permanent work</option>
                                    <option value="Casual work">Casual work</option>
                                    <option value="Contractual work">Contractual work</option>
                                    <option value="Individually owned business">Individually owned business</option>
                                    <option value="Shared/partnership Business">Shared/partnership business</option>
                                    <option value="Corporate business">Corporate business</option>
                                </select>
                            </div>
                            <div class="col-lg-3 mb-2">
                                <label for="place_of_work_business">Place of Work/Business</label>
                                <input type="number" class="form-control" name="place_of_work_business"
                                    placeholder="type here..." value="">
                            </div>
                        </div>
                        <div class="text-end mt-3">
                          <button class="btn btn-primary btn-lg px-4 fs-bold" 
                          data-bs-toggle="modal"
                          data-bs-target="#previewmodal">SAVE</button>
                        </div>
                    </div>
                    <div class="tab-pane p-3" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                    </div>
                    <div class="tab-pane p-3" id="messages" role="tabpanel" aria-labelledby="messages-tab">

                    </div>
                </div>

            </div>
        </div>
    </section>
</main>
<div
  class="modal fade"
  id="previewmodal"
  tabindex="-1"
  data-bs-backdrop="static"
  data-bs-keyboard="false"
  
  role="dialog"
  aria-labelledby="modalTitleId"
  aria-hidden="true"
>
  <div
    class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg"
    role="document"
  >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitleId">
          Review before saving
        </h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close"
        ></button>
      </div>
      <div class="modal-body">
        
        <div class="text-center">
          Display the data
        </div>
      
      </div>
      <div class="modal-footer">
        <button
          type="button"
          class="btn btn-dark"
          data-bs-dismiss="modal"
        >
          CANCEL
        </button>
        <button type="button" class="btn btn-primary">PROCEED</button>
      </div>
    </div>
  </div>
</div>
@include('admin.partials.__footer')
