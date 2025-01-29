$(document).ready(function () {
    $.ajax({
      type: "GET",
      url: "/admin/get_dashboard_info",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function (response) {
        // $('#total_population').text(response.total_population);
        // $('#total_maternal').text(response.total_maternal);
        // $('#total_deworming').text(response.total_deworming);
        // $('#total_women').text(response.total_women);
        console.log(response);
   

      }
    });
});

