@include('bhw.partials.__header')
@include('bhw.partials.__nav')
<main id="main" class="main">
    <div class="pagetitle mb-5">
        <h1 class="fs-3"><strong>Settings</strong></h1>
    </div>
    <section class="section settings">
        <div class="container">
            <h4 class="mb-4">Profile</h4>
            <div class="list-group">
  
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <i class="bi bi-person-circle me-2"></i>
                        <strong id="user_name">{{ $user->user_name }}</strong>
                        <div class="text-muted">Username</div>
                    </div>
                    <button class="btn btn-outline-success btn-sm" onclick="editField('user_name', '{{ $user->user_name }}')">
                        <i class="bi bi-arrow-right"></i>
                    </button>
                </div>

                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <i class="bi bi-person-circle me-2"></i>
                        <strong id="fullname">{{ $user->fullname }}</strong>
                        <div class="text-muted">Fullname</div>
                    </div>
                    <button class="btn btn-outline-success btn-sm" onclick="editField('fullname', '{{ $user->fullname }}')">
                        <i class="bi bi-arrow-right"></i>
                    </button>
                </div>

 
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <i class="bi bi-envelope me-2"></i>
                        <strong id="email">{{ $user->email }}</strong>
                        <div class="text-muted">E-mail</div>
                    </div>
                    <button class="btn btn-outline-success btn-sm" onclick="editField('email', '{{ $user->email }}')">
                        <i class="bi bi-arrow-right"></i>
                    </button>
                </div>
            </div>

            <div class="mt-3">
                <button class="btn btn-success w-100" onclick="updateProfile()">Edit Profile</button>
            </div>
        </div>

        <!-- Modal for Editing -->
        <div class="modal fade" id="editFieldModal" tabindex="-1" aria-labelledby="editFieldModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editFieldModalLabel">Edit Field</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="editFieldForm">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" id="fieldName">
                            <div class="mb-3">
                                <label for="fieldValue" class="form-label">Value</label>
                                <input type="text" id="fieldValue" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @include('bhw.others.update_profile')
    </section>
</main>
@include('bhw.partials.__footer')


<script>
    function editField(field, value) {
        document.getElementById('fieldName').value = field;
        document.getElementById('fieldValue').value = value;
        const editModal = new bootstrap.Modal(document.getElementById('editFieldModal'));
        editModal.show();
    }
    function updateProfile() {
        const editModal = new bootstrap.Modal(document.getElementById('updateProfileModal'));
        editModal.show();
    }
</script>