@include('bhw.partials.__header')
@include('bhw.partials.__nav')

<main id="main" class="main">
    <div class="pagetitle text-center mb-5">
        <h1 class="fw-bold">Mother Census</h1>
        
        
    </div>
    <button onclick="window.location.href='{{ route('bhw.serv') }}'" >Back</button>
       
    <div class="container shadow p-5 rounded bg-light">
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="text-danger">{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <form action="{{ route('form.save') }}" method="POST" enctype="multipart/form-data">

            @csrf

            <div class="row g-3">
                <div class="col-md-6">
                    <label for="house_no" class="form-label fw-bold">No. of House</label>
                    <input type="number" class="form-control" id="house_no" name="house_no" required>
                </div>
                <div class="col-md-6">
                    
                    <label for="full_name" class="form-label fw-bold">Complete Name (FN, MN, LN)</label>
                    <table width="100%" >
                    <tbody>
                            <tr><td><input type="text" class="form-control" id="first_name" name="first_name" required></td>
                            <td><input type="text" class="form-control" id="middle_name" name="middle_name" required></td>
                            <td><input type="text" class="form-control" id="last_name" name="last_name" required></td></tr>
                    </tbody>
                    </table>
                </div>
                <div class="col-md-6">
                    <label for="role" class="form-label fw-bold">Role in the Family</label>
                    <input type="text" class="form-control" id="role_in_family" name="role_in_family" required>
                </div>
                <div class="col-md-6">
                    <label for="dob" class="form-label fw-bold">Date of Birth</label>
                    <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" required>
                </div>

                <div class="col-md-6">
                    <label for="age" class="form-label fw-bold">Age</label>
                    <input type="number" class="form-control" id="age" name="age" required>
                </div>
                <div class="col-md-6">
                    <label for="four_ps_member" class="form-label fw-bold">Are you 4P’s member?</label>
                    <select class="form-select" name="four_ps_member" id="four_ps_member" required>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="is_senior_citizen" class="form-label fw-bold">Are you a Senior Citizen?</label>
                    <select class="form-select" name="senior_citizen" id="senior_citizen" required>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="is_pregnant" class="form-label fw-bold">Are you pregnant?</label>
                    <select class="form-select" name="pregnant" id="pregnant" required>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
                <div class="col-md-6" id="pregnancy_months">
                    <label for="pregnancy_months" class="form-label fw-bold">Months pregnant</label>
                    <input type="number" class="form-control" name="months_pregnant" id="months_pregnant">
                </div>
                <div class="col-md-6">
                    <label for="birth_plan" class="form-label fw-bold">Do you have any birth plan?</label>
                    <select class="form-select" name="birth_plan" id="birth_plan" required>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="civil_status" class="form-label fw-bold">Civil Status</label>
                    <select class="form-select" name="civil_status" id="civil_status" required>
                        <option value="Single">Single</option>
                        <option value="Married">Married</option>
                        <option value="Widowed">Widowed</option>
                        <option value="Divorced">Divorced</option>
                        <option value="Separated">Separated</option>   
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="next_visit" class="form-label fw-bold">Date of Next Visit to Midwife</label>
                    <input type="date" class="form-control" name="next_midwife_visit" id="next_midwife_visit" required>
                </div>
                <div class="col-md-6">
                    <label for="family_planning_method" class="form-label fw-bold">Family Planning Method</label>
                    <select class="form-select" name="family_planning" id="family_planning" required>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="registered_voter" class="form-label fw-bold">Are you a registered voter?</label>
                    <select class="form-select" name="registered_voter" id="registered_voter" required>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
                <div class="col-md-6">
                        <label for="own_toilet" class="form-label fw-bold">Do you have your own toilet?</label>
                        <select class="form-select" name="own_toilet" id="own_toilet" required>
                            <option value="No">No</option>
                            <option value="Yes">Yes</option>
                            
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="clean_water" class="form-label fw-bold">Do you have a source of clean water?</label>
                        <select class="form-select" name="clean_water_source" id="clean_water_source" required>
                            <option value="No">No</option>
                            <option value="Yes">Yes</option>
                            
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="hypertension_experience" class="form-label fw-bold">Do you have experience hypertension?</label>
                        <select class="form-select" name="hypertension_experience" id="hypertension_experience" required>

                            <option value="No">No</option>
                            <option value="Yes">Yes</option>                         
                        </select>
                        <div class="col-md-6" id="next_visit_clinic_field" style="display: none;">
                            <label for="next_visit_clinic" class="form-label fw-bold">Next visit to the clinic:</label>
                            <input type="date" class="form-control" name="next_clinic_visit" id="next_clinic_visit">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="has_tb_symptoms" class="form-label fw-bold">Do you have any symptoms of TB?</label>
                        <select class="form-select" name="tb_symptoms" id="tb_symptoms" required onchange="toggleTBFields()">
                            <option value="No">No</option>
                            <option value="Yes">Yes</option>
                            
                        </select>
                        <div class="col-md-6" id="sputum_test_field" style="display: none;">
                            <label for="sputum_test" class="form-label fw-bold">Did you get a sputum test?</label>
                            <select class="form-select" name="sputum_test" id="sputum_test" required>
                                <option value="No">No</option>
                                <option value="Yes">Yes</option>
                            </select>
                        </div>
                        <div class="col-md-6" id="sputum_result_field" style="display: none;">
                            <label for="sputum_result" class="form-label fw-bold">Result of Sputum Test:</label>
                            <select type="text" class="form-control" name="sputum_result" id="sputum_result">
                                <option value="Negative">Negative</option>
                                <option value="Positive">Positive</option>  
                            </select>
                        </div>
                    </div>





                    <div class="col-md-6">
                        <label for="treatment_partner" class="form-label fw-bold">Do you have a treatment partner for TB?</label>
                        <select class="form-select" name="tb_treatment_partner" id="tb_treatment_partner" required onchange="toggleCheckupField()">
                            <option value="No">No</option>
                            <option value="Yes">Yes</option>
                            
                        </select>
                        <div class="col-md-6" id="next_checkup_field" style="display: none;">
                            <label for="next_checkup" class="form-label fw-bold">Next checkup:</label>
                            <input type="date" class="form-control" name="next_checkup" id="next_checkup">
                        </div>
                    </div>
                </div>

                <div class="mt-4 d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary px-4" onclick="window.history.back()">Back</button>
                    <button type="submit" class="btn btn-primary px-4">Submit</button>
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

