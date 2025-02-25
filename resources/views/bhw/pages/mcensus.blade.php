@include('bhw.partials.__header')
@include('admin.partials.__nav')

<main id="main" class="main">
    <div class="pagetitle mb-5">
        <h1 class="fs-4"><strong>MATERNAL CARE</strong></h1>
    </div>
    <section class="section maternal-care">
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="text-danger">{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <form action="{{ route('form.save') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-5 mb-3 text-black"> 
                    <div class="col-lg-12 mb-1">
                        <div class="form-group mb-1 mx-3">
                            <label for="serial_no" class="form-label fw-bold">Family Serial No.:</label>
                            <input type="number" name="serial_no" class="test w-full form-control border rounded-lg p-2 mb-3" id="serial_no"
                                placeholder="Family Serial No." required autocomplete="serial_no">
                            <label for="full_name" class="form-label fw-bold">Name:</label>
                            <input type="text" name="full_name" class="test w-full form-control border rounded-lg p-2 mb-3" id="full_name"
                                placeholder="Name" required autocomplete="full_name">
                            <label for="address" class="form-label fw-bold">Address:</label>
                            <input type="text" name="address" class="test w-full form-control border rounded-lg p-2 mb-3" id="address"
                                placeholder="Address" required autocomplete="address">
                            <label for="se_status" class="form-label fw-bold">Social-Economic Status:</label>
                            <select name="se_status" class="form-select w-full border rounded-lg p-2 mb-3" required>
                                <option value="" hidden>Select Status</option>
                                <option value="NHTS">1-NHTS</option>
                                <option value="Non NHTS">2-Non NHTS</option>
                            </select>
                            <label for="age" class="form-label fw-bold">Age:</label>
                            <input type="number" name="address" class="test w-full form-control border rounded-lg p-2 mb-3" id="age"
                                placeholder="Age" required autocomplete="age">
                            <label for="lmp" class="form-label fw-bold">LMP:</label>
                            <input type="date" name="lmp" class="test w-full form-control border rounded-lg p-2 mb-3" id="lmp"
                                required autocomplete="lmp">
                            <label for="edc" class="form-label fw-bold">EDC:</label>
                            <input type="date" name="edc" class="test w-full form-control border rounded-lg p-2 mb-3" id="edc"
                                required autocomplete="edc">
                            <label class="form-label fw-bold"><u>DATES OF PRE-NATAL CHECK UPS</u></label>
                            <label for="first_tri" class="form-label fw-bold">1st Trimester:</label>
                            <input type="date" name="first_tri" class="test w-full form-control border rounded-lg p-2 mb-3" id="first_tri"
                                required autocomplete="first_tri">
                            <label for="second_tri" class="form-label fw-bold">2nd Trimester:</label>
                            <input type="date" name="second_tri" class="test w-full form-control border rounded-lg p-2 mb-3" id="second_tri"
                                required autocomplete="second_tri">
                            <label for="third_tri" class="form-label fw-bold">3rd Trimester:</label>
                            <input type="date" name="third_tri" class="test w-full form-control border rounded-lg p-2 mb-3" id="third_tri"
                                required autocomplete="third_tri">
                            <label class="form-label fw-bold"><u>IMMUNIZATION STATUS</u></label>
                            <label class="form-label fw-bold"><u>Date Tetanus diptheria (Td) or Tetanus Toxoid (TT) given</u></label>
                            <label for="td1" class="form-label fw-bold">Td1/TT1:</label>
                            <input type="date" name="td1" class="test w-full form-control border rounded-lg p-2 mb-3" id="td1"
                                required autocomplete="td1">
                            <label for="td2" class="form-label fw-bold">Td2/TT1:</label>
                            <input type="date" name="td2" class="test w-full form-control border rounded-lg p-2 mb-3" id="td2"
                                required autocomplete="td2">
                            <label for="td3" class="form-label fw-bold">Td3/TT1:</label>
                            <input type="date" name="td3" class="test w-full form-control border rounded-lg p-2 mb-3" id="td3"
                                required autocomplete="td3">
                            <label for="td4" class="form-label fw-bold">Td4/TT1:</label>
                            <input type="date" name="td4" class="test w-full form-control border rounded-lg p-2 mb-3" id="td4"
                                required autocomplete="td4">
                            <label for="td5" class="form-label fw-bold">Td5/TT1:</label>
                            <input type="date" name="td5" class="test w-full form-control border rounded-lg p-2 mb-3" id="td5"
                                required autocomplete="td5">
                            <label for="td5" class="form-label fw-bold">FIM Status: </label>
                        </div>
                    </div>
                </div>  
                <div class="col-lg-7 text-black">
                    <div class="col-lg-12 mb-1">
                        <div class="form-group mb-1">
                            <label class="form-label fw-bold"><u>MICRONUTRIENT SUPPLEMENTATION</u></label>
                            <label class="form-label fw-bold"><u>Iron sulfate with Folic Acid (Date and Number of Tablets Given)</u></label>
                            <div class="row">   
                                <div class="col-sm-8 pe-3">
                                    <label for="iron_visit1" class="form-label fw-bold">1st visit (1st tri):</label>
                                    <input type="date" name="iron_visit1" class="test w-full form-control border rounded-lg p-2 mb-3" id="iron_visit1"
                                        required autocomplete="iron_visit1">
                                </div>
                                <div class="col-sm-4 pe-3">
                                    <label for="iron_tablets_1" class="form-label fw-bold"># of Tablets Given:</label>
                                    <input type="number" name="iron_tablets_1" class="test w-full form-control border rounded-lg p-2 mb-3" id="iron_tablets_1"
                                        placeholder="Tablets Given" required autocomplete="iron_tablets_1">
                                </div>
                            </div>
                            <div class="row">   
                                <div class="col-sm-8 pe-3">
                                    <label for="iron_visit2" class="form-label fw-bold">2nd visit (2nd tri):</label>
                                    <input type="date" name="iron_visit2" class="test w-full form-control border rounded-lg p-2 mb-3" id="iron_visit2"
                                        required autocomplete="iron_visit2">
                                </div>
                                <div class="col-sm-4 pe-3">
                                    <label for="iron_tablets_2" class="form-label fw-bold"># of Tablets Given:</label>
                                    <input type="number" name="iron_tablets_2" class="test w-full form-control border rounded-lg p-2 mb-3" id="iron_tablets_2"
                                        placeholder="Tablets Given" required autocomplete="iron_tablets_2">
                                </div>
                            </div>
                            <div class="row">   
                                <div class="col-sm-8 pe-3">
                                        <label for="iron_visit3" class="form-label fw-bold">3rd visit (3rd tri):</label>
                                    <input type="date" name="iron_visit3" class="test w-full form-control border rounded-lg p-2 mb-3" id="iron_visit3"
                                        required autocomplete="iron_visit3">
                                </div>
                                <div class="col-sm-4 pe-3">
                                    <label for="iron_tablets_3" class="form-label fw-bold"># of Tablets Given:</label>
                                    <input type="number" name="iron_tablets_3" class="test w-full form-control border rounded-lg p-2 mb-3" id="iron_tablets_3"
                                        placeholder="Tablets Given" required autocomplete="iron_tablets_3">
                                </div>
                            </div>
                            <div class="row">   
                                <div class="col-sm-8 pe-3">
                                    <label for="iron_visit4" class="form-label fw-bold">4th visit (4th tri):</label>
                                    <input type="date" name="iron_visit4" class="test w-full form-control border rounded-lg p-2 mb-3" id="iron_visit4"
                                        required autocomplete="iron_visit4">
                                </div>
                                <div class="col-sm-4 pe-3">
                                    <label for="iron_tablets_4" class="form-label fw-bold"># of Tablets Given:</label>
                                    <input type="number" name="iron_tablets_4" class="test w-full form-control border rounded-lg p-2 mb-3" id="iron_tablets_4"
                                        placeholder="Tablets Given" required autocomplete="iron_tablets_4">
                                </div>
                            </div>
                            <label class="form-label fw-bold"><u>Calcium Carbonate (Date and Number of Tablets Given)</u></label>
                            <div class="row">   
                                <div class="col-sm-8 pe-3">
                                    <label for="cal_visit2" class="form-label fw-bold">2nd visit (2nd tri):</label>
                                    <input type="date" name="cal_visit2" class="test w-full form-control border rounded-lg p-2 mb-3" id="cal_visit2"
                                        required autocomplete="cal_visit2">
                                </div>
                                <div class="col-sm-4 pe-3">
                                    <label for="cal_tablets_2" class="form-label fw-bold"># of Tablets Given:</label>
                                    <input type="number" name="cal_tablets_2" class="test w-full form-control border rounded-lg p-2 mb-3" id="cal_tablets_2"
                                        placeholder="Tablets Given" required autocomplete="cal_tablets_2">
                                </div>
                            </div>
                            <div class="row">   
                                <div class="col-sm-8 pe-3">
                                    <label for="cal_visit3" class="form-label fw-bold">3rd visit (3rd tri):</label>
                                    <input type="date" name="cal_visit3" class="test w-full form-control border rounded-lg p-2 mb-3" id="cal_visit3"
                                        required autocomplete="cal_visit3">
                                </div>
                                <div class="col-sm-4 pe-3">
                                    <label for="cal_tablets_3" class="form-label fw-bold"># of Tablets Given:</label>
                                    <input type="number" name="cal_tablets_3" class="test w-full form-control border rounded-lg p-2 mb-3" id="cal_tablets_3"
                                        placeholder="Tablets Given" required autocomplete="cal_tablets_3">
                                </div>
                            </div>
                            <div class="row">   
                                <div class="col-sm-8 pe-3">
                                    <label for="cal_visit4" class="form-label fw-bold">4th visit (4th tri):</label>
                                    <input type="date" name="cal_visit4" class="test w-full form-control border rounded-lg p-2 mb-3" id="cal_visit4"
                                        required autocomplete="cal_visit4">
                                </div>
                                <div class="col-sm-4 pe-3">
                                    <label for="cal_tablets_4" class="form-label fw-bold"># of Tablets Given:</label>
                                    <input type="number" name="cal_tablets_4" class="test w-full form-control border rounded-lg p-2 mb-3" id="cal_tablets_4"
                                        placeholder="Tablets Given" required autocomplete="cal_tablets_4">
                                </div>
                            </div>
                            <label class="form-label fw-bold"><u>Iodine Capsules (Date 2 capsules given)</u></label>
                            <div class="row">   
                                <div class="col-sm-7 pe-3">
                                    <label for="iodine_visit1" class="form-label fw-bold">1st visit (1st tri):</label>
                                    <input type="date" name="iodine_visit1" class="test w-full form-control border rounded-lg p-2 mb-3" id="iodine_visit1"
                                        required autocomplete="iodine_visit1">
                                </div>
                            </div>
                            <div class="row mb-2">  
                                <div class="col-sm-8 pe-3">
                                    <label for="bmi" class="form-label fw-bold pt-2 "><u>NUTRITIONAL ASSESSMENT (WRITE THE BMI FOR 1ST TRI)  : </u></label>   
                                </div>
                                <div class="col-sm-4 pe-3">
                                    <select name="bmi" class="form-select w-full border rounded-lg p-2 mb-3" required>
                                        <option value="" hidden>Select BMI</option>
                                        <option value="Low: < 18.5">Low: < 18.5</option>
                                        <option value="Normal: 18.5 - 22.9">Normal: 18.5 - 22.9</option>
                                        <option value="High: > 23.0">High: > 23.0</option>
                                    </select>   
                                </div>
                            </div>
                            <div class="row">  
                                <div class="col-sm-8 pe-3">
                                    <label for="deworming_tablet" class="form-label fw-bold pt-2"><u>Deworming Tablet (Date Given) (2nd or #3rd Tri) : </u></label>
                                </div>
                                <div class="col-sm-4 pe-3">
                                    <input type="date" name="deworming_tablet" class="test w-full form-control border rounded-lg p-2 mb-3" id="deworming_tablet"
                                        required autocomplete="deworming_tablet">
                                </div>
                            </div>
                            <label for="bmi" class="form-label fw-bold pt-2 "><u>INFECTIOUS DISEASE SURVEILLANCE</u></label>   
                            <div class="row">   
                                <div class="col-sm-8 pe-3">
                                    <label for="syph" class="form-label fw-bold">Syphills Screening:</label>
                                    <input type="date" name="syph" class="test w-full form-control border rounded-lg p-2 mb-3" id="syph"
                                        required autocomplete="syph">
                                </div>
                                <div class="col-sm-4 pe-3">
                                    <label for="rpr_or_rdt" class="form-label fw-bold">(RpR or RDT Result):</label>
                                    <select name="rpr_or_rdt" class="form-select w-full border rounded-lg p-2 mb-3" required>
                                        <option value="" hidden>Negative / Positive</option>
                                        <option value="Negative">Negative</option>
                                        <option value="Positive">Positive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">   
                                <div class="col-sm-8 pe-3">
                                    <label for="hepa" class="form-label fw-bold">Hepatitis B Screening:</label>
                                    <input type="date" name="hepa" class="test w-full form-control border rounded-lg p-2 mb-3" id="hepa"
                                        required autocomplete="hepa">
                                </div>
                                <div class="col-sm-4 pe-3">
                                    <label for="hbsag" class="form-label fw-bold">(Result of HBsAg Test):</label>
                                    <select name="hbsag" class="form-select w-full border rounded-lg p-2 mb-3" required>
                                        <option value="" hidden>Negative / Positive</option>
                                        <option value="Negative">Negative</option>
                                        <option value="Positive">Positive</option>
                                    </select>
                                </div>
                            </div>
                            <label for="hiv" class="form-label fw-bold">HIV Screening Date Screened:</label>
                            <div class="col-sm-8 pe-3">
                                <input type="date" name="hiv" class="test w-full form-control border rounded-lg p-2 mb-3" id="hiv"
                                    required autocomplete="hiv">
                            </div>
                        </div>
                    </div>
                    <div class="text-center d-flex justify-content-end pt-5 mt-5 mx-5">
                        <button type="submit" class="btn btn-outline-success border-1 px-5 py-2 fw-bold rounded rounded-3">Submit</button>
                    </div>
                    <hr>
                </div>  
            </div>
        </form>
    </div>
</main>

@include('bhw.partials.__footer')
<script>
    document.addEventListener('DOMContentLoaded', function () {
    function toggleFields(selectId, targetId) {
        const selectElement = document.getElementById(selectId);
        const targetElement = document.getElementById(targetId);

        if (selectElement.value === 'Yes') {
            targetElement.style.display = 'block';
        } else {
            targetElement.style.display = 'none';
        }
    }

    document.getElementById('hypertension_experience').addEventListener('change', function () {
        toggleFields('hypertension_experience', 'next_visit_clinic_field');
    });

    document.getElementById('tb_symptoms').addEventListener('change', function () {
        toggleFields('tb_symptoms', 'sputum_test_field');
        toggleFields('tb_symptoms', 'sputum_result_field');
    });

    document.getElementById('tb_treatment_partner').addEventListener('change', function () {
        toggleFields('tb_treatment_partner', 'next_checkup_field');
    });

    // Run on page load to check initial visibility
    toggleFields('hypertension_experience', 'next_visit_clinic_field');
    toggleFields('tb_symptoms', 'sputum_test_field');
    toggleFields('tb_symptoms', 'sputum_result_field');
    toggleFields('tb_treatment_partner', 'next_checkup_field');
});

</script>

