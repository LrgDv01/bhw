@include('admin.partials.__header')
@include('admin.partials.__nav')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Add PDL</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                <li class="breadcrumb-item active">Add PDL</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section announcement">
        <div class="card">
            <div class="card-body p-3">
                <form id="add_pdl_form" method="POST" class="was-validated">
                    <div class="row">
                        <div class="col-lg-3 mb-3">
                            <div class="bg-white">
                                <img src="{{ asset('img/no-image-icon-4.png') }}" id="preview_profile_img"
                                    class="img-fluid w-100" style="object-fit: cover; onject-possition:center;height:350px"
                                    alt="banner">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">PDL img (jpeg, jpg, png) format</label>
                                <input
                                    type="file"
                                    name="pdl_img"
                                    id="pdl_img"
                                    accept="image/*"
                                    class="form-control rounded rounded-0"
                                    required
                                />
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="row p-0 m-0">
                                <div class="col-lg-6 mb-3">
                                    <div class="mb-3">
                                        <label for="" class="form-label">PDL ID</label>
                                        <input
                                            type="text"
                                            name="pdl_id"
                                            id="pdl_id"
                                            class="form-control rounded rounded-0"
                                            placeholder="type here..."
                                            required
                                        />
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Name</label>
                                        <input
                                            type="text"
                                            name="name"
                                            id="name"
                                            class="form-control rounded rounded-0"
                                            placeholder="type here..."
                                            required
                                        />
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <div class="mb-3">
                                      <label for="" class="form-label">Gender</label>
                                      <select
                                        class="form-select"
                                        name="gender"
                                        id="gender"
                                        required
                                      >
                                        <option value="">Select one</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                      </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Birth day</label>
                                        <input
                                            type="date"
                                            name="birthday"
                                            id="birthday"
                                            class="form-control rounded rounded-0"
                                            placeholder="type here..."
                                            required
                                        />
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <div class="form-group">
                                        <label for="crimeCategory">Select Crime Category</label>
                                        <select class="form-control" name="crimeCategory" id="crimeCategory" required>
                                          <option value="">-- Select Crime Category --</option>
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
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <div class="form-group">
                                        <label for="crimeCategory">Specify Case</label>
                                        <input type="text" class="form-control" name="specify_case" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @csrf
                </form>
            </div>
            <div class="card-footer border-0">
                <div class="text-end">
                    <button type="submit" form="add_pdl_form" class="btn btn-primary rounded rounded-0">Add data</button>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="pdlActionModal" tabindex="-1" aria-labelledby="pdlActionModalTitle"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pdlActionModalTitle">Action</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pdl_text_action">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-warning" id="confirmFacilityAction">Deactivate</button>
                </div>
            </div>
        </div>
    </div>
</main>

@include('admin.partials.__footer')
