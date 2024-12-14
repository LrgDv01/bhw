<!-- Modal -->
<div class="modal fade" id="actionModal" tabindex="-1" aria-labelledby="actionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="actionModalLabel">Confirm Action</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="actionModalBody">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="actionForm" method="POST">
                    @csrf
                    <button type="submit" class="btn" id="actionSubmitBtn" data-bs-dismiss="modal">
                        <i class="bi"></i> Yes
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center">
            <div class="modal-body">
                <h5 class="modal-title mb-3" id="successMessage"></h5>
                <div class="mb-3">
                    <i class="bi bi-check-circle-fill text-success fs-1"></i>
                </div>
                <div class="d-flex justify-content-center">
                    <a href="{{ route('user.notifications') }}" class="btn btn-success mx-2">Go Back to Notifications</a>
                    <button type="button" class="btn btn-secondary mx-2" data-bs-dismiss="modal">Close Modal</button>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
   $('#actionForm').on('submit', function (event) {
        event.preventDefault(); 
        var form = $(this);
        var url = form.attr('action');
        var data = form.serialize();

        $.ajax({
            method: 'POST',
            url: url,
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function () {
                $('#actionSubmitBtn').prop('disabled', true).text('Processing...');
            },
            success: function (response) {
                $('#actionModal').modal('hide');
                $('#successMessage').text(response.message);

                setTimeout(function () {
                    $('#successModal').modal('show');
                }, 300); 
            },
            error: function (xhr, status, error) {
                console.error('An error occurred:', error);
                alert('An error occurred. Please try again.');
            },
            complete: function () {
                $('#actionSubmitBtn').prop('disabled', false).text('Yes');
            }
        });
    });
</script>
