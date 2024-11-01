const bookingTable = () => {
  let param_type = $('#param_visit_type').text();
  $.ajax({
      type: "GET",
      url: "/admin/bookingrequest/" + param_type,
      headers: {
          "X-CSRF-TOKEN": csrfToken, // Add CSRF token to the request headers
      },
      success: function (response) {
          $("#bookingTable").DataTable().destroy();
          var booking_table = $("#bookingTable").DataTable({
              responsive: true, // Enable responsiveness
              data: response,
              columns: [
                  { data: "transaction_number" },
                  { data: "pdl_name" },
                  { data: "date", type: 'date' },
                  { data: "time" },
                  { data: "type", 
                    render: function (data, type, row) { 
                      let typeshow = row.type == "Physical" ? "Onsite" : row.type ;
                      return typeshow;
                    }  
                  },
                  { data: "status", 
                    render: function (data, type, row) { 
                      return status_arr[row.status]
                    }
                  },
                  {
                    data: "bookID",
                    render: function (data, type, row) {
                        let action = '';
                        let status = 'disabled';
                        let displaybtn = '';
                        if(row.type == "Virtual" && row.link == null) {
                          status = ``;
                        } 
                        if(row.type != "Virtual") {
                          displaybtn = 'style="display:none"';
                        }
                        action = `<button class="btn btn-sm btn-info meeting_link" 
                                      data-bookID="${row.bookID}"  
                                      data-transaction_number="${row.transaction_number}"
                                      data-bs-toggle="tooltip" title="Meeting Link" ${status} ${displaybtn}>
                                      <i class="bi bi-link-45deg"></i>
                                  </button>
                                  <button class="btn btn-sm btn-success ViewBookingDetails" 
                                      data-bookID="${row.bookID}"  
                                      data-transaction_number="${row.transaction_number}"
                                      data-bs-toggle="tooltip" title="View details">
                                      <i class="bi bi-eye"></i>
                                  </button>`;
                        return `${action}`;
                    },
                },
              ],
              order: [[2, 'desc'], [5, 'asc']], 
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
};
let booking = document.getElementById("bookingTable");
if (booking) {
  bookingTable();
}

$(document).on('click', '.meeting_link', function (e) {
  let bookID = $.trim($(this).data('bookid'));
  let transaction_number = $.trim($(this).data('transaction_number'));
  $('#meeting_link_modal').find('input[name="bookID"]').val(bookID);
  $('#meeting_link_modal').modal('show');
});
$(document).on('change', '#link_type', function (e) {
  if($(this).val() == "google") {
    $('#meeting_link_input').attr('placeholder', "Enter meeting link");
    $('#meeting_link_label').text("Add Meeting Link");
    $('.redirectfield').hide();
  } else if($(this).val() == "code") {
    $('#meeting_link_input').attr('placeholder', "Enter meeting code");
    $('#meeting_link_label').text("Add Meeting Code");
    $('.redirectfield').show();
  } else {
    $('#meeting_link_input').attr('placeholder', "Please choose what type of meeting to be use");
    $('#meeting_link_label').text("Add Meeting Link/Code");
    $('.redirectfield').hide();
  }
});
$(document).on('submit', '#add_meeting_link_form', function (e) {
  e.preventDefault();
  showLoading();
  let formData = new FormData(this);
  $.ajax({
    type: "POST",
    url: `/admin/update_meeting_link`,
    data: formData,
    processData: false,
    contentType: false,
    headers: {
        "X-CSRF-TOKEN": csrfToken
    },
    success: function (response) {
        hideLoading();
        $('#meeting_link_modal').modal('hide');
        $('#add_meeting_link_form')[0].reset();
        global_showalert(response.message, 'Add code/link success', 'blue');
        bookingTable(); // Refresh the booking table
    },
    error: function (xhr, status, error) {
      hideLoading();
      console.error(xhr.responseText);
      // Handle error here
    }
  });
});
$(document).on('click', '.ViewBookingDetails', function (e) { 
  let bookID = $.trim($(this).data('bookid'));
  let transaction_number = $.trim($(this).data('transaction_number'));
  $.ajax({
    type: "GET",
    url: `/admin/bookingdetails/${transaction_number}/${bookID}`,
    success: function (response) {
      $('#bookdetailmodal .modal-dialog').html(response);
      $('#bookdetailmodal').modal('show');
    },
    error: function (xhr, status, error) {
        // Handle error here
        console.error(xhr.responseText);
    }
  });
});



$(document).on('click', '.declineRequest', function (e) {
  $('#bookdetailmodal').modal('hide');
  let bookID = $.trim($(this).data('bookid'));
  let transaction_number = $.trim($(this).data('transaction_number'));
  $('#declineBookingModal').find('input[name="bookID"]').val(bookID);
  $('#declineBookingModal').find('input[name="transaction_number"]').val(transaction_number);
  $('#declineBookingModal').modal('show');
});


// Handle decline booking form submission
$('#declineBookingForm').on('submit', function (e) {
  e.preventDefault();
  let bookID = $(this).find('input[name="bookID"]').val();
  let transaction_number = $(this).find('input[name="transaction_number"]').val();
  let reason = $(this).find('textarea[name="reason"]').val();
  showLoading();
  $.ajax({
      type: "POST",
      url: `/admin/decline-booking`,
      data: {
          bookID: bookID,
          transaction_number: transaction_number,
          reason: reason
      },
      headers: {
          "X-CSRF-TOKEN": csrfToken
      },
      success: function (response) {
          hideLoading();
          $('#declineBookingModal').modal('hide');
          $('#declineBookingForm')[0].reset();
          global_showalert(response.message, 'Cancel success', 'blue');
          bookingTable(); // Refresh the booking table
      },
      error: function (xhr, status, error) {
        hideLoading();
        console.error(xhr.responseText);
        // Handle error here
      }
  });
});

$(document).on('click', '.approveRequest', function (e) { 
  e.preventDefault();
  var bookID = $(this).data('bookid');
  var transactionNumber = $(this).data('transaction_number');
  $.confirm({
    title: 'Confirm Approval',
    content: 'Are you sure you want to approve this booking?',
    buttons: {
        cancel: function() {
            // Do nothing
        },
        confirm: {
            text: 'Approve',
            btnClass: 'btn-primary',
            action: function() {
              showLoading();
              $.ajax({
                url: '/admin/booking/approve',
                method: 'POST',
                data: {
                    _token: csrfToken,
                    bookID: bookID,
                    transaction_number: transactionNumber
                },
                success: function(response) {
                  hideLoading();
                  $('#bookdetailmodal').modal('hide');
                  global_showalert(response.message, 'Approve success', 'blue');
                  bookingTable(); // Refresh the booking table
                },
                error: function (xhr, status, error) {
                    hideLoading();
                    $('#bookdetailmodal').modal('hide');
                    global_showalert(error, "Failed", "red");
                    // Additional error handling here
                },
              });
            }
          }
        }
  });
})