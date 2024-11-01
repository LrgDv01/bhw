@include('admin.partials.__header')
@include('admin.partials.__nav')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Add account</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                <li class="breadcrumb-item active">Add account</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section announcement">
        <div class="card">
            <div class="card-body p-3">
                <form id="add_account_form" method="POST" class="was-validated">
                    <input type="hidden" name="qr" value="{{ $randomCode = uniqid() }}">
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
                        <div class="col-lg-4 mb-3">
                            <div class="mb-3">
                                <label for="" class="form-label">Gender</label>
                                <select name="gender" class="form-select rounded rounded-0" id="" required>
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
                        <div class="col-lg-4 mb-3">
                            <div class="mb-3">
                                <label for="" class="form-label">Type of account</label>
                                <select name="user_type" class="form-select rounded rounded-0" id="" required>
                                    <option value="">Choose</option>
                                    <option value="1">Personel</option>
                                    <option value="2">Visitor</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    @csrf
                    @if(Session::has('success'))
                    <div class="alert alert-success mb-3">
                        {{ Session::get('success') }}
                    </div>
                    @endif
                    @if(Session::has('error'))
                        <div class="alert alert-danger mb-3">
                            {{ Session::get('error') }}
                        </div>
                    @endif
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary rounded rounded-0">Add account</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

</main>

@include('admin.partials.__footer')
