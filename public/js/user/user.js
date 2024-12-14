$(document).on('submit', '#update_profile', function(e) {
  e.preventDefault();
  
  let formData = new FormData(this);
  showLoading();
  $.ajax({
      url: "/user/update-profile",
      method: "POST",
      data: formData,
      dataType: 'JSON',
      contentType: false,
      processData: false,
      success: function(response) {
        hideLoading();
        global_showalert(response.message, 'Congrats', 'blue', '/user/home');
      },
      error: function(response) {
        hideLoading();
          let errors = response.responseJSON.errors;
          let errorMsg = '';
          $.each(errors, function(key, value) {
              errorMsg += value[0] + '\n';
          });
          global_showalert(errorMsg, 'Alert!', 'red');
      }
  });
});

$(document).on('click', '.directtologout', function (e) { 
  $('#logoutform').trigger('submit');
});

// ADD FARM 
$(document).ready(function() {
  $(document).on('submit', '#add-farm-form',  function(event) {
    event.preventDefault(); // Prevent default form submission
    const formData = new FormData(this);
    $.ajax({
        url: "/user/add_farm",
        method: 'POST',
        data: formData,
        contentType: false,
        processData: false, // Prevent automatic processing
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
                if (data.success) {
                  $('#addFarmModal').modal('hide'); 
                  $('#add-farm-form')[0].reset(); 
                  $('.modal-backdrop').remove(); 
                  $('body').removeClass('modal-open'); 
                  location.reload();
                }     
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
            alert('An error occurred while adding the farm. Please try again.');
        }
    });
  });
});



