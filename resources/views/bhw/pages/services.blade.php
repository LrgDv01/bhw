@include('bhw.partials.__header')
@include('bhw.partials.__nav')

<main id="main" class="main">
    <div class="pagetitle text-center mb-5">
        <h1 class="fw-bold">Mother Census</h1>
        
        
    </div>
    <div class="pagetitle text-center mb-3">
                <a href="{{ route('bhw.child') }}" class="btn btn-outline-primary">Go to Child Census →</a>

    </div>
    <div class="container shadow p-5 rounded bg-light">
        <form action="{{ route('form.save') }}" method="POST">
            @csrf

            <div class="row g-3">
                <div class="col-md-6">
                    <label for="house_no" class="form-label fw-bold">No. of House</label>
                    <input type="text" class="form-control" id="house_no" name="house_no" required>
                </div>
                <div class="col-md-6">
                    <label for="full_name" class="form-label fw-bold">Complete Name (FN, MN, LN)</label>
                    <input type="text" class="form-control" id="full_name" name="full_name" required>
                </div>
                <div class="col-md-6">
                    <label for="role" class="form-label fw-bold">Role in the Family</label>
                    <input type="text" class="form-control" id="role" name="role" required>
                </div>
                <div class="col-md-6">
                    <label for="dob" class="form-label fw-bold">Date of Birth</label>
                    <input type="date" class="form-control" id="dob" name="dob" required>
                </div>

                <div class="col-md-6">
                    <label for="age" class="form-label fw-bold">Age</label>
                    <input type="text" class="form-control" id="age" name="age" required>
                </div>
                <div class="col-md-6">
                    <label for="is_4ps" class="form-label fw-bold">Are you 4P’s member?</label>
                    <select class="form-select" name="is_4ps" id="is_4ps" required>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="is_senior_citizen" class="form-label fw-bold">Are you a Senior Citizen?</label>
                    <select class="form-select" name="is_senior_citizen" id="is_senior_citizen" required>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="is_pregnant" class="form-label fw-bold">Are you pregnant?</label>
                    <select class="form-select" name="is_pregnant" id="is_pregnant" required>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
                <div class="col-md-6" id="pregnancy_months">
                    <label for="pregnancy_months" class="form-label fw-bold">Months pregnant</label>
                    <input type="number" class="form-control" name="pregnancy_months" id="pregnancy_months">
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
                    <input type="text" class="form-control" name="civil_status" id="civil_status" required>
                </div>
                <div class="col-md-6">
                    <label for="next_visit" class="form-label fw-bold">Date of Next Visit to Midwife</label>
                    <input type="date" class="form-control" name="next_visit" id="next_visit" required>
                </div>
                <div class="col-md-6">
                    <label for="family_planning_method" class="form-label fw-bold">Family Planning Method</label>
                    <input type="text" class="form-control" name="family_planning_method" id="family_planning_method" required>
                </div>
                <div class="col-md-6">
                    <label for="is_registered_voter" class="form-label fw-bold">Are you a registered voter?</label>
                    <select class="form-select" name="is_registered_voter" id="is_registered_voter" required>
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
                        <select class="form-select" name="clean_water" id="clean_water" required>
                            <option value="No">No</option>
                            <option value="Yes">Yes</option>
                            
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="hypertension" class="form-label fw-bold">Do you have experience hypertension?</label>
                        <select class="form-select" name="hypertension" id="hypertension" required onchange="toggleNextVisit()">
                            <option value="No">No</option>
                            <option value="Yes">Yes</option>
                            
                        </select>
                        <div class="col-md-6" id="next_visit_clinic_field" style="display: none;">
                            <label for="next_visit_clinic" class="form-label fw-bold">Next visit to the clinic:</label>
                            <input type="date" class="form-control" name="next_visit_clinic" id="next_visit_clinic">
                        </div>
                    </div>



                    <div class="col-md-6">
                        <label for="has_tb_symptoms" class="form-label fw-bold">Do you have any symptoms of TB?</label>
                        <select class="form-select" name="has_tb_symptoms" id="has_tb_symptoms" required onchange="toggleTBFields()">
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
                            <input type="text" class="form-control" name="sputum_result" id="sputum_result">
                        </div>
                    </div>





                    <div class="col-md-6">
                        <label for="treatment_partner" class="form-label fw-bold">Do you have a treatment partner for TB?</label>
                        <select class="form-select" name="treatment_partner" id="treatment_partner" required onchange="toggleCheckupField()">
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
    function toggleFields(selectId, targetId) {
        const selectValue = document.getElementById(selectId).value;
        const targetElement = document.getElementById(targetId);
        
        if (selectValue === 'Yes') {
            targetElement.style.display = 'block';
            targetElement.style.transition = 'opacity 0.3s ease-in-out';
            targetElement.style.opacity = '1';
        } else {
            targetElement.style.opacity = '0';
            setTimeout(() => targetElement.style.display = 'none', 300);
        }
    }

    document.getElementById('hypertension').addEventListener('change', () => 
        toggleFields('hypertension', 'next_visit_clinic_field'));

    document.getElementById('has_tb_symptoms').addEventListener('change', () => {
        toggleFields('has_tb_symptoms', 'sputum_test_field');
        toggleFields('has_tb_symptoms', 'sputum_result_field');
    });

    document.getElementById('treatment_partner').addEventListener('change', () => 
        toggleFields('treatment_partner', 'next_checkup_field'));
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('motherCensusForm');
        const nextButton = document.getElementById('nextButton');
        
        // Function to check if all required fields are filled
        function checkFormCompletion() {
            const requiredFields = form.querySelectorAll('[required]');
            let allFilled = true;
            
            requiredFields.forEach(field => {
                if (!field.value) {
                    allFilled = false;
                }
            });

            // Enable or disable the "Next" button based on whether all fields are filled
            nextButton.disabled = !allFilled;
        }

        // Event listener to check the form status whenever a field value changes
        form.addEventListener('input', checkFormCompletion);

        // Initial check when the page loads
        checkFormCompletion();
    });
</script>
