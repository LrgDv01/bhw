<div
  class="alert alert-warning"
  role="alert"
>
  <strong>Note!</strong> This module is for Person Deprived of Liberty records 
</div>

<form class="row jail-library">
  <div class="col-lg-12 mb-3">
    <div class="card">
      <div class="card-body table-responsive py-3">
        <!-- Add Filter Section -->
        <div class="row mb-3">
          <div class="col-md-4">
            <label for="genderFilter">Filter by Gender</label>
            <select id="genderFilter" class="form-control">
              <option value="">All</option>
              <option value="Male">Male</option>
              <option value="Female">Female</option>
            </select>
          </div>
          <div class="col-md-4">
            <label for="crimeCategoryFilter">Filter by Crime Category</label>
            <select id="crimeCategoryFilter" class="form-control">
              <option value="">All</option>
              <option value="theft">Theft</option>
              <option value="robbery">Robbery</option>
              <option value="assault">Assault</option>
              <option value="murder">Murder</option>
              <option value="cybercrime">Cybercrime</option>
              <option value="drug-related">Drug-Related</option>
              <option value="homicide">Homicide</option>
              <option value="kidnapping">Kidnapping</option>
              <option value="rape">Rape</option>
              <option value="fraud">Fraud</option>
              <option value="domestic-violence">Domestic Violence</option>
            </select>
          </div>
          <div class="col-md-4 d-flex align-items-end justify-content-between">
            <button id="filterBtn" class="btn btn-primary me-3">Filter</button>
            <div class="text-end">
              <a
                href="{{ url('/admin/add_pdl') }}"
                class="btn btn-success"
              >
                Add PDL
              </a>
            </div>
          </div>
        </div>
        
        
        <table class="table" id="pdl_table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Gender</th>
              <th>Crime Category</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
    </div>
  </div>
</form>
