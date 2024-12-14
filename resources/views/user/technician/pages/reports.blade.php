@include('user.partials.__header')
@include('user.partials.__nav')
<style>
    .is-invalid {
        border: 2px solid red;
        outline: none;
    }
</style>
<main id="main" class="main">
    <section class="section reports">
        <div class="container">
            @if($reports->isEmpty())
                <p class="text-center">- No Reports available at the moment -</p>
            @else
                @foreach ($reports as $report)
                    <div class="card shadow-sm">
                        <div class="card-header bg-success text-white text-center sticky-top" style="z-index: 1;">
                            <h4>New Report</h4>
                        </div>
                        <div class="card-body p-0" style="max-height: 60vh; overflow-y: auto;">
                            <ul class="list-group">
                                <li class="list-group-item shadow-sm px-3">
                                    <form action="{{ route('reports.submit') }}" method="POST" id="submitForm{{ $report->id }}">
                                        @csrf
                                        <input type="hidden" name="report_id" value="{{ $report->id }}">

                                        <div id="report-details">
                                            <h6 class="text-center"><strong>Farmer Details</strong></h6>
                                            <h6><strong>Farmer Name:</strong> <span id="farmer_name">{{ $report->farmer_name }}</span></h6>
                                            <h6><strong>Contact Information:</strong> <span id="contact_info">{{ $report->user->contact }}</span></h6>
                                            <h6><strong>Recipient:</strong> <span id="recipient">{{ $recipient }}</span></h6>
                                            <hr>
                                            <h6 class="text-center"><strong>Farm Details</strong></h6>
                                            @foreach ($report->userFarms as $farm)
                                                <h6><strong>Farm Location:</strong> <span id="farm_location">{{ $farm->location }}</span></h6>
                                                <h6><strong>Farm Size:</strong> <span id="farm_size">{{ $farm->hectares }} hectares</span></h6>
                                                <h6><strong>No. of Coconut Trees:</strong> <span id="coconut_trees">{{ $farm->planted_coconut }}</span></h6>
                                                <h6><strong>Coconut Variety:</strong> <span id="coconut_variety">{{ $farm->variety }}</span></h6>
                                            @endforeach
                                        </div>
                                        <div class="mb-3">
                                            <strong>Soil Type:</strong>
                                            <select 
                                                name="soil_type" 
                                                id="soil_type_{{ $report->id }}" 
                                                class="form-select" 
                                                required>
                                                <option value="" selected disabled>Select a soil type</option>
                                                <option value="Clay">Clay</option>
                                                <option value="Sandy">Sandy</option>
                                                <option value="Loamy">Loamy</option>
                                                <option value="Silty">Silty</option>
                                            </select>
                                            <small id="error_soil_{{ $report->id }}" class="text-danger" style="display: none;">Please select a soil type.</small>
                                        </div>
                                        <div class="mb-3">
                                            <strong>Types of Diseases:</strong>
                                            <select 
                                                id="disease_type_select_{{ $report->id }}" 
                                                class="form-select" 
                                                onchange="addDiseaseType(event, {{ $report->id }})">
                                                <option value="" selected disabled>Select a disease type</option>
                                                <option value="Coconut Wilt">Coconut Wilt</option>
                                                <option value="Bud Rot">Bud Rot</option>
                                                <option value="Leaf Spot">Leaf Spot</option>
                                                <option value="Stem Bleeding">Stem Bleeding</option>
                                            </select>
                                            <div id="disease_type_container_{{ $report->id }}" class="mt-2"></div>
                                            <small id="error_disease_{{ $report->id }}" class="text-danger" style="display: none;">Please add at least one disease type.</small>
                                        </div>

                                        <div class="mb-3">
                                            <strong>Condition Description:</strong>
                                            <textarea 
                                                name="note" id="condition_description_{{ $report->id }}"
                                                class="form-control" rows="2"  
                                                placeholder="Add a note here..."
                                                required></textarea>
                                            <small id="error_note_{{ $report->id }}" class="text-danger" style="display: none;">This field is required.</small>
                                        </div>
                                        <div class="d-flex justify-content-end mb-2">
                                            <button type="button" class="btn btn-success px-3 w-35 btn-block rounded-pill"
                                                    data-bs-target="#actionModal{{ $report->id }}"
                                                    onclick="validateAndOpenModal(event, {{ $report->id }})">
                                                <i class="bi bi-check-circle"></i> Submit
                                            </button> 
                                        </div>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                    @include('user.technician.others.submit_report', ['reportId' => $report->id])
                @endforeach
            @endif
        </div>
    </section>
</main>
@include('user.partials.__footer')

<script>
    function submitReportForm(reportId) {
        const form = document.getElementById('submitForm' + reportId);
        const reportDetails = {
            farmer_name: document.getElementById('farmer_name').textContent,
            contact_info: document.getElementById('contact_info').textContent,
            recipient: document.getElementById('recipient').textContent,
            farm_location: document.getElementById('farm_location').textContent,
            farm_size: document.getElementById('farm_size').textContent,
            coconut_trees: document.getElementById('coconut_trees').textContent,
            coconut_variety: document.getElementById('coconut_variety').textContent,
            // condition_description: document.getElementById(`condition_description_${reportId}`).value,
        };
        Object.keys(reportDetails).forEach(function(key) {
            let hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = key;
            hiddenInput.value = reportDetails[key];
            form.appendChild(hiddenInput);
        });
        form.submit();
    }
    
    function validateAndOpenModal(event, reportId) {
        // Get the specific elements for the report
        const textarea = document.getElementById(`condition_description_${reportId}`);
        const container = document.getElementById(`disease_type_container_${reportId}`);
        const selectSoil = document.getElementById(`soil_type_${reportId}`);
        const errorNote = document.getElementById(`error_note_${reportId}`);
        const errorDisease = document.getElementById(`error_disease_${reportId}`);
        const errorSoil = document.getElementById(`error_soil_${reportId}`);
        
        let isValid = true;

        // Validate textarea
        if (!textarea.value.trim()) {
            textarea.classList.add('is-invalid');
            errorNote.style.display = 'block';
            isValid = false;
        } else {
            textarea.classList.remove('is-invalid');
            errorNote.style.display = 'none';
        }

        // Validate disease types
        if (container.children.length === 0) {
            errorDisease.style.display = 'block';
            isValid = false;
        } else {
            errorDisease.style.display = 'none';
        }

        // Validate soil select
        if (!selectSoil.value) {
            selectSoil.classList.add('is-invalid');
            errorSoil.style.display = 'block';
            isValid = false;
        } else {
            selectSoil.classList.remove('is-invalid');
            errorSoil.style.display = 'none';
        }

        // If all fields are valid, open the modal
        if (isValid) {
            const modalButton = event.target;
            const modalId = modalButton.getAttribute('data-bs-target');
            const modal = document.querySelector(modalId);
            const modalInstance = new bootstrap.Modal(modal);
            modalInstance.show();
        } else {
            event.preventDefault(); // Prevent modal from opening
        }
    }

    function addDiseaseType(event, reportId) {
        const select = event.target;
        const selectedValue = select.value;

        // Get the container for the added disease types
        const container = document.getElementById(`disease_type_container_${reportId}`);

        // Check if the selected disease type is already added
        if (Array.from(container.children).some(child => child.dataset.value === selectedValue)) {
            return; // Skip if already added (safety check)
        }

        // Create a new input element for the selected disease type
        const inputGroup = document.createElement('div');
        inputGroup.classList.add('input-group', 'mb-2');
        inputGroup.dataset.value = selectedValue; // Store the disease type value for uniqueness check

        const input = document.createElement('input');
        input.type = 'text';
        input.name = `disease_types[]`; // Make it an array for form submission
        input.value = selectedValue;
        input.readOnly = true;
        input.classList.add('form-control');

        const removeButton = document.createElement('button');
        removeButton.type = 'button';
        removeButton.classList.add('btn', 'btn-danger');
        removeButton.innerHTML = 'Remove';
        removeButton.onclick = () => {
            container.removeChild(inputGroup); // Remove the input group
            // Re-add the option back to the select dropdown
            const option = document.createElement('option');
            option.value = selectedValue;
            option.textContent = selectedValue;
            select.appendChild(option);
        };

        inputGroup.appendChild(input);
        inputGroup.appendChild(removeButton);
        container.appendChild(inputGroup);

        // Remove the selected option from the dropdown
        const selectedOption = select.querySelector(`option[value="${selectedValue}"]`);
        if (selectedOption) {
            selectedOption.remove();
        }

        // Reset the select element
        select.value = '';
    }

</script>