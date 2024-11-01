var csrfToken = $('meta[name="csrf-token"]').attr("content");
let loadingIndicator;
let status_arr = ['pending','approved','canceled','declined']
function showLoading() {
    loadingIndicator = $.alert({
        title: 'Loading...',
        content: 'Please wait...',
        theme: "modern",
        type: 'blue',
        closeIcon: false,
    });
}
function hideLoading() {
    loadingIndicator.close();
}
function global_showalert(msg, title, type, redirectURL = null) {
    if (redirectURL != null) {
        $.alert({
            title: title,
            content: msg,
            type: type,
            theme: "modern",
            onClose: function () {
                window.location.href = redirectURL; // Redirect after the alert is closed
            }
        });
    } else {
        $.alert({
            title: title,
            content: msg,
            type: type,
            theme: "modern",
        });
    }
}

function escapeHtml(unsafe) {
    return unsafe
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}


$(document).on('click', '[data-dismiss="modal"]', function (e) {
    $('#bookdetailmodal').modal('hide');
    $('#declineBookingModal').modal('hide');
    $('#moduleAccessModal').modal('hide');
    $('#userProfileModal').modal('hide');
});