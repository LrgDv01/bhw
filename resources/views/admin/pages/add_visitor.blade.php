@include('admin.partials.__header')
@include('admin.partials.__nav')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Add visitor</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                <li class="breadcrumb-item active">Add visitor</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section announcement">
        <div class="card">
            <div class="card-body p-3">
                <form id="add_visitor_form" method="POST" class="row was-validated" >
                    <div class="col-lg-3 mb-3 d-flex justify-content-center">
                        @php $randomCode = uniqid(); @endphp
                        {!! QrCode::size(200)->generate($randomCode) !!}
                        <input type="hidden" name="qr" value="{{$randomCode}}">
                    </div>
                    <div class="col-lg-9">
                        <input type="hidden" name="pdlID" value="{{ $pdl_id }}">
                        <div class="row">
                            <div class="col-lg-4 mb-3">
                                <div class="mb-3">
                                    <label for="" class="form-label">First Name</label>
                                    <input
                                        type="text"
                                        name="first_name"
                                        id="first_name"
                                        class="form-control rounded rounded-0"
                                        placeholder="type here..."
                                        required
                                    />
                                </div>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <div class="mb-3">
                                    <label for="" class="form-label">Middle Name <small>( optional )</small></label>
                                    <input
                                        type="text"
                                        name="middle_name"
                                        id="middle_name"
                                        class="form-control rounded rounded-0"
                                        placeholder="type here..."
                                    />
                                </div>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <div class="mb-3">
                                    <label for="" class="form-label">Last Name</label>
                                    <input
                                        type="text"
                                        name="last_name"
                                        id="last_name"
                                        class="form-control rounded rounded-0"
                                        placeholder="type here..."
                                        required
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 mb-3">
                                <div class="mb-3">
                                    <label for="" class="form-label">Emall Address</label>
                                    <input
                                        type="email"
                                        name="email"
                                        id="email"
                                        class="form-control rounded rounded-0"
                                        placeholder="type here..."
                                        required
                                    />
                                </div>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <div class="mb-3">
                                    <label for="" class="form-label">New Password</label>
                                    <input
                                        type="password"
                                        name="password"
                                        id="password"
                                        class="form-control rounded rounded-0"
                                        placeholder="type here..."
                                        required
                                    />
                                </div>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <div class="mb-3">
                                    <label for="" class="form-label">Confirm Password</label>
                                    <input
                                        type="password"
                                        name="password_confirmation"
                                        id="password_confirmation"
                                        class="form-control rounded rounded-0"
                                        placeholder="type here..."
                                        required
                                    />
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-4 mb-3">
                                <div class="mb-3">
                                    <label for="" class="form-label">Gender</label>
                                    <select name="gender" class="form-select rounded rounded-0" id="gender" required>
                                        <option value="">Choose</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <div class="mb-3">
                                    <label for="" class="form-label">Contact</label>
                                    <input
                                        type="text"
                                        name="contact"
                                        id="contact"
                                        class="form-control rounded rounded-0"
                                        placeholder="type here..."
                                        required
                                    />
                                </div>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <div class="mb-3">
                                    <label for="position" class="form-label">User Position</label>
                                    <select name="position" id="position" class="form-select rounded rounded-0" required>
                                        <option value="">-- choose --</option>
                                        <option value="Visitor">Visitor</option>
                                        <option value="Doctor">Doctor</option>
                                        <option value="Lawyer">Lawyer</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-8 mb-3">
                                <div class="mb-3">
                                    <label for="" class="form-label">Full Address</label>
                                    <input
                                        type="text"
                                        name="address"
                                        id="address"
                                        class="form-control rounded rounded-0"
                                        placeholder="type here..."
                                        required
                                    />
                                </div>
                            </div>
                            <div class="col-lg-4 mb-3" hidden>
                                <div class="mb-3">
                                    <label for="" class="form-label">Type of account</label>
                                    <select name="user_type" class="form-select rounded rounded-0" id="user_type" required>
                                        <option value="">Choose</option>
                                        <option value="2" selected>Visitor</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    @csrf
                    <div class="text-end">
                        <a href="{{ url('admin/update_pdl/' . $pdl_id) }}" class="btn btn-dark rounded rounded-0">Back</a>
                        <button type="submit" class="btn btn-primary rounded rounded-0">Add visitor</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

</main>

@include('admin.partials.__footer')
