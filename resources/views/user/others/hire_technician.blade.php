<!-- Modal for Viewing More Info -->
<div class="modal fade" id="hireTechnicianModal" tabindex="-1" aria-labelledby="hireTechnicianModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hireTechnicianModalLabel">Confirm Technician Hire</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body"> 
                <p>Are you sure you want to hire  <strong><span id="hire"></span> </strong>?</p>
                <input type="hidden" id="technicianId" value="">
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" id="confirmHireButton">Confirm</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const hireTechnicianModal = document.getElementById('hireTechnicianModal');

        // When the modal is about to be shown
        hireTechnicianModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget; 
            const technicianName = button.getAttribute('data-name');
            const technicianId = button.getAttribute('data-id');

            // Update modal content dynamically
            document.getElementById('hire').textContent = technicianName || 'Unknown';
            document.getElementById('technicianId').value = technicianId || '';
        });
    });

</script>
