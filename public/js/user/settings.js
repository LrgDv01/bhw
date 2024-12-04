$(document).on('submit', '#editFieldForm', function(event) {
    event.preventDefault();  // Prevent form submission

    const fieldName = $('#fieldName').val();
    const fieldValue = $('#fieldValue').val();

    $.ajax({
        url: '/user/update-field',
        method: 'POST',
        data: {
            field: fieldName,
            value: fieldValue
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            if (response.success) {
                $('#user_name').text(fieldValue);
                $('#editFieldModal').modal('hide');  
            }
        },
        error: function (xhr) {
            console.error(xhr.responseText);
        }
    });
});


$(document).on('submit', '#updateProfileForm', function() {
    const full_name = $('#full_name').val();
    const age = $('#age').val();
    const gender = $('#gender').val();
    const contact = $('#contactNo').val();
    const email = $('#email').val();
    const district = $('#district').val();
    const municipality = $('#municipality').val();
  
    // Send data via AJAX to update the profile
    $.ajax({
      url: '/user/update-profile',  // Adjust the URL to your update endpoint
      method: 'POST',
      data: {
        full_name: full_name,
        // age: age,
        // gender: gender,
        contact: contact,
        email: email,
        // district: district,
        // municipality: municipality
      },
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  // CSRF token for security
      },
      success: function(response) {
        if (response.success) {
          // Optionally, update UI with new values
        //   $('#userName').text(name);  // Assuming you display the name elsewhere on the page
        //   $('#userAge').text(age);    // Same for other fields
          
          // Close the modal after successful update
          $('#updateProfileModal').modal('hide');
        }
      },
      error: function(xhr) {
        console.error(xhr.responseText);  // Handle error
      }
    });
  });
  