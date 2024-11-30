$(document).on('submit', '#add_account_form', function (e) { 
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
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {  
            hideLoading();
            global_showalert(response.message, 'Success', 'green');
            $('#add_account_form')[0].reset();
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

$(document).on('submit', '#changepassword, #changepasswordform', function (e) { 
    e.preventDefault();
    let formData = new FormData(this);
    // Show loading indicator
    showLoading();
    $.ajax({
        type: "POST",
        url: "/admin/change_password",
        data: formData,
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {  
            hideLoading();
            global_showalert(response.message, 'Success', 'green');
            $('#changepassword')[0].reset();
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

// $(document).ready(function () {
//     $.ajax({
//         type: "GET",
//         url: "/admin/get_pendings",
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         },
//         dataType: "JSON",
//         success: function (response) {
//             if(response.physical > 0) {
//                 $('.physical_alert').show()
//                 $('.physical_alert').text(response.physical)
//             }
//             if(response.virtual > 0) {
//                 $('.virtual_alert').show()
//                 $('.virtual_alert').text(response.virtual)
//             }
//         },
//         error: function (xhr) {
//             hideLoading();
//             let response = JSON.parse(xhr.responseText);
//             let errorMessage = 'An error occurred';
//             if (response.errors) {
//                 errorMessage = '';
//                 for (let errorKey in response.errors) {
//                     errorMessage += response.errors[errorKey][0] + '\n';
//                 }
//             }
//             global_showalert(errorMessage, 'Alert!', 'red');
//         }
//     });
// });