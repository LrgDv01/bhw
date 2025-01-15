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
        <div class="container p-0">
            @if($reports->isEmpty())
                <p class="text-center">- No Reports available at the moment -</p>
            @else
                @foreach ($reports as $report)
                    <div class="card shadow-sm">
                        <div class="card-header bg-success text-white text-center sticky-top" style="z-index: 1;">
                            <h4>New Report</h4>
                        </div>
                        <div class="card-body p-0" style="max-height: 80vh; overflow-y: auto;">
                            @foreach ($report->userFarms as $farm)
                                @if ($farm->condition === 'is Infected')
                                    <ul class="list-group mb-3">
                                        <li class="list-group-item shadow-sm px-3">
                                            <form action="{{ route('reports.submit') }}" method="POST" id="submitForm{{ $farm->id }}">
                                                @csrf
                                                <input type="hidden" name="farm_id" value="{{ $farm->id }}">
                                                <input type="hidden" name="farm_id" value="{{ $farm->id }}">
                                                <div id="report-details" class="mb-3">
                                                    <h6 class="text-center"><strong>Farmer Details</strong></h6>
                                                    <h6><strong>Farmer Name:</strong> <span id="farmer_name">{{ $report->farmer_name }}</span></h6>
                                                    <h6><strong>Contact Information:</strong> <span id="contact_info">{{ $report->user->contact }}</span></h6>
                                                    <h6><strong>Recipient:</strong> <span id="recipient">{{ $recipient }}</span></h6>
                                                    <div>
                                                        <h6 class="text-center"><strong>Farm Details</strong></h6>
                                                        <strong>Farm Name:</strong> <span id="farm_name">{{ $farm->name }}</span><br>
                                                        <strong>Farm Location:</strong> <span id="farm_location">{{ $farm->location }}</span><br>
                                                        <strong>Farm Size:</strong> <span id="farm_size">{{ $farm->hectares }} hectares</span><br>
                                                        <strong>No. of Coconut Trees:</strong> <span id="coconut_trees">{{ $farm->planted_coconut }}</span><br>
                                                        <strong>Coconut Variety:</strong> <span id="coconut_variety">{{ $farm->variety }}</span>
                                                        <div class="mb-3">
                                                            <strong>Soil Type:</strong>
                                                            <select 
                                                                name="soil_type[{{ $farm->id }}]" 
                                                                id="soil_type_{{ $farm->id }}" 
                                                                class="form-select" 
                                                                required>
                                                                <option value="" selected disabled>Select a soil type</option>
                                                                <option value="Clay">Clay</option>
                                                                <option value="Sandy">Sandy</option>
                                                                <option value="Loamy">Loamy</option>
                                                                <option value="Silty">Silty</option>
                                                            </select>
                                                            <small id="error_soil_{{ $farm->id }}" class="text-danger" style="display: none;">Please select a soil type.</small>
                                                        </div>
                                                        <div class="mb-3">
                                                            <strong>Types of Diseases:</strong>
                                                            <select 
                                                                name="disease_type[{{ $farm->id }}][]" 
                                                                id="disease_type_select_{{ $farm->id }}" 
                                                                class="form-select" 
                                                                onchange="addDiseaseType(event, {{ $farm->id }})">
                                                                <option value="" selected disabled>Select a disease type</option>
                                                                <option value="Coconut Wilt">Coconut Wilt</option>
                                                                <option value="Bud Rot">Bud Rot</option>
                                                                <option value="Leaf Spot">Leaf Spot</option>
                                                                <option value="Stem Bleeding">Stem Bleeding</option>
                                                            </select>
                                                            <div id="disease_type_container_{{ $farm->id }}" class="mt-2"></div>
                                                            <small id="error_disease_{{ $farm->id }}" class="text-danger" style="display: none;">Please add at least one disease type.</small>
                                                        </div>
                                                        <div class="mb-3">
                                                            <strong>Condition Description:</strong>
                                                            <textarea 
                                                                name="note[{{ $farm->id }}]" 
                                                                id="condition_description_{{ $farm->id }}"
                                                                class="form-control" rows="2"  
                                                                placeholder="Add a note here..."
                                                                required></textarea>
                                                            <small id="error_note_{{ $farm->id }}" class="text-danger" style="display: none;">This field is required.</small>
                                                        </div>
                                                        <div class="d-flex justify-content-end mb-2">
                                                            @php
                                                                $isSubmitted = in_array($farm->id, $submittedReports);
                                                                $buttonClass = $isSubmitted ? 'btn-outline-danger active' : 'btn-success active';
                                                                $buttonText = $isSubmitted ? 'Submitted' : 'Submit';
                                                            @endphp
                                                            <button type="button" class="btn {{ $buttonClass }} px-3 w-35 btn-block rounded-pill"
                                                                data-bs-target="#actionModal{{ $farm->id }}" 
                                                                onclick="validateAndOpenModal(event, {{ $farm->id }})"
                                                                {{ $isSubmitted ? 'disabled' : '' }}>
                                                                <i class="bi bi-check-circle"></i> {{ $buttonText }}
                                                            </button> 
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </li>
                                    </ul>
                                    @include('user.technician.others.submit_report', ['farmId' => $farm->id])
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </section>
</main>
@include('user.partials.__footer')

<script>

    function submitReportForm(farmId) {
        const form = document.getElementById('submitForm' + farmId);
        if (!form) {
            console.error(`Form with ID submitForm${farmId} not found.`);
            return;
        }

        const reportDetails = {
            farmer_name: document.querySelector(`#submitForm${farmId} #farmer_name`)?.textContent || '',
            contact_info: document.querySelector(`#submitForm${farmId} #contact_info`)?.textContent || '',
            recipient: document.querySelector(`#submitForm${farmId} #recipient`)?.textContent || '',
            farm_name: document.querySelector(`#submitForm${farmId} #farm_name`)?.textContent || '',
            farm_location: document.querySelector(`#submitForm${farmId} #farm_location`)?.textContent || '',
            farm_size: document.querySelector(`#submitForm${farmId} #farm_size`)?.textContent || '',
            coconut_trees: document.querySelector(`#submitForm${farmId} #coconut_trees`)?.textContent || '',
            coconut_variety: document.querySelector(`#submitForm${farmId} #coconut_variety`)?.textContent || '',
            condition_description: document.querySelector(`#submitForm${farmId} #condition_description_${farmId}`)?.value || '',
        };

        // Remove previously appended inputs to avoid duplicates
        form.querySelectorAll('.dynamic-input').forEach(input => input.remove());

        // Append hidden inputs for each detail
        Object.keys(reportDetails).forEach(function (key) {
            // const hiddenInput = document.createElement('input');
            // hiddenInput.type = 'hidden';
            // hiddenInput.name = key;
            // hiddenInput.value = reportDetails[key];
            // hiddenInput.classList.add('dynamic-input'); // Mark input for easier identification
            // form.appendChild(hiddenInput);

            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = key;
            hiddenInput.value = reportDetails[key];
            form.appendChild(hiddenInput);
        });

        // Submit the form
        form.submit();
    }

    // Need for ajax request
    // function submitReportForm(farmId) {
    //     const form = document.getElementById('submitForm' + farmId);
    //     if (!form) {
    //         console.error(`Form with ID submitForm${farmId} not found.`);
    //         return;
    //     }

    //     const formData = new FormData(form);  // Get form data including CSRF token

    //     $.ajax({
    //         url: '/reports/submit', // Adjust URL if necessary
    //         method: 'POST',
    //         data: formData,
    //         processData: false,
    //         contentType: false,
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         success: function(response) {
    //             // Check if redirectUrl exists in the response
    //             if (response.redirectUrl) {
    //                 window.location.href = response.redirectUrl;  // Redirect manually
    //             } else {
    //                 alert('Report submitted successfully');
    //                 // Optionally, you can refresh the page or reset the form here
    //             }
    //         },
    //         error: function(xhr, status, error) {
    //             console.error('Error response:', xhr.responseText);

    //             if (xhr.status === 422) {
    //                 // Handle validation errors
    //                 let errors = JSON.parse(xhr.responseText);
    //                 let errorMessages = Object.values(errors).join(', ');
    //                 alert('Validation Error: ' + errorMessages);
    //             } else {
    //                 // General error handler
    //                 alert('An error occurred while submitting the report: ' + xhr.responseText);
    //             }
    //         }
    //     });
    // }

  
    function validateAndOpenModal(event, farmId) {
        event.preventDefault(); // Prevent default behavior initially

        // Helper function to toggle error display and class
        function toggleError(element, errorElement, condition) {
            if (!element || !errorElement) {
                console.error('Element or error element is missing');
                return;
            }

            if (condition) {
                element.classList.add('is-invalid');  // Add the 'is-invalid' class for invalid input
                errorElement.style.display = 'block';  // Show the error message
            } else {
                element.classList.remove('is-invalid');  // Remove the 'is-invalid' class when valid
                errorElement.style.display = 'none';     // Hide the error message
            }
        }

        // Get specific elements for the report
        const textarea = document.getElementById(`condition_description_${farmId}`);
        const container = document.getElementById(`disease_type_container_${farmId}`);
        const selectSoil = document.getElementById(`soil_type_${farmId}`);
        const errorNote = document.getElementById(`error_note_${farmId}`);
        const errorDisease = document.getElementById(`error_disease_${farmId}`);
        const errorSoil = document.getElementById(`error_soil_${farmId}`);
        let isValid = true;

        // Validate textarea
        const noteCondition = !textarea?.value.trim(); // Check if textarea is empty
        toggleError(textarea, errorNote, noteCondition); // Apply the error logic
        if (noteCondition) isValid = false; // If there's an error, set isValid to false

        // Validate disease types
        const diseaseCondition = container?.children.length === 0; // Check if no disease types are selected
        toggleError(container, errorDisease, diseaseCondition); // Apply the error logic
        if (diseaseCondition) isValid = false; // If there's an error, set isValid to false

        // Validate soil select
        const soilCondition = !selectSoil?.value; // Check if soil type is not selected
        toggleError(selectSoil, errorSoil, soilCondition); // Apply the error logic
        if (soilCondition) isValid = false; // If there's an error, set isValid to false

        // If all fields are valid, open the modal
        if (isValid) {
            const modalButton = event.target;
            const modalId = modalButton.getAttribute('data-bs-target'); // Get the modal target ID
            const modal = document.querySelector(modalId); // Select the modal

            if (modal) {
                const modalInstance = new bootstrap.Modal(modal); // Create a new Bootstrap modal instance
                modalInstance.show(); // Show the modal
            }
        } else {
            // Focus on the first invalid element for better UX
            if (noteCondition) textarea?.focus();
            else if (diseaseCondition) container?.focus();
            else if (soilCondition) selectSoil?.focus();
        }
    }

    function addDiseaseType(event, farmId) {
        const select = event.target;
        const selectedValue = select.value;

        if (!selectedValue) return; // Do nothing if no value is selected

        // Get the container for the added disease types
        const container = document.getElementById(`disease_type_container_${farmId}`);
        if (!container) {
            console.error(`Container for farmId ${farmId} not found.`);
            return;
        }

        // Check if the selected disease type is already added
        const existingDisease = Array.from(container.children).find(
            (child) => child.dataset.value === selectedValue
        );
        if (existingDisease) {
            alert("This disease type is already added.");
            select.value = ""; // Reset select
            return;
        }

        // Create input group
        const inputGroup = document.createElement("div");
        inputGroup.classList.add("input-group", "mb-2");
        inputGroup.dataset.value = selectedValue; // Store the disease type value for uniqueness

        // Read-only input field for the selected disease
        const input = document.createElement("input");
        input.type = "text";
        input.name = `disease_types[${farmId}][]`; // Form submission as array
        input.value = selectedValue;
        input.readOnly = true;
        input.classList.add("form-control");

        // Remove button
        const removeButton = document.createElement("button");
        removeButton.type = "button";
        removeButton.classList.add("btn", "btn-danger");
        removeButton.innerHTML = "Remove";
        removeButton.onclick = () => {
            container.removeChild(inputGroup); // Remove the input group
            // Re-add the option back to the select dropdown
            const option = document.createElement("option");
            option.value = selectedValue;
            option.textContent = selectedValue;

            // Insert option back in alphabetical order
            let inserted = false;
            for (let i = 1; i < select.options.length; i++) {
                if (select.options[i].textContent.localeCompare(selectedValue) > 0) {
                    select.add(option, select.options[i]);
                    inserted = true;
                    break;
                }
            }
            if (!inserted) select.appendChild(option); // Add at the end if not inserted

            // Show error if container becomes empty
            if (container.children.length === 0) {
                const errorMessage = document.getElementById(`error_disease_${farmId}`);
                if (errorMessage) {
                    errorMessage.style.display = "block";
                }
            }
        };

        // Append input and button to input group
        inputGroup.appendChild(input);
        inputGroup.appendChild(removeButton);
        container.appendChild(inputGroup);

        // Remove the selected option from the dropdown
        const selectedOption = select.querySelector(`option[value="${selectedValue}"]`);
        if (selectedOption) {
            selectedOption.remove();
        }

        // Hide error message if it exists
        const errorMessage = document.getElementById(`error_disease_${farmId}`);
        if (errorMessage) {
            errorMessage.style.display = "none";
        }

        // Reset the select element
        select.value = "";
    }

</script>