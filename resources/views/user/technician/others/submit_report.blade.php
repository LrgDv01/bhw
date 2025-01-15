<!-- Modal (confirm submit) -->
<div class="modal fade" id="actionModal{{ $farmId }}" tabindex="-1" aria-labelledby="actionModalLabel{{ $farmId }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="actionModalLabel{{ $farmId }}">Confirm Report Submission</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to submit this report?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Later</button>
                <button type="button" class="btn btn-success" onclick="submitReportForm({{ $farmId }})">Yes, Submit now</button>
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

