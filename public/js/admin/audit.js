function audit_table() {    
    let audit_date = $('#audit_date').val();
    $.ajax({
        type: "GET",
        url: "/admin/get_audit",
        headers: {
            "X-CSRF-TOKEN": csrfToken, // Add CSRF token to the request headers
        },
        data: { date: audit_date },
        success: function (response) {
            $("#audit_table").DataTable().destroy();
            var table = $("#audit_table").DataTable({
                responsive: true, // Enable responsiveness
                data: response,
                columns: [
                    { data: "ip_address" },
                    { data: "userID" },
                    { data: "action" },
                    {
                        data: "description",
                        render: function (data, type, row) {
                            if (type === 'display' && data.length > 30) {
                                return `<span data-bs-toggle="tooltip" title="${escapeHtml(data)}">${escapeHtml(data.substr(0, 30))}...</span>`;
                            }
                            return escapeHtml(data);
                        }
                    },
                    {
                        data: "created_at",
                        render: function (data, type, row) {
                            if (type === 'display' || type === 'filter') {
                                return new Date(data).toLocaleDateString();
                            }
                            return data;
                        }
                    },
                    {
                        data: "created_at",
                        render: function (data, type, row) {
                            if (type === 'display' || type === 'filter') {
                                return new Date(data).toLocaleTimeString();
                            }
                            return data;
                        }
                    }
                ],
                order: [5, 'desc'],
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
}

$(document).on('change', '#audit_date', function(e) {
    e.preventDefault();
    audit_table();
});

audit_table();