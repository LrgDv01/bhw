function announcement_table() {
    $.ajax({
        type: "GET",
        url: "/admin/get_announcement",
        headers: {
            "X-CSRF-TOKEN": csrfToken, // Add CSRF token to the request headers
        },
        success: function (response) {
            $("#announcementTable").DataTable().destroy();
            var table = $("#announcementTable").DataTable({
                responsive: true, // Enable responsiveness
                data: response,
                columns: [
                    { data: "title" },
                    { 
                        data: "created_at",
                        render: function (data, type, row) {
                            // Format the date using moment.js
                            return moment(data).format('MM/DD/YYYY'); // or 'DD/MM/YYYY' for different format
                        }
                    },
                    { data: "status", 
                        render: function (data, type, row) {
                            return row.status == 1 ? 'active' : 'inactive'; // Return 'active' or 'inactive' based on the status value
                        }
                    },
                    { data: "id",
                    render: function (data, type, row) {
                    
                        let actionbtn = `
                            <button class="btn btn-sm btn-primary update_announcement" 
                                data-id="${row.id}"  
                                data-bs-toggle="tooltip" title="Edit">
                                <i class="bi bi-pen"></i>
                            </button>
                            <button class="btn btn-sm btn-danger delele_announcement" 
                                data-id="${row.id}"  
                                data-bs-toggle="tooltip" title="Deactivate announcement">
                                <i class="bi bi-trash"></i>
                            </button>`;
                        actionbtn = row.status == 1 ? actionbtn : '';
                    
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

$(document).on('click', '.update_announcement', function () {
    let id = $.trim($(this).data('id'));
    var form = $('<form>', {
        'method': 'GET',
        'action': '/admin/update_announcement/' + id // URL to handle form submission
    });
    // Add CSRF token as a hidden input
    $('<input>').attr({
        'type': 'hidden',
        'name': '_token',
        'value': $('meta[name="csrf-token"]').attr('content')
    }).appendTo(form);
    $('<input>').attr({
        'type': 'hidden',
        'name': 'id',
        'value': id
    }).appendTo(form);
    // Append the form to the document body and submit it
    form.appendTo('body').submit();
});



$(document).on('click', '.delele_announcement', function () {
    let id = $.trim($(this).data('id'));
    $('#deleteAnnouncement').modal('show');
    $('#deactivate_announcement').data('id', id); // Store the user ID in the confirm button
});

$('#deactivate_announcement').on('click', function () {
    let id = $(this).data('id');
    showLoading();
    $.ajax({
        type: "POST",
        url: "/admin/delete_announcement_submit",
        headers: {
            "X-CSRF-TOKEN": csrfToken,
        },
        data: {
            announcement_id: id,
            _token: csrfToken
        },
        success: function (response) {
            $('#deleteAnnouncement').modal('hide');
            hideLoading();
            global_showalert(response.message, 'Success', 'green');
            announcement_table(); // Refresh the users table
        },
        error: function (xhr) {
            hideLoading();
            let response = JSON.parse(xhr.responseText);
            let errorMessage = 'An error occurred';
            if (response.errors) {
                errorMessage = '';
                for (let errorKey in response.errors) {
                    errorMessage += response.errors[errorKey][0] + '\n';
                }
            }
            global_showalert(errorMessage, 'Alert!', 'red');
        }
    });
});
$(document).on('submit', '#announcementform', function (e) { 
    e.preventDefault();
    let formData = new FormData(this);
    // Show loading indicator
    showLoading();
    $.ajax({
        type: "POST",
        url: "/admin/add_announcement_submit",
        data: formData,
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {  
            hideLoading();
            global_showalert(response.message, 'Success', 'green');
            $('#announcementform')[0].reset();
            $('.note-editable').html('');
        },
        error: function (xhr) {
            hideLoading();
            let response = JSON.parse(xhr.responseText);
            let errorMessage = 'An error occurred';
            if (response.errors) {
                errorMessage = '';
                for (let errorKey in response.errors) {
                    errorMessage += response.errors[errorKey][0] + '\n';
                }
            }
            global_showalert(errorMessage, 'Alert!', 'red');
        }
    });
});


$(document).on('submit', '#update_announcementform', function (e) { 
    e.preventDefault();
    let formData = new FormData(this);
    // Show loading indicator
    showLoading();
    $.ajax({
        type: "POST",
        url: "/admin/update_announcement_submit",
        data: formData,
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {  
            hideLoading();
            global_showalert(response.message, 'Success', 'green');
        },
        error: function (xhr) {
            hideLoading();
            let response = JSON.parse(xhr.responseText);
            let errorMessage = 'An error occurred';
            if (response.errors) {
                errorMessage = '';
                for (let errorKey in response.errors) {
                    errorMessage += response.errors[errorKey][0] + '\n';
                }
            }
            global_showalert(errorMessage, 'Alert!', 'red');
        }
    });
});

announcement_table();
