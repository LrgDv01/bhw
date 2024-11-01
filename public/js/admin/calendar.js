var blockedDates = [];
var slotDates = [];
var calendar;
var slot_calendar;
var onsiteCalendar;
var virtualCalendar;
$(document).ready(function () {
    $.ajax({
        url: "/admin/get-dates",
        type: "GET",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (response) {
            blockedDates = response.block;
            slotDates = response.slots;
            renderCalendar();
            slotrenderCalendar();
            renderOnsiteCalendar();
            renderVirtualCalendar();
        },
        error: function (error) {
            console.log("Error fetching blocked dates:", error);
        },
    });
});
function renderCalendar() {
    if ($("#calendar").fullCalendar('getCalendar')) {
        $("#calendar").fullCalendar('destroy');
    }
    calendar = $("#calendar").fullCalendar({
        plugins: ["dayGrid", "timeGrid", "interaction", "list"],
        initialView: "dayGridMonth",
        selectable: true,
        events: "/admin/events",
        eventRender: function (event, element) {
            if (event.title.toLowerCase() === "blocked") {
                element.addClass("fs-1");
                element.addClass("d-flex");
                element.addClass("justify-content-center");
                element.addClass("align-items-center");
                element.find(".fc-title").html('<i class="fas fa-ban"></i>'); // Set only the icon
            }
            element.find(".fc-time").remove();
            element.find(".fc-title").addClass("text-wrap");
            element.attr("title", event.title);
            element.tooltip({
                container: "body",
                placement: "top",
            });
        },
        dayRender: function (date, cell) {
            if (blockedDates.includes(date.format("YYYY-MM-DD"))) {
                $('td[data-date="' + date.format("YYYY-MM-DD") + '"]').css(
                    "background-color",
                    "red"
                );
                $('td[data-date="' + date.format("YYYY-MM-DD") + '"]').css(
                    "color",
                    "white"
                );
            } else if (slotDates.includes(date.format("YYYY-MM-DD"))) {
                $('td[data-date="' + date.format("YYYY-MM-DD") + '"]').css(
                    "background-color",
                    "blue"
                );
                $('td[data-date="' + date.format("YYYY-MM-DD") + '"]').css(
                    "color",
                    "white"
                );
            }
        },
        select: function (start, end, allDay) {
            var selectedDates = [];
            var currentDate = start;
            var hasEvent = false;
            var hasEvent1 = false;
            
            // Check for events on the selected dates
            $('#slot_calendar').fullCalendar('clientEvents', function (event) {
              if (
                  (event.start.format("YYYY-MM-DD") >= start.format("YYYY-MM-DD") && event.start.format("YYYY-MM-DD") < end.format("YYYY-MM-DD")) ||
                  (event.end && event.end.format("YYYY-MM-DD") > start.format("YYYY-MM-DD") && event.end.format("YYYY-MM-DD") <= end.format("YYYY-MM-DD"))
              ) {
                  hasEvent = true;
                  return true;
              }
            });
            $('#calendar').fullCalendar('clientEvents', function (event) {
              if (
                  (event.start.format("YYYY-MM-DD") >= start.format("YYYY-MM-DD") && event.start.format("YYYY-MM-DD") < end.format("YYYY-MM-DD")) ||
                  (event.end && event.end.format("YYYY-MM-DD") > start.format("YYYY-MM-DD") && event.end.format("YYYY-MM-DD") <= end.format("YYYY-MM-DD"))
              ) {
                  hasEvent1 = true;
                  return true;
              }
            });
  
            if (hasEvent || hasEvent1) {
                global_showalert("Selected dates have existing events and cannot be selected.", "Error!", "red");
                return;
            }
      
            // Check if the end date is exactly one day after the start date
            if (
                start.format("YYYY-MM-DD") ===
                end.subtract(1, "days").format("YYYY-MM-DD")
            ) {
                selectedDates.push(start.format("YYYY-MM-DD"));
            } else {
                currentDate = start;
                while (currentDate < end) {
                    selectedDates.push(currentDate.format("YYYY-MM-DD"));
                    currentDate.add(1, "days");
                }
                // Add the end date to the array
                selectedDates.push(end.format("YYYY-MM-DD"));
            }
            console.log("Selected dates:", selectedDates);
            $.confirm({
                title: "Confirm Date Block",
                content: "Do you want to block these dates?",
                buttons: {
                    cancel: function () {
                        // Close the modal
                    },
                    confirm: {
                        text: "Confirm",
                        btnClass: "btn-blue",
                        action: function () {
                            // Process the additional data
                            $.ajax({
                                url: "/admin/block-dates", // Replace with your save URL
                                type: "POST",
                                data: {
                                    dates: selectedDates,
                                    _token: $(
                                        'meta[name="csrf-token"]'
                                    ).attr("content"),
                                },
                                success: function (response) {
                                    calendar.fullCalendar("refetchEvents");
                                    slot_calendar.fullCalendar(
                                        "refetchEvents"
                                    );
                                    // Block the selected dates on the calendar
                                    selectedDates.forEach(function (date) {
                                        $(
                                            'td[data-date="' + date + '"]'
                                        ).css("background-color", "red");
                                        $(
                                            'td[data-date="' + date + '"]'
                                        ).css("color", "white");
                                    });
                                    global_showalert(
                                        "Dates saved successfully!",
                                        "Success!",
                                        "green"
                                    );
                                },
                                error: function (error) {
                                    global_showalert(
                                        "Error saving dates.",
                                        "Error!",
                                        "red"
                                    );
                                    console.log(error);
                                },
                            });
                        },
                    },
                },
                onContentReady: function () {
                    // Bind the form using jQuery
                    var jc = this;
                    this.$content.find("form").on("submit", function (e) {
                        // If the user submits the form by pressing enter in the field.
                        e.preventDefault();
                        jc.$$formSubmit.trigger("click"); // reference the button and click it
                    });
                },
            });
        },
        eventClick: function (info) {
            let date = info.start;
            date = date.format("YYYY-MM-DD");
            $.confirm({
                title: "Confirm Event Deletion",
                content: "Are you sure you want to delete this event?",
                buttons: {
                    cancel: {
                        text: "Cancel",
                        btnClass: "btn-blue",
                    },
                    confirm: {
                        text: "Confirm",
                        btnClass: "btn-red",
                        action: function () {
                            // Send an AJAX request to delete the event
                            $.ajax({
                                url: "/admin/delete-event",
                                type: "POST",
                                data: {
                                    id: info.id, // Assuming you have an 'id' attribute for each event
                                    _token: $(
                                        'meta[name="csrf-token"]'
                                    ).attr("content"),
                                },
                                success: function (response) {
                                    // Remove the event from the calendar
                                    $("#calendar").fullCalendar(
                                        "removeEvents",
                                        info.id
                                    );
                                    $("#slot_calendar").fullCalendar(
                                        "removeEvents",
                                        info.id
                                    );
                                    $('td[data-date="' + date + '"]').css(
                                        "background-color",
                                        "white"
                                    );
                                    $('td[data-date="' + date + '"]').css(
                                        "color",
                                        "black"
                                    );
                                    // Show success message
                                    global_showalert(
                                        "Event deleted successfully!",
                                        "Success",
                                        "green"
                                    );
                                },
                                error: function (xhr, status, error) {
                                    // Show error message
                                    global_showalert(
                                        "Failed to delete event. Please try again.",
                                        "Failed",
                                        "red"
                                    );
                                    console.error(
                                        "An error occurred: " +
                                            status +
                                            " - " +
                                            error
                                    );
                                },
                            });
                        },
                    },
                },
            });
        },
    });
}

function slotrenderCalendar() {
    if ($("#slot_calendar").fullCalendar('getCalendar')) {
        $("#slot_calendar").fullCalendar('destroy');
    }
    slot_calendar = $("#slot_calendar").fullCalendar({
        plugins: ["dayGrid", "timeGrid", "interaction", "list"],
        initialView: "dayGridMonth",
        selectable: true,
        events: "/admin/events",
        eventRender: function (event, element) {
            if (event.title.toLowerCase() === "blocked") {
                element.addClass("fs-1");
                element.addClass("d-flex");
                element.addClass("justify-content-center");
                element.addClass("align-items-center");
                element.find(".fc-title").html('<i class="fas fa-ban"></i>'); // Set only the icon
            }
            element.find(".fc-time").remove();
            element.find(".fc-title").addClass("text-wrap");
            element.attr("title", event.title);
            element.tooltip({
                container: "body",
                placement: "top",
            });
        },
        dayRender: function (date, cell) {
            if (blockedDates.includes(date.format("YYYY-MM-DD"))) {
                $('td[data-date="' + date.format("YYYY-MM-DD") + '"]').css(
                    "background-color",
                    "red"
                );
                $('td[data-date="' + date.format("YYYY-MM-DD") + '"]').css(
                    "color",
                    "white"
                );
            } else if (slotDates.includes(date.format("YYYY-MM-DD"))) {
                $('td[data-date="' + date.format("YYYY-MM-DD") + '"]').css(
                    "background-color",
                    "blue"
                );
                $('td[data-date="' + date.format("YYYY-MM-DD") + '"]').css(
                    "color",
                    "white"
                );
            }
        },
        select: function (start, end, allDay) {
            var selectedDates = [];
            var currentDate = start;
            var hasEvent = false;
            var hasEvent1 = false;
            
            // Check for events on the selected dates
            $('#slot_calendar').fullCalendar('clientEvents', function (event) {
              if (
                  (event.start.format("YYYY-MM-DD") >= start.format("YYYY-MM-DD") && event.start.format("YYYY-MM-DD") < end.format("YYYY-MM-DD")) ||
                  (event.end && event.end.format("YYYY-MM-DD") > start.format("YYYY-MM-DD") && event.end.format("YYYY-MM-DD") <= end.format("YYYY-MM-DD"))
              ) {
                  hasEvent = true;
                  return true;
              }
            });
            $('#calendar').fullCalendar('clientEvents', function (event) {
              if (
                  (event.start.format("YYYY-MM-DD") >= start.format("YYYY-MM-DD") && event.start.format("YYYY-MM-DD") < end.format("YYYY-MM-DD")) ||
                  (event.end && event.end.format("YYYY-MM-DD") > start.format("YYYY-MM-DD") && event.end.format("YYYY-MM-DD") <= end.format("YYYY-MM-DD"))
              ) {
                  hasEvent1 = true;
                  return true;
              }
            });
  
            if (hasEvent || hasEvent1) {
                global_showalert("Selected dates have existing events and cannot be selected.", "Error!", "red");
                return;
            }
      
            function createFormContent(dates) {
                let content = '<form id="slotForm">';
                dates.forEach(function (date) {
                    content += `
                    <div class="mb-3">
                        <label for="slots_${date}">Number of slots for ${date}:</label>
                        <div class="row w-100">
                          <div class="col-lg-6 mb-1">
                            F2F visit slot:
                            <input type="number" class="form-control" placeholder="Enter any value..." id="slots_${date}" name="slots[${date}]" min="1" required>
                          </div>
                          <div class="col-lg-6 mb-1">
                            Virtual visit slot:
                            <input type="number" class="form-control" placeholder="Enter any value..." id="slots_virtual${date}" name="virtualslot[${date}]" min="1" required>
                          </div>
                        </div>
                    </div>
                `;
                });
                content += "</form>";
                return content;
            }

            // Check if the end date is exactly one day after the start date
            if (
                start.format("YYYY-MM-DD") ===
                end.subtract(1, "days").format("YYYY-MM-DD")
            ) {
                selectedDates.push(start.format("YYYY-MM-DD"));
            } else {
                currentDate = start;
                while (currentDate < end) {
                    selectedDates.push(currentDate.format("YYYY-MM-DD"));
                    currentDate.add(1, "days");
                }
                // Add the end date to the array
                selectedDates.push(end.format("YYYY-MM-DD"));
            }
            console.log("Selected dates:", selectedDates);
            $.confirm({
                title: "Confirm Date Slot",
                content: createFormContent(selectedDates),
                buttons: {
                    cancel: function () {
                        // Close the modal
                    },
                    confirm: {
                        text: "Confirm",
                        btnClass: "btn-blue",
                        action: function () {
                            var slotsData = {};
                            var slotsDataVirtual = {};
                            selectedDates.forEach(function (date) {
                                slotsData[date] = $("#slots_" + date).val();
                                slotsDataVirtual[date] = $(
                                    "#slots_virtual" + date
                                ).val();
                                $('td[data-date="' + date + '"]').css(
                                    "background-color",
                                    "blue"
                                );
                                $('td[data-date="' + date + '"]').css(
                                    "color",
                                    "white"
                                );
                            });
                            // Process the additional data
                            $.ajax({
                                url: "/admin/slot-dates", // Replace with your save URL
                                type: "POST",
                                headers: {
                                    "X-CSRF-TOKEN": $(
                                        'meta[name="csrf-token"]'
                                    ).attr("content"),
                                },
                                data: {
                                    slots: slotsData,
                                    virtualslot: slotsDataVirtual,
                                    _token: $(
                                        'meta[name="csrf-token"]'
                                    ).attr("content"),
                                },
                                success: function (response) {
                                    calendar.fullCalendar("refetchEvents");
                                    slot_calendar.fullCalendar(
                                        "refetchEvents"
                                    );
                                    global_showalert(
                                        "Date slots saved successfully!",
                                        "Success!",
                                        "green"
                                    );
                                },
                                error: function (error) {
                                    global_showalert(
                                        "Error saving date slots.",
                                        "Error!",
                                        "red"
                                    );
                                    console.log(error);
                                },
                            });
                        },
                    },
                },
                onContentReady: function () {
                    // Bind the form using jQuery
                    var jc = this;
                    this.$content.find("form").on("submit", function (e) {
                        // If the user submits the form by pressing enter in the field.
                        e.preventDefault();
                        jc.$$formSubmit.trigger("click"); // reference the button and click it
                    });
                },
            });
        },
        eventClick: function (info) {
            let date = info.start;
            date = date.format("YYYY-MM-DD");
            $.confirm({
                title: "Confirm Event Deletion",
                content: "Are you sure you want to delete this event?",
                buttons: {
                    cancel: {
                        text: "Cancel",
                        btnClass: "btn-blue",
                    },
                    confirm: {
                        text: "Confirm",
                        btnClass: "btn-red",
                        action: function () {
                            // Send an AJAX request to delete the event
                            $.ajax({
                                url: "/admin/delete-event",
                                type: "POST",
                                data: {
                                    id: info.id, // Assuming you have an 'id' attribute for each event
                                    _token: $(
                                        'meta[name="csrf-token"]'
                                    ).attr("content"),
                                },
                                success: function (response) {
                                    // Remove the event from the calendar
                                    $("#calendar").fullCalendar(
                                        "removeEvents",
                                        info.id
                                    );
                                    $("#slot_calendar").fullCalendar(
                                        "removeEvents",
                                        info.id
                                    );
                                    $('td[data-date="' + date + '"]').css(
                                        "background-color",
                                        "white"
                                    );
                                    $('td[data-date="' + date + '"]').css(
                                        "color",
                                        "black"
                                    );
                                    // Show success message
                                    global_showalert(
                                        "Event deleted successfully!",
                                        "Success",
                                        "green"
                                    );
                                },
                                error: function (xhr, status, error) {
                                    // Show error message
                                    global_showalert(
                                        "Failed to delete event. Please try again.",
                                        "Failed",
                                        "red"
                                    );
                                    console.error(
                                        "An error occurred: " +
                                            status +
                                            " - " +
                                            error
                                    );
                                },
                            });
                        },
                    },
                },
            });
        },
    });
}

function renderOnsiteCalendar() { 
    if ($("#onsiteCalendar").fullCalendar('getCalendar')) {
        $("#onsiteCalendar").fullCalendar('destroy');
    }
    onsiteCalendar = $('#onsiteCalendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'listMonth,agendaWeek,agendaDay'
        },
        initialView: "dayGridMonth",
        defaultView: 'listMonth', // Set the default view to listMonth
        selectable: true,
        events: function(start, end, timezone, callback) {
            $.ajax({
                url: "/admin/calendarbook",
                data: {
                    type: "Physical"
                },
                dataType: 'json',
                success: function(data) {
                    callback(data); // Pass the event data to the callback
                },
                error: function() {
                    console.error('Failed to fetch events');
                }
            });
        },
        eventRender: function (event, element) {
            element.css("cursor", "pointer");
            element.find(".fc-time").remove();
            element.find(".fc-title").addClass("text-wrap");
            element.find(".fc-title").addClass("text-dark");
            element.attr("title", event.title);
            element.tooltip({
                container: "body",
                placement: "top",
            });

            // Remove element with class fc-list-item-time
            element.find('.fc-list-item-time').remove();
            element.on('click', function() {
                let bookID = event.id; // Assuming `id` is the bookID
                let transaction_number = event.title; // Assuming `title` holds the transaction number
                $.ajax({
                    type: "GET",
                    url: `/admin/bookingdetails/${transaction_number}/${bookID}`,
                    success: function(response) {
                        $('#bookdetailmodal .modal-dialog').html(response);
                        $('#bookdetailmodal').modal('show');
                    },
                    error: function(xhr, status, error) {
                        // Handle error here
                        console.error(xhr.responseText);
                    }
                });
            });
        },
    });
}
function renderVirtualCalendar() { 
    if ($("#virtualCalendar").fullCalendar('getCalendar')) {
        $("#virtualCalendar").fullCalendar('destroy');
    }
    virtualCalendar = $('#virtualCalendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'listMonth,agendaWeek,agendaDay'
        },
        initialView: "dayGridMonth",
        defaultView: 'listMonth', // Set the default view to listMonth
        selectable: true,
        events: function(start, end, timezone, callback) {
            $.ajax({
                url: "/admin/calendarbook",
                data: {
                    type: "Virtual"
                },
                dataType: 'json',
                success: function(data) {
                    callback(data); // Pass the event data to the callback
                },
                error: function() {
                    console.error('Failed to fetch events');
                }
            });
        },
        eventRender: function (event, element) {
            element.css("cursor", "pointer");
            element.find(".fc-time").remove();
            element.find(".fc-title").addClass("text-wrap");
            element.find(".fc-title").addClass("text-dark");
            element.attr("title", event.title);
            element.tooltip({
                container: "body",
                placement: "top",
            });

            // Remove element with class fc-list-item-time
            element.find('.fc-list-item-time').remove();
            element.on('click', function() {
                let bookID = event.id; // Assuming `id` is the bookID
                let transaction_number = event.title; // Assuming `title` holds the transaction number
                $.ajax({
                    type: "GET",
                    url: `/admin/bookingdetails/${transaction_number}/${bookID}`,
                    success: function(response) {
                        $('#bookdetailmodal .modal-dialog').html(response);
                        $('#bookdetailmodal').modal('show');
                    },
                    error: function(xhr, status, error) {
                        // Handle error here
                        console.error(xhr.responseText);
                    }
                });
            });
        },
    });
}