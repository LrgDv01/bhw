@include('bhw.partials.__header')
@include('admin.partials.__nav')


<style>
    .remove-family-member {
        margin-top: 10px;
    }

    /* Transition styles for adding and removing forms */
    .family-member-form {
        opacity: 1;
        transform: translateY(0);
        transition: opacity 1s ease, transform 1s ease;
    }

    .family-member-form.new {
        opacity: 0;
        transform: translateY(-20px); /* Start slightly above for adding */
    }

    .family-member-form.removing {
        opacity: 0;
        transform: translateY(-100px); /* Slide up and fade out for removing */
    }   

    .form-number {
        margin-bottom: 10px;
    }
</style>

<main id="main" class="main">
    <div class="pagetitle mb-3">
        <h1 class="fs-4"><strong>CENSUS</strong></h1>
    </div>
    <section class="section family-planning">
            <h1 class="text-center fs-3"><strong>Household Profile</strong></h1>
            <form action="{{ route('bhw.census-store') }}" method="POST">
                @csrf
                <div class="row p-3">
                    <div class="col-lg-12 mb-1">
                        <div class="form-group mb-1 mx-3">
                            <div class="d-flex justify-content-between">   
                                <div class="w-25 pe-3">
                                    <label class="form-label fw-bold" for="house_no">No. of House :</label>
                                    <input type="text" name="house_no" class="test w-full form-control border rounded-lg p-2 mb-3" id="house_no"
                                        placeholder="House number" required autocomplete="house_no">
                                </div>
                                <div class="w-75 pe-5">
                                    <label class="form-label fw-bold" for="head_of_fam">Head of Family:</label>
                                    <input type="text" name="head_of_fam" class="w-full form-control border rounded-lg p-2 mb-3" id="head_of_fam"
                                        placeholder="Head of Family" required autocomplete="head_of_fam">
                                </div>
                                <div class="w-50 pe-3">
                                    <label for="toilet_facility" class="form-label fw-bold">Have Toilet Facility:</label>
                                    <select name="toilet_facility" class="form-select w-full border rounded-lg p-2 mb-3"  required>
                                        <option value="" hidden>Yes or No</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>    
                                </div>
                                <div class="w-50 pe-3">
                                    <label for="water_source" class="form-label fw-bold">Have Water Source:</label>
                                    <select name="water_source" class="form-select w-full border rounded-lg p-2 mb-3" required>
                                        <option value="" hidden>Yes or No</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center d-flex justify-content-end">
                        {{--<a href="{{ route('bhw.services') }}" class="btn btn-outline-dark fw-bold">Back</a>--}}
                        <button type="submit" class="btn btn-outline-success border-1 px-5 py-2 fw-bold rounded rounded-3">Submit</button>
                    </div>
                </div>
                <div class="row">
                    <div class="d-flex flex-row justify-content-center my-3">
                        <label class="form-label fw-bold fs-5 mx-3" for="family_members"><strong><u>FAMILY MEMBERS</u></strong></label>
                        <button type="button" class="btn btn-outline-primary border-1 fw-bold rounded rounded-3 ms-3" id="add-family-member">+ Add</button>
                    </div>
                    <div id="family-members-container">
                        <div class="family-member-form row" data-index="0">
                            <div class="col-12 text-start">
                                <button type="button" class="btn btn-outline-danger border-1 remove-family-member d-none"><i class="bi bi-x-lg"></i> Remove</button>
                                <h5 class="form-number text-center fw-bold d-none">Member 1</h5>
                            </div>
                            <div class="col-lg-6 mb-3 text-black mt-4"> 
                                <div class="col-lg-12 mb-1">
                                    <div class="form-group mb-1 px-3">
                                        <label class="form-label fw-bold" for="full_name_0">Complete Name:</label>
                                        <input type="text" name="family_members[0][full_name]" class="w-full form-control border rounded-lg p-2 mb-3" id="full_name_0"
                                            placeholder="Complete Name" required autocomplete="full_name">

                                        <label class="form-label fw-bold" for="relation_to_hfam_0">Relationship to the Head of the Family:</label>
                                        <input type="text" name="family_members[0][relation_to_hfam]" class="w-full form-control border rounded-lg p-2 mb-3" id="relation_to_hfam_0"
                                            placeholder="Relationship to the Head of the Family" required autocomplete="relation_to_hfam">

                                        <div class="d-flex justify-content-between">   
                                            <div class="w-75 pe-3">
                                                <label for="birthday_0" class="form-label fw-bold">Birthday:</label>
                                                <input type="date" name="family_members[0][birthday]" class="form-control w-full border rounded-lg p-2 mb-3" id="birthday_0"
                                                    placeholder="Birthday" required autocomplete="birthday">
                                            </div>
                                            <div class="w-50 pe-3">
                                                <label class="form-label fw-bold" for="age_0">Age:</label>
                                                <input type="number" name="family_members[0][age]" class="form-control w-full border rounded-lg p-2 mb-3" id="age_0"
                                                    placeholder="Age" required autocomplete="age" readonly>
                                            </div>
                                            <div class="w-75 pe-3">
                                                <label for="civil_status_0" class="form-label fw-bold">Civil Status:</label>
                                                <select name="family_members[0][civil_status]" class="form-select w-full border rounded-lg p-2 mb-3" required>
                                                    <option value="" hidden>Select Status</option>
                                                    <option value="Single">Single</option>
                                                    <option value="Married">Married</option>
                                                    <option value="Widowed">Widowed</option>
                                                    <option value="Divorced">Divorced</option>
                                                    <option value="Annulled">Annulled</option>
                                                </select>
                                            </div>
                                            <div class="w-50">
                                                <label for="sex_0" class="form-label fw-bold">Sex:</label>
                                                <select name="family_members[0][sex]" class="form-select w-full border rounded-lg p-2 mb-3" required>
                                                    <option value="" hidden>Select Sex</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between">   
                                            <div class="w-75 pe-3">
                                                <label for="edu_attainment_0" class="form-label fw-bold">Educational Attainment:</label>
                                                <select name="family_members[0][edu_attainment]" class="form-select w-full border rounded-lg p-2 mb-3" required>
                                                    <option value="" hidden>Select Educational Attainment</option>
                                                    <option value="College Graduate">College Graduate</option>
                                                    <option value="College Undergraduate">College Undergraduate</option>
                                                    <option value="High School Graduate">High School Graduate</option>
                                                    <option value="High School Undergraduate">High School Undergraduate</option>
                                                    <option value="Grade School">Grade School</option>
                                                    <option value="Elementary">Elementary</option>
                                                </select>
                                            </div>
                                            <div class="w-50">
                                                <label class="form-label fw-bold" for="religion_0">Religion:</label>
                                                <input type="text" name="family_members[0][religion]" class="w-full form-control border rounded-lg p-2 mb-3" id="religion_0"
                                                    placeholder="Religion" required autocomplete="religion">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            <div class="col-lg-6 text-black mt-4">
                                <div class="col-lg-12 mb-1">
                                    <div class="form-group mb-1">
                                        <label class="form-label fw-bold" for="fam_planning_0">Family Planning:</label>
                                        <input type="text" name="family_members[0][fam_planning]" class="w-full form-control border rounded-lg p-2 mb-3" id="fam_planning_0"
                                            placeholder="Family Planning" required autocomplete="fam_planning"> 
                                        <div class="d-flex justify-content-between">
                                            <div class="w-50 me-3">
                                                <label class="form-label fw-bold" for="phihealth_no_0">Philhealth No:</label>
                                                <input type="text" name="family_members[0][phihealth_no]" class="w-full form-control border rounded-lg p-2 mb-3" id="phihealth_no_0"
                                                    placeholder="Philhealth Number" required autocomplete="phihealth_no"> 
                                            </div>
                                            <div class="w-50 me-3">
                                                <label for="membership_type_0" class="form-label fw-bold">Members Type:</label>
                                                <select name="family_members[0][membership_type]" class="form-select w-full border rounded-lg p-2 mb-3" required>
                                                    <option value="" hidden>Select Type</option>
                                                    <option value="Dependent">Dependent</option>
                                                    <option value="Independent">Independent</option>
                                                </select>    
                                            </div>
                                            <div class="w-50">
                                                <label for="voters_0" class="form-label fw-bold">Voters:</label>
                                                <select name="family_members[0][voters]" class="form-select w-full border rounded-lg p-2 mb-3" required>
                                                    <option value="" hidden>Yes or No</option>
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                </select>    
                                            </div>
                                        </div>
                                        <label class="form-label fw-bold" for="medical_history_0">Medical History:</label>
                                        <input type="text" name="family_members[0][medical_history]" class="w-full form-control border rounded-lg p-2 mb-3" id="medical_history_0"
                                            placeholder="Medical History" required autocomplete="medical_history"> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</main> 
@include('bhw.partials.__footer')

<script>
    let memberCount = 1;
    function calculateAge(birthday) {
        const birthDate = new Date(birthday);
        const today = new Date();
        let age = today.getFullYear() - birthDate.getFullYear();
        const monthDiff = today.getMonth() - birthDate.getMonth();
        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }
        return age >= 0 ? age : 0;
    }
    function updateFormVisibility() {
        const forms = document.querySelectorAll('.family-member-form');
        const totalForms = forms.length;
        const showExtras = totalForms > 1;
        forms.forEach((form, index) => {
            const number = form.querySelector('.form-number');
            const removeBtn = form.querySelector('.remove-family-member');
            // const addSeparation = form.querySelector('.add-separation');
            number.textContent = `Member ${totalForms - index}`;
            number.classList.toggle('d-none', !showExtras);
            removeBtn.classList.toggle('d-none', !showExtras);
            // addSeparation.classList.toggle('d-none', !showExtras);

        });
    }
    function reindexForms() {
        const forms = document.querySelectorAll('.family-member-form');
        forms.forEach((form, index) => {
            form.setAttribute('data-index', index);
            const inputs = form.querySelectorAll('input, select');
            inputs.forEach(input => {
                const baseName = input.name.match(/family_members\[\d+\]\[(\w+)\]/)[1];
                input.name = `family_members[${index}][${baseName}]`;
                input.id = `${baseName}_${index}`;
                if (input.type === 'date' && input.name.includes('[birthday]')) {
                    input.removeEventListener('change', updateAge);
                    input.addEventListener('change', updateAge);
                }
            });
            const labels = form.querySelectorAll('label');
            labels.forEach(label => {
                const forAttr = label.getAttribute('for');
                if (forAttr) {
                    const baseName = forAttr.match(/(\w+)_\d+/)[1];
                    label.setAttribute('for', `${baseName}_${index}`);
                }
            });
        });
        updateFormVisibility(); 
    }
    function updateAge() {
        const birthdayValue = this.value;
        const index = this.id.match(/_(\d+)$/)[1];
        const ageInput = document.getElementById(`age_${index}`);
        if (birthdayValue) {
            ageInput.value = calculateAge(birthdayValue);
        } else {
            ageInput.value = '';
        }
    }
    document.getElementById('add-family-member').addEventListener('click', function() {
        const container = document.getElementById('family-members-container');
        const newForm = document.createElement('div');
        newForm.className = 'family-member-form row new'; 
        newForm.setAttribute('data-index', memberCount);
        newForm.innerHTML = `
            <div class="col-12 text-start">
                <button type="button" class="btn btn-outline-danger border-1 remove-family-member d-none"><i class="bi bi-x-lg"></i> Remove</button>
                <h5 class="form-number text-center fw-bold d-none">Member ${memberCount + 1}</h5>
            </div>
            <div class="col-lg-6 mb-3 text-black mt-2"> 
                <div class="col-lg-12 mb-1">
                    <div class="form-group mb-1 px-3">
                        <label class="form-label fw-bold" for="full_name_${memberCount}">Complete Name:</label>
                        <input type="text" name="family_members[${memberCount}][full_name]" class="w-full form-control border rounded-lg p-2 mb-3" id="full_name_${memberCount}"
                            placeholder="Complete Name" required autocomplete="full_name">

                        <label class="form-label fw-bold" for="relation_to_hfam_${memberCount}">Relationship to the Head of the Family:</label>
                        <input type="text" name="family_members[${memberCount}][relation_to_hfam]" class="w-full form-control border rounded-lg p-2 mb-3" id="relation_to_hfam_${memberCount}"
                            placeholder="Relationship to the Head of the Family" required autocomplete="relation_to_hfam">

                        <div class="d-flex justify-content-between">   
                            <div class="w-75 pe-3">
                                <label for="birthday_${memberCount}" class="form-label fw-bold">Birthday:</label>
                                <input type="date" name="family_members[${memberCount}][birthday]" class="form-control w-full border rounded-lg p-2 mb-3" id="birthday_${memberCount}"
                                    placeholder="Birthday" required autocomplete="birthday">
                            </div>
                            <div class="w-50 pe-3">
                                <label class="form-label fw-bold" for="age_${memberCount}">Age:</label>
                                <input type="number" name="family_members[${memberCount}][age]" class="form-control w-full border rounded-lg p-2 mb-3" id="age_${memberCount}"
                                    placeholder="Age" required autocomplete="age" readonly>
                            </div>
                            <div class="w-75 pe-3">
                                <label for="civil_status_${memberCount}" class="form-label fw-bold">Civil Status:</label>
                                <select name="family_members[${memberCount}][civil_status]" class="form-select w-full border rounded-lg p-2 mb-3" required>
                                    <option value="" hidden>Select Status</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Widowed">Widowed</option>
                                    <option value="Divorced">Divorced</option>
                                    <option value="Annulled">Annulled</option>
                                </select>
                            </div>
                            <div class="w-50">
                                <label for="sex_${memberCount}" class="form-label fw-bold">Sex:</label>
                                <select name="family_members[${memberCount}][sex]" class="form-select w-full border rounded-lg p-2 mb-3" required>
                                    <option value="" hidden>Select Sex</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">   
                            <div class="w-75 pe-3">
                                <label for="edu_attainment_${memberCount}" class="form-label fw-bold">Educational Attainment:</label>
                                <select name="family_members[${memberCount}][edu_attainment]" class="form-select w-full border rounded-lg p-2 mb-3" required>
                                    <option value="" hidden>Select Educational Attainment</option>
                                    <option value="College Graduate">College Graduate</option>
                                    <option value="College Undergraduate">College Undergraduate</option>
                                    <option value="High School Graduate">High School Graduate</option>
                                    <option value="High School Undergraduate">High School Undergraduate</option>
                                    <option value="Grade School">Grade School</option>
                                    <option value="Elementary">Elementary</option>
                                </select>
                            </div>
                            <div class="w-50">
                                <label class="form-label fw-bold" for="religion_${memberCount}">Religion:</label>
                                <input type="text" name="family_members[${memberCount}][religion]" class="w-full form-control border rounded-lg p-2 mb-3" id="religion_${memberCount}"
                                    placeholder="Religion" required autocomplete="religion">
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
            <div class="col-lg-6 text-black mt-4">
                <div class="col-lg-12 mb-1">
                    <div class="form-group mb-1">
                        <label class="form-label fw-bold" for="fam_planning_${memberCount}">Family Planning:</label>
                        <input type="text" name="family_members[${memberCount}][fam_planning]" class="w-full form-control border rounded-lg p-2 mb-3" id="fam_planning_${memberCount}"
                            placeholder="Family Planning" required autocomplete="fam_planning"> 
                        <div class="d-flex justify-content-between">
                            <div class="w-50 me-3">
                                <label class="form-label fw-bold" for="phihealth_no_${memberCount}">Philhealth No:</label>
                                <input type="text" name="family_members[${memberCount}][phihealth_no]" class="w-full form-control border rounded-lg p-2 mb-3" id="phihealth_no_${memberCount}"
                                    placeholder="Philhealth Number" required autocomplete="phihealth_no"> 
                            </div>
                            <div class="w-50 me-3">
                                <label for="membership_type_${memberCount}" class="form-label fw-bold">Members Type:</label>
                                <select name="family_members[${memberCount}][membership_type]" class="form-select w-full border rounded-lg p-2 mb-3" required>
                                    <option value="" hidden>Select Type</option>
                                    <option value="Dependent">Dependent</option>
                                    <option value="Independent">Independent</option>
                                </select>    
                            </div>
                            <div class="w-50">
                                <label for="voters_${memberCount}" class="form-label fw-bold">Voters:</label>
                                <select name="family_members[${memberCount}][voters]" class="form-select w-full border rounded-lg p-2 mb-3" required>
                                    <option value="" hidden>Yes or No</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>    
                            </div>
                        </div>
                        <label class="form-label fw-bold" for="medical_history_${memberCount}">Medical History:</label>
                        <input type="text" name="family_members[${memberCount}][medical_history]" class="w-full form-control border rounded-lg p-2 mb-3" id="medical_history_${memberCount}"
                            placeholder="Medical History" required autocomplete="medical_history"> 
                    </div>
                </div>
            </div>
           
        `;
        container.insertBefore(newForm, container.firstChild);
        const newBirthdayInput = document.getElementById(`birthday_${memberCount}`);
        newBirthdayInput.addEventListener('change', updateAge);
        setTimeout(() => {
            newForm.classList.remove('new');
        }, 10);
        memberCount++;
        reindexForms();
    });

    const initialBirthdayInput = document.getElementById('birthday_0');
    initialBirthdayInput.addEventListener('change', updateAge);
    document.getElementById('family-members-container').addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-family-member')) {
            if (confirm('Are you sure you want to remove this family member?')) {
                const formToRemove = e.target.closest('.family-member-form');
                const forms = document.querySelectorAll('.family-member-form');
                if (forms.length > 1) {
                    setTimeout(() => {
                        formToRemove.classList.add('removing');
                    }, 10);
                    formToRemove.addEventListener('transitionend', function handler() {
                        formToRemove.removeEventListener('transitionend', handler); 
                        formToRemove.remove();
                        reindexForms(); 
                    }, { once: true });
                } else {
                    alert('At least one family member form must remain.');
                }
            }
        }
    });
    updateFormVisibility();
</script>