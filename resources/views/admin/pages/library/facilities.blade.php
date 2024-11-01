<div class="alert alert-warning" role="alert">
    <strong>Note!</strong> This module is for setup of facilities use in visitation
</div>

<div class="row jail-library">
    <div class="col-lg-12 mb-3">
        <div class="card">
            <div class="card-body table-responsive py-3">
                <form id="add_facilities_form" class="row">
                    <div class="col-lg-6">
                        <div class="input-group">
                            <input type="text" name="facilities" placeholder="Enter here..." class="form-control" id="add_facilities">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-sm px-5">
                                Add facilities
                            </button>
                        </div>
                    </div>
                </form>
                
                <table class="table w-100" id="facility_table">
                    <thead>
                        <tr>
                            <th>Facility ID</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="facilitiesActionModal" tabindex="-1" aria-labelledby="facilitiesActionTitle"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="facilitiesActionTitle">Action</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body facitity_action_text">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm rounded-0 btn-dark" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-sm rounded-0 btn-warning" id="confirmFacilityAction">Deactivate</button>
            </div>
        </div>
    </div>
</div>
