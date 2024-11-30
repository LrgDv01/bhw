
$(document).on('submit', '#registerform', function (e) { 
    e.preventDefault();
    let formData = new FormData(this);
    // Show loading indicator
    showLoading();
    $.ajax({
        type: "POST",
        url: "/registersubmit",
        data: formData,
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) { 
            console.log("response >>>", response); 
            hideLoading();
            $('#registerform')[0].reset();
            global_showalert(response.message, 'Congrats', 'blue', '/login');
            // Redirect to login page after displaying the message
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
            global_showalert(errorMessage, 'Alert!!', 'red');
        }
    });
});


$(document).on('submit', '#loginform', function (e) { 
    e.preventDefault();
    let formData = new FormData(this);
    // Show loading indicator
    showLoading();
    $.ajax({
        type: "POST",
        url: "/loginsubmit",
        data: formData,
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {  
            hideLoading();
            global_showalert(response.message, 'Login Success', 'blue', response.redirect);
        },
        error: function (xhr) {
            hideLoading();
            $('#loginform')[0].reset();
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