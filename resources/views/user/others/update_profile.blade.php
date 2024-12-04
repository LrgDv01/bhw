<!-- Modal for updating profile -->
<div class="modal fade" id="updateProfileModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Profile</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="updateProfileForm">
        <div class="modal-body"> 
            <div class="mb-3">
              <label for="full_name" class="form-label">Full Name</label>
              <input type="text" class="form-control" id="full_name" placeholder="Enter your full name">
            </div>
          {{--<div class="mb-3">
              <label for="age" class="form-label">Age</label>
              <input type="text" class="form-control" id="age" placeholder="Enter your age">
            </div>
            <div class="mb-3">
              <label for="gender" class="form-label">Gender</label>
              <input type="text" class="form-control" id="gender" placeholder="Enter your gender">
            </div>--}}
            <div class="mb-3">
              <label for="contact" class="form-label">Contact No.</label>
              <input type="text" class="form-control" id="contact" placeholder="Enter your contact number">
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" placeholder="Enter your email">
            </div>
          {{-- <div class="mb-3">
              <label for="district" class="form-label">District</label>
              <input type="text" class="form-control" id="district" placeholder="Enter your district">
            </div>
            <div class="mb-3">
              <label for="municipality" class="form-label">Municipality</label>
              <input type="text" class="form-control" id="municipality" placeholder="Enter your municipality">
            </div>--}}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-success">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
