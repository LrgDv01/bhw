$('#visitor_select').select2({
  placeholder: "Choose Visitor",
  allowClear: true
});
$('.select2-selection').css('border-color', '#dee2e6')
$('.select2-selection').css('height', '100%')
$('.select2-selection').addClass('form-control')
const get_list_visitor = (pdl_id) => {
  if(pdl_id != "") {
    $.ajax({
      type: "GET",
      url: "/user/visitor_list",
      data: { pdlID: pdl_id },
      headers: {
        'X-CSRF-TOKEN': csrfToken
      },
      success: function (response) {
        let visitorSelect = $('#visitor_select');
        visitorSelect.empty(); // Clear existing options
        visitorSelect.append('<option value="">--Choose Visitor--</option>');
        if (response.length > 0) {
          response.forEach(visitor => {
            let newOption = new Option(visitor.visitor_name, visitor.visitor_id, false, false);
            visitorSelect.append(newOption).trigger('change');
          });
        } else {
          visitorSelect.append('<option value="">No visitors found</option>');
        }
        visitorSelect.trigger('change'); // Notify Select2 to update
      },
      error: function (xhr, status, error) {
        console.error('Error fetching visitor list:', status, error);
      }
    });
  }
}
$(document).on('submit','#add_booking_form',function (e) { 
  e.preventDefault();
  let formData = new FormData(this);
  // Show loading indicator
  showLoading();
  $.ajax({
    type: "POST",
    url: "/user/add_booking_submit",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      hideLoading();
      $('#add_booking_form')[0].reset();
      global_showalert(response.message, 'Book success', 'blue',"/user/visitor_status");
    },
    error: function (xhr) {
        hideLoading();
        $('#add_booking_form')[0].reset();
        let response = JSON.parse(xhr.responseText);
        global_showalert(response.errors, 'Alert!', 'red');
    }
  });
})


var blockedDates = [];
var showcalendar;
$(document).ready(function () {
    $.ajax({
        url: "/user/get-dates",
        type: "GET",
        headers: {
            "X-CSRF-TOKEN": csrfToken,
        },
        success: function (response) {
            blockedDates = response.block;
            renderCalendar();
        },
        error: function (error) {
            console.log("Error fetching blocked dates:", error);
        },
    });
});

function renderCalendar() {
  if ($("#showcalendar").fullCalendar('getCalendar')) {
      $("#showcalendar").fullCalendar('destroy');
  }
  showcalendar = $("#showcalendar").fullCalendar({
      header: {
        left: 'prev,next today',
        center: '',
        right: 'title',
      },
      footer: {
        right: 'month,agendaWeek,agendaDay,listMonth'
      },
      initialView: "dayGridMonth",
      events: "/user/events",
      eventRender: function (event, element) {
          if (event.title.toLowerCase() === "blocked") {
              element.addClass("text-center");
              element.find(".fc-title").html('<i class="fas fa-ban"></i>'); // Set only the icon
          }
          element.find(".fc-time").remove();
          element.attr("title", event.title);
          element.tooltip({
              container: "body",
              placement: "top",
          });
      }
  });
}
