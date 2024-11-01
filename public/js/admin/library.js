function pld_table() {
 var gender = $('#genderFilter').val();
        var crimeCategory = $('#crimeCategoryFilter').val();
    $.ajax({
        type: "GET",
        url: "/admin/get_pdl",
        headers: {
            "X-CSRF-TOKEN": csrfToken, // Add CSRF token to the request headers
        },
        data: {
            gender: gender,
            crimeCategory: crimeCategory,
        },
        success: function (response) {
            $("#pdl_table").DataTable().destroy();
            var table = $("#pdl_table").DataTable({
                responsive: true, // Enable responsiveness
                data: response,
                columns: [
                    { data: "pdl_id" },
                    { data: "name" },
                    { data: "gender" },
                    { data: "crimeCategory" },
                    {
                        data: "id",
                        render: function (data, type, row) {
                            let pdl_status = ``;
                            if(row.status == 'Active') {
                                pdl_status = `<button class="btn btn-sm btn-danger update_status_dps" 
                                                data-id="${row.id}"  
                                                data-status="Inactive"
                                                data-bs-toggle="tooltip" title="Deactivate Data">
                                                <i class="bi bi-trash"></i>
                                            </button>`
                            } else {
                                pdl_status = `<button class="btn btn-sm btn-primary update_status_dps" 
                                                data-id="${row.id}"  
                                                data-status="Active"
                                                data-bs-toggle="tooltip" title="Activate Data">
                                                <i class="bi bi-check"></i>
                                            </button>`
                            }
                        
                            let actionbtn = `
                              <a href="/admin/update_pdl/${row.id}" class="btn btn-sm btn-primary" 
                                  data-id="${row.id}"  
                                  data-bs-toggle="tooltip" title="View info">
                                  <i class="bi bi-eye"></i>
                              </a>
                              ${pdl_status}`;

                            return actionbtn;
                        },
                    },
                ],
                drawCallback: function () {
                    // Initialize tooltips after table draw
                    var tooltipTriggerList = [].slice.call(
                        document.querySelectorAll('[data-bs-toggle="tooltip"]')
                    );
                    var tooltipList = tooltipTriggerList.map(function (
                        tooltipTriggerEl
                    ) {
                        return new bootstrap.Tooltip(tooltipTriggerEl);
                    });
                },
            });
        },
        error: function (xhr, status, error) {
            console.error("An error occurred: " + status + " - " + error);
            // Additional error handling here
        },
    });
}
pld_table();
$(document).on('click', '#filterBtn', function (e) { 
    e.preventDefault();
    pld_table();
});
$(document).on('click', '.update_status_dps', function (e) { 
    e.preventDefault();
    var pdl_id = $.trim($(this).data('id'));
    var status = $.trim($(this).data('status'));
    var status_text = '';
    status_text = status == "Active" ? "Activate" : "Deactivate";
    status_btn = status == "Active" ? "btn-blue" : "btn-red";
    $.confirm({
        title: 'Confirm!',
        content: `Are you sure you want to ${status_text} this pdl data?`,
        buttons: {
            cancel: function () {
                // Do nothing on cancel
            },
            confirm: {
                btnClass: status_btn,
                action: function () {
                    $.ajax({
                        type: "POST",
                        url: `/admin/update_pdl_status`,
                        data: { pdl_status: status, pdl_id: pdl_id },
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                        },
                        success: function (response) {
                            global_showalert(response.message, "Success", "green");
                            pld_table(); // Refresh the booking table
                        },
                        error: function (xhr, status, error) {
                            console.error("An error occurred: " + status + " - " + error);
                            global_showalert("An error occurred while deleting booking", "Error", "red");
                        }
                    });
                }
            }
        }
    })
})
$(document).on("submit", "#add_pdl_form", function (e) {
    e.preventDefault();
    let formData = new FormData(this);
    // Show loading indicator
    showLoading();
    $.ajax({
        type: "POST",
        url: "/admin/add_pdl_submit",
        data: formData,
        processData: false,
        contentType: false,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (response) {
            hideLoading();
            $("#add_pdl_form")[0].reset();
            global_showalert(response.message, "Success", "green", "/admin/library");
        },
        error: function (xhr) {
            hideLoading();
            let response = JSON.parse(xhr.responseText);
            let errorMessage = "An error occurred";
            if (response.errors) {
                errorMessage = "";
                for (let errorKey in response.errors) {
                    errorMessage += response.errors[errorKey][0] + "\n";
                }
            }
            global_showalert(errorMessage, "Alert!", "red");
        },
    });
});

$(document).on("submit", "#update_pdl_form", function (e) {
    e.preventDefault();
    let formData = new FormData(this);
    // Show loading indicator
    showLoading();
    $.ajax({
        type: "POST",
        url: "/admin/update_pdl_submit",
        data: formData,
        processData: false,
        contentType: false,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (response) {
            hideLoading();
            $("#update_pdl_form")[0].reset();
            global_showalert(response.message, "Success", "green", "/admin/library");
        },
        error: function (xhr) {
            hideLoading();
            let response = JSON.parse(xhr.responseText);
            let errorMessage = "An error occurred";
            if (response.errors) {
                errorMessage = "";
                for (let errorKey in response.errors) {
                    errorMessage += response.errors[errorKey][0] + "\n";
                }
            }
            global_showalert(errorMessage, "Alert!", "red");
        },
    });
});

function facility_table() {
    $.ajax({
        type: "GET",
        url: "/admin/get_facility",
        headers: {
            "X-CSRF-TOKEN": csrfToken, // Add CSRF token to the request headers
        },
        success: function (response) {
            $("#facility_table").DataTable().destroy();
            var table = $("#facility_table").DataTable({
                responsive: true, // Enable responsiveness
                data: response,
                columns: [
                    { data: "id" },
                    { data: "facility_name" },
                    { data: "status" },
                    {
                        data: "id",
                        render: function (data, type, row) {
                            let actionbtn = ``;
                            if(row.status == "Active") {
                                actionbtn = `
                                <button data-status="Deactivate" class="btn btn-sm btn-danger change_facility_status" 
                                    data-id="${row.id}"  
                                    data-bs-toggle="tooltip" title="Deactivate Facility">
                                    <i class="bi bi-trash"></i>
                                </button>`;
                            } else {
                                actionbtn = `
                                <button data-status="Active" class="btn btn-sm btn-primary change_facility_status" 
                                    data-id="${row.id}"  
                                    data-bs-toggle="tooltip" title="Activate Facility">
                                    <i class="bi bi-check"></i>
                                </button>`;
                            }
                            
                            return actionbtn;
                        },
                    },
                ],
                drawCallback: function () {
                    // Initialize tooltips after table draw
                    var tooltipTriggerList = [].slice.call(
                        document.querySelectorAll('[data-bs-toggle="tooltip"]')
                    );
                    var tooltipList = tooltipTriggerList.map(function (
                        tooltipTriggerEl
                    ) {
                        return new bootstrap.Tooltip(tooltipTriggerEl);
                    });
                },
            });
        },
        error: function (xhr, status, error) {
            console.error("An error occurred: " + status + " - " + error);
            // Additional error handling here
        },
    });
}
facility_table();
$(document).on("click", ".change_facility_status", function (e) {
    let status = $.trim($(this).data('status'));
    if(status == "Active") {
        $('.facitity_action_text').text('Are you sure you want to activate this facility?');
        $('#confirmFacilityAction').text('Activate');
        $('#confirmFacilityAction').addClass('btn-primary');
        $('#confirmFacilityAction').removeClass('btn-warning');
    } else {
        $('.facitity_action_text').text('Are you sure you want to deactivate this facility?');
        $('#confirmFacilityAction').text('Deactivate');
        $('#confirmFacilityAction').addClass('btn-warning');
        $('#confirmFacilityAction').removeClass('btn-primary');
    }
    let facility_id = $.trim($(this).data('id'));
    $('#facilitiesActionModal').modal('show');
    $('#confirmFacilityAction').data('facility_id', facility_id); // Store the user ID in the confirm button
    $('#confirmFacilityAction').data('facility_status', status); // Store the user ID in the confirm button
});
$('#confirmFacilityAction').on('click', function () {
    let facility_id = $(this).data('facility_id');
    let facility_status = $(this).data('facility_status');
    $.ajax({
        type: "POST",
        url: "/admin/update_facility_status",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        data: {
            facility_id: facility_id,
            facility_status: facility_status,
        },
        success: function (response) {
            $('#facilitiesActionModal').modal('hide');
            global_showalert(response.message, "Success", "green");
            facility_table(); // Refresh the users table
        },
        error: function (xhr, status, error) {
            console.error("An error occurred: " + status + " - " + error);
            global_showalert('Failed to made action', "Failed", "red");
        },
    });
});
$(document).on("submit", "#add_facilities_form", function (e) {
    e.preventDefault();
    let formData = new FormData(this);
    // Show loading indicator
    showLoading();
    $.ajax({
        type: "POST",
        url: "/admin/add_facilities_submit",
        data: formData,
        processData: false,
        contentType: false,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (response) {
            hideLoading();
            global_showalert(response.message, "Success", "green");
            $("#add_facilities_form")[0].reset();
            facility_table();
        },
        error: function (xhr) {
            hideLoading();
            let response = JSON.parse(xhr.responseText);
            let errorMessage = "An error occurred";
            if (response.errors) {
                errorMessage = "";
                for (let errorKey in response.errors) {
                    errorMessage += response.errors[errorKey][0] + "\n";
                }
            }
            global_showalert(errorMessage, "Alert!", "red");
        },
    });
});
