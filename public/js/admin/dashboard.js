$(document).ready(function () {
    let count_login = $('#count_login');
    let count_approved_verification = $('#count_approved_verification');
    if(count_login.length > 0 || count_approved_verification.length > 0) {
      $.ajax({
        type: "GET",
        url: "/admin/get_dashboard_info",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
          console.log('>>>', response.count_farmers);
          $('#count_today_farmers').text(response.count_farmers);
          $('#count_login').text(response.count_login);
          $('#count_today_book').text(response.count_today_book);
          $('#count_virtual_approved_book').text(response.count_virtual_approved_book);
          $('#count_virtual_rejected_book').text(response.count_virtual_rejected_book);
          $('#count_virtual_pending_book').text(response.count_virtual_pending_book);
          $('#count_physical_approved_book').text(response.count_physical_approved_book);
          $('#count_physical_rejected_book').text(response.count_physical_rejected_book);
          $('#count_physical_pending_book').text(response.count_physical_pending_book);
          if(response.user_verification_counts.pending > 0) {
            $('.user_verification_request').show()
            $('.user_verification_request').text(response.user_verification_counts.pending)
          }
          $('#count_approved_verification').text(response.user_verification_counts.approved)
          $('#count_declined_verification').text(response.user_verification_counts.declined)
          $('#count_pending_verification').text(response.user_verification_counts.pending)
        }
      });
    }
});