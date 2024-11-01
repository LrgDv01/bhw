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
// Function to download the QR code
function downloadQR() {
  // Get the QR code image
  const qrCodeImage = document.getElementById('myQR');

  // Create a new link element
  const link = document.createElement('a');
  link.href = qrCodeImage.src;
  link.download = 'qr_code.png';

  // Simulate a click on the link to download the image
  link.click();
}