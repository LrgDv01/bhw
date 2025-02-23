@include('bhw.partials.__header')
@include('admin.partials.__nav')

<style>
    .form-control {
        margin-bottom: 30px !important;
    }
</style>

<main id="main" class="main">
    <div class="pagetitle mb-5">
        <h1 class="fs-4"><strong>FAMILY PLANNING</strong></h1>
    </div>
    <section class="section family-planning">
            <h1 class="text-center fs-3"><strong>Details Form</strong></h1>
            <form action="{{ route('bhw.familyplanning.store') }}" method="POST">
                @csrf
                <div class="row p-3">
                    <div class="col-lg-6 mb-3 text-black">
                        <div class="col-lg-12 mb-1">
                            <div class="form-group mb-1 px-3">
                                <label class="form-label fw-bold" for="serial_no">Family Serial No.:</label>
                                <input type="text" name="serial_no" class="test w-full form-control border rounded-lg p-2 mb-3" id="serial_no"
                                    placeholder="Serial No" required autocomplete="serial_no">

                                <label class="form-label fw-bold" for="name">Name:</label>
                                <input type="text" name="name" class="w-full form-control border rounded-lg p-2 mb-3" id="name"
                                    placeholder="Enter name" required autocomplete="name">

                                <label class="form-label fw-bold" for="address">Complete Address:</label>
                                <input type="text" name="address" class="w-full form-control border rounded-lg p-2 mb-3" id="address"
                                    placeholder="Address" required autocomplete="address">

                                <div class="d-flex justify-content-between">   
                                    <div class="w-50 pe-3">
                                        <label class="form-label fw-bold" for="age_dob">Age/Date of Birth:</label>
                                        <input type="date" name="age_dob" class="form-control w-full border rounded-lg p-2 mb-3" id="age_dob" required autocomplete="age_dob">
                                    </div>
                                    <div class="w-50 pe-3">
                                        <label for="se_status" class="form-label fw-bold">SE Status:</label>
                                        <select name="se_status" class="form-select w-full border rounded-lg p-2 mb-3">
                                            <option value="" hidden>Select Status</option>
                                            <option value="1">NHTS</option>
                                            <option value="2">Non NHTS</option>
                                        </select>
                                    </div>
                                    <div class="w-50">
                                        <label for="source" class="form-label fw-bold">Source:</label>
                                        <select name="source" class="form-select w-full border rounded-lg p-2 mb-3">
                                            <option value="" hidden>Select Source</option>
                                            <option value="Public">Public</option>
                                            <option value="Private">Private</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">   
                                    <div class="w-50 pe-3">
                                        <label for="client_type" class="form-label fw-bold">Type of Client:</label>
                                        <select name="client_type" class="form-select w-full border rounded-lg p-2 mb-3">
                                            <option value="" hidden>Select Type</option>
                                            <option value="NA">New Acceptors</option>
                                            <option value="CU">Current Users</option>
                                            <option value="OA">Other Acceptors</option>
                                            <option value="CU-CM">Changing Methods</option>
                                            <option value="CU-CC">Changing Clinic</option>
                                            <option value="CU-RS">Restarter</option>
                                        </select>
                                    </div>
                                    <div class="w-50">
                                        <label for="previous_method" class="form-label fw-bold">Previous Method:</label>
                                        <select name="previous_method" class="form-select w-full border rounded-lg p-2 mb-3">
                                            <option value="" hidden>Select Method</option>
                                            <option value="NONE">None or New Acceptor</option>
                                            <option value="BTL">Bilateral Tubal Ligation</option>
                                            <option value="NSV">No-Scalpel Vasectomy</option>
                                            <option value="CON">Condom</option>
                                            <option value="Pills-POP">Progestin Only Pills</option>
                                            <option value="Pills-COC">Combined Oral Contraceptives</option>
                                            <option value="INJ">DMPA or CIC</option>
                                            <option value="IMP">Single rod sub-thermal Implant</option>
                                            <option value="IUD-I">IUD Interval</option>
                                            <option value="IUD-PP">IUD Postpartum</option>
                                            <option value="NFP-LAM">Lactational Amenorrhea Method</option>
                                            <option value="NFP-BBT">Basal Body Temperature</option>
                                            <option value="NFP-CMM">Cervical Mucus Method</option>
                                            <option value="NFP-STM">Symptothermal Method</option>
                                            <option value="NFP-SDM">Standard Days Method</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 text-black">
                        <div class="col-lg-12 mb-1">
                            <div class="form-group mb-1">
                                <label class="form-label fw-bold fs-5 my-3">Follow-Up Visits</label><br>
                                <div class="d-flex justify-content-between">   
                                    <div class="w-50 pe-3">
                                        <label for="month" class="form-label fw-bold">Month :</label>
                                        <select name="month" class="form-select w-full border rounded-lg p-2 mb-3">
                                            <option value="" hidden>Select Month</option>
                                            <option value="January">January</option>
                                            <option value="February">February</option>
                                            <option value="March">March</option>
                                            <option value="April">April</option>
                                            <option value="May">May</option>
                                            <option value="June">June</option>
                                            <option value="July">July</option>
                                            <option value="August">August</option>
                                            <option value="September">September</option>
                                            <option value="October">October</option>
                                            <option value="November">November</option>
                                            <option value="December">December</option>  
                                        </select>    
                                    </div>
                                    <div class="w-50 pe-3">
                                        <label for="schedule_date" class="form-label fw-bold">Schedule Date:</label>
                                        <input type="date" name="schedule_date" class="form-control w-full border rounded-lg p-2 mb-3" id="actual_date"
                                            placeholder="Enter schedule date" required autocomplete="schedule_date">
                                    </div>
                                    <div class="w-50 pe-3">
                                        <label for="actual_date" class="form-label fw-bold">Actual Date:</label>
                                        <input type="date" name="actual_date" class="form-control w-full border rounded-lg p-2 mb-3" id="actual_date"
                                            placeholder="Enter actual date" required autocomplete="actual_date">
                                    </div>
                                </div>
                    
                                <label class="form-label fw-bold" for="age_dob">Age/Date of Birth:</label>
                                <input type="date" name="age_dob" class="form-control w-full border rounded-lg p-2 mb-3" id="age_dob" required autocomplete="age_dob">
                              

                                <div class="d-flex justify-content-between">   
                                    <div class="w-50 pe-3"> 
                                        <label for="dropout_date" class="form-label fw-bold">Drop Out Date:</label>
                                        <input type="date" name="dropout_date" class="form-control w-full border rounded-lg p-2 mb-3" id="dropout_date" 
                                            required autocomplete="dropout_date">
                                    </div> 
                                    <div class="w-50 pe-3"> 
                                        <label for="dropout_reason" class="form-label fw-bold">Drop Out Reason:</label>
                                        <select name="dropout_reason" class="form-select w-full border rounded-lg p-2 mb-3">
                                            <option value="" hidden>Select Reason</option>
                                            <option value="A">Pregnant</option>
                                            <option value="B">Desire to become pregnant</option>
                                            <option value="C">Medical complications</option>
                                            <option value="D">Fear of side effects</option>
                                            <option value="E">Changed Clinic</option>
                                            <option value="F">Husband disapproves</option>
                                            <option value="G">Menopause</option>
                                            <option value="H">Lost or moved out of the area</option>
                                            <option value="I">Failed to get supply</option>
                                            <option value="J">Change Method</option>
                                            <option value="K">Underwent Hysterectomy</option>
                                            <option value="L">Underwent Bilateral Salpingo-oophorectomy</option>
                                            <option value="M">No FP Commodity</option>
                                            <option value="N">Unknown</option>
                                            <option value="O">Age out for BTL</option>
                                            <option value="Q">Mother has a menstruation or not amenorrheic within 6 months</option>
                                            <option value="R">No longer practicing fully/exclusively breastfeeding</option>
                                            <option value="S">Baby is more than six (6) months old</option>
                                        </select>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center d-flex justify-content-end">
                        {{--<a href="{{ route('bhw.services') }}" class="btn btn-outline-dark fw-bold">Back</a>--}}
                        <button type="submit" class="btn btn-success px-5 py-2 fw-bold rounded rounded-3">Submit</button>
                  
                    </div>
                </div>
            </form>
    </section>
</main>

   

