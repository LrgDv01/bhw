function visitor_table() {
    let data_id = $("#data_id").val();
    $.ajax({
        type: "GET",
        url: "/admin/get_visitor_list",
        headers: {
            "X-CSRF-TOKEN": csrfToken, // Add CSRF token to the request headers
        },
        data: { pdl_id: data_id },
        success: function (response) {
            $("#visitorTable").DataTable().destroy();
            var table = $("#visitorTable").DataTable({
                responsive: true, // Enable responsiveness
                data: response,
                columns: [
                    { data: "name" },
                    { data: "gender" },
                    {
                        data: "contact_number",
                        render: function (data, type, row) {
                            return `<span>${row.email} <br>${row.contact_number}</span>`;
                        },
                    },
                    {
                        data: "id",
                        render: function (data, type, row) {
                            let actionbtn = `
                            <button class="btn btn-sm btn-danger delete-visitor" 
                              data-id="${row.id}"  
                              data-bs-toggle="tooltip" title="Delete">
                              <i class="bi bi-x"></i> Delete
                            </button>`;

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
                    
                    // Attach click event listener to delete buttons
                    $(".delete-visitor").on("click", function () {
                      var visitorId = $(this).data("id");
                      confirmDeleteVisitor(visitorId);
                  });
                },
            });
            
            // For Custom booking visitor
            response.forEach(function(x) {
                if(x['position'] == "Doctor" || x['position'] == "Lawyer") {
                    $('#visitor_custom_book_select').append(`<option value="${x.userID}">${x.name}</option>`);
                }
            });
            
        },
        error: function (xhr, status, error) {
            console.error("An error occurred: " + status + " - " + error);
            // Additional error handling here
        },
    });
}
visitor_table();
function confirmDeleteVisitor(visitorId) {
  $.alert({
      title: 'Are you sure?',
      content: 'You won\'t be able to revert this!',
      type: 'red',
      buttons: {
        cancel: function () {
          // Do nothing
        },
        confirm: {
            text: 'Yes, delete it!',
            btnClass: 'btn-red',
            action: function(){
                deleteVisitor(visitorId);
            }
        },
      }
  });
}
function deleteVisitor(visitorId) {
  $.ajax({
      type: "DELETE",
      url: `/admin/delete_visitor/${visitorId}`,
      headers: {
          "X-CSRF-TOKEN": csrfToken, // Add CSRF token to the request headers
      },
      success: function (response) {
        // Handle success response
        $.alert({
            title: 'Deleted!',
            content: 'The visitor has been deleted.',
            type: 'green'
        });
        // Refresh the table
        visitor_table();
      },
      error: function (xhr, status, error) {
        $.alert({
          title: 'Error!',
          content: 'An error occurred while deleting the visitor.',
          type: 'red'
        });
      },
  });
}
$(document).on("submit", "#add_visitor_form", function (e) {
    e.preventDefault();
    let formData = new FormData(this);
    // Show loading indicator
    showLoading();
    $.ajax({
        type: "POST",
        url: "/admin/add_account_submit",
        data: formData,
        processData: false,
        contentType: false,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (response) {
            hideLoading();
            global_showalert(response.message, "Success", "green");
            window.location.reload();
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

function fetch_accounts() {
    $("#select_user").html("");
    $.ajax({
        type: "GET",
        url: "/admin/get_users_as_visitor",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (response) {
            $("#select_user").append(
                `<option value="">Choose visitor account</option>`
            );
            response.forEach((data) => {
                $("#select_user").append(
                    `<option value="${data["id"]}">${data["name"]}</option>`
                );
            });
            $('#select_user').select2({
                placeholder: "Choose Visitor",
                allowClear: true,
                dropdownParent: $("#tagAccountForm") 
            });
            $('.select2-selection').css('border-color', '#dee2e6')
            $('.select2-selection').css('height', '100%')
            $('.select2-selection').addClass('form-control')
        },
    });
}
fetch_accounts();
$(document).on('click', '.tagAccountbtn', function () { 
  fetch_accounts();
  console.log('ashd')
})
$(document).on("submit", "#tagAccountForm", function (e) {
    e.preventDefault();

    let formData = new FormData(this);
    // Show loading indicator
    showLoading();
    $.ajax({
        type: "POST",
        url: "/admin/tag_visitor",
        data: formData,
        processData: false,
        contentType: false,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (response) {
            $('#tagAccountForm').modal('hide')
            hideLoading();
            global_showalert(response.message, "Success", "green");
            visitor_table();
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






function visitation_table(visitorId) {
    let data_id = $("#data_id").val();
    $.ajax({
        type: "GET",
        url: `/admin/get_visitation_of_pdl`,
        headers: {
            "X-CSRF-TOKEN": csrfToken, // Add CSRF token to the request headers
        },
        data: { pdl_id: data_id },
        success: function (response) {
            $("#visitationTable").DataTable().destroy();
            var table = $("#visitationTable").DataTable({
                responsive: true, // Enable responsiveness
                data: response,
                order: [2, "desc"],
                columns: [
                    { data: "transaction_number" },
                    { data: "type" },
                    { data: "date", type: "date" },
                    { data: "time" },
                    {
                        data: "bookID",
                        render: function (data, type, row) {
                            let action = '';
                            action = `<button class="btn btn-sm btn-success ViewBookingDetails" 
                                          data-bookID="${row.bookID}"  
                                          data-transaction_number="${row.transaction_number}"
                                          data-bs-toggle="tooltip" title="View details">
                                          <i class="bi bi-eye"></i>
                                      </button>`;
                            return `${action}`;
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
  visitation_table();
  
  
function custom_booking() {
    let data_id = $("#data_id").val();
    $.ajax({
        type: "GET",
        url: `/admin/get_custom_booking`,
        headers: {
            "X-CSRF-TOKEN": csrfToken, // Add CSRF token to the request headers
        },
        data: { "pdl_id": data_id },
        success: function (response) {
            $("#custom-bookingTable").DataTable().destroy();
            var table = $("#custom-bookingTable").DataTable({
                responsive: true, // Enable responsiveness
                data: response,
                order: [2, "desc"],
                columns: [
                    { data: "transaction_number" },
                    { data: "type" },
                    { data: "start_event", type: "date" },
                    {
                        data: "id",
                        render: function (data, type, row) {
                            let action = '';
                            action = `<button class="btn btn-sm btn-danger deleteCustomBooking" 
                                          data-bookid="${row.id}"  
                                          data-bs-toggle="tooltip" title="Delete Record">
                                          <i class="bi bi-x"></i>
                                      </button>`;
                            return `${action}`;
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
custom_booking();
$(document).on('click', '.deleteCustomBooking', function (e) {
    e.preventDefault();
    var bookID = $.trim($(this).data('bookid'));
    $.confirm({
        title: 'Confirm!',
        content: 'Are you sure you want to delete this booking?',
        buttons: {
            cancel: function () {
                // Do nothing on cancel
            },
            confirm: {
                btnClass: "btn-red",
                action: function () {
                    $.ajax({
                        type: "POST",
                        url: `/admin/custom_booking_delete/${bookID}`,
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                        },
                        success: function (response) {
                            if (response.status === 'success') {
                                global_showalert(response.message, "Success", "green");
                                custom_booking(); // Refresh the booking table
                            } else {
                                global_showalert("Failed to delete booking", "Error", "red");
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error("An error occurred: " + status + " - " + error);
                            global_showalert("An error occurred while deleting booking", "Error", "red");
                        }
                    });
                }
            }
        }
    });
});
$(document).on('submit', '#custom_booking_form', function (e) {
   e.preventDefault();
   let formData = new FormData(this);
   showLoading();
   $.ajax({
        type: "POST",
        url: "/admin/custom_booking_submit",
        data: formData,
        processData: false,
        contentType: false,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (response) {
            hideLoading();
            global_showalert(response.message, "Success", "green");
            custom_booking();
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
    })

});