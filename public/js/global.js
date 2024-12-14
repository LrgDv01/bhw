var csrfToken = $('meta[name="csrf-token"]').attr("content");
let loadingIndicator;
let status_arr = ['pending','accepted','canceled','declined']
function showLoading() {
    loadingIndicator = $.alert({
        title: `
            <i class="fa fa-circle-notch fa-spin" style="color: green; margin-right: 10px;"></i>
            <span style="color: green;">Loading...</span>`,
        content: '<div style="text-align: center; font-size: 17px; color: #666;">Processing, please wait ...</div>',
        theme: "modern", 
        closeIcon: false,
        backgroundDismiss: true,
        boxWidth: '500px', 
        useBootstrap: false,
        buttons: false, 
        onOpenBefore: function () {
            $('head').append('<style type="text/css"> \
                .jconfirm-box { \
                    border-radius: 20px !important; /* Adjust the border radius here */ \
                } \
                @media (max-width: 768px) { \
                    .jconfirm-box { width: 90% !important; } \
                    .jconfirm-content { font-size: 14px !important; } \
                } \
                @media (max-width: 480px) { \
                    .jconfirm-box { width: 95% !important; } \
                    .jconfirm-content { font-size: 12px !important; } \
                } \
            </style>');
        }
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
            buttons: {
                ok: {
                    text: 'Proceed', 
                    btnClass: 'btn-green', 
                    action: function () {
                        this.close(); 
                    }
                }
            },
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
    $('#userProfileModal').modal('hide');
});