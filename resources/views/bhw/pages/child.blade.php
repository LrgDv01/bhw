@include('bhw.partials.__header')
@include('bhw.partials.__nav')

@extends('layouts.app')

@section('content')
<main id="main" class="main">
    <div class="pagetitle mb-5">
        <h1><strong>Child Census</strong></h1>
        <a href="{{ route('bhw.services') }}" class="btn btn-primary"><-- Go to Pregnancy Census</a>
    </div>

    <section class="section">
        <div class="content">
            <div class="container-fluid">
                <form action="{{ route('child.census.store') }}" method="POST">
                    @csrf

                    <!-- House Information -->
                    <div class="row mb-3">
                        <label for="house_number" class="col-md-3 col-form-label">No. of House</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="house_number" name="house_number" required>
                        </div>
                    </div>

                    <!-- Child's Complete Name -->
                    <div class="row mb-3">
                        <label for="complete_name" class="col-md-3 col-form-label">Complete Name (FN, MN, LN)</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="complete_name" name="complete_name" required>
                        </div>
                    </div>

                    <!-- Child's Role in Family -->
                    <div class="row mb-3">
                        <label for="role_in_family" class="col-md-3 col-form-label">Role in the Family</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="role_in_family" name="role_in_family" required>
                        </div>
                    </div>

                    <!-- Date of Birth -->
                    <div class="row mb-3">
                        <label for="dob" class="col-md-3 col-form-label">Date of Birth</label>
                        <div class="col-md-9">
                            <input type="date" class="form-control" id="dob" name="dob" required>
                        </div>
                    </div>

                    <!-- Age -->
                    <div class="row mb-3">
                        <label for="age" class="col-md-3 col-form-label">Age</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="age" name="age" required>
                        </div>
                    </div>

                    <!-- Vaccine Checkboxes -->
                    <h5 class="mb-3">Vaccines</h5>
                    <div class="row mb-3">
                        <div class="col-md-9 offset-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="vaccines[]" value="PCV1">
                                <label class="form-check-label">Pneumococcal Vaccines 1 (PCV1)</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="vaccines[]" value="PCV2">
                                <label class="form-check-label">Pneumococcal Vaccines 2 (PCV2)</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="vaccines[]" value="PCV3">
                                <label class="form-check-label">Pneumococcal Vaccines 3 (PCV3)</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="vaccines[]" value="BCG">
                                <label class="form-check-label">Bacillus Calmette-Guérin (BCG)</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="vaccines[]" value="PENTA1">
                                <label class="form-check-label">Pentavalent Vaccine 1 (PENTA 1)</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="vaccines[]" value="OPV1">
                                <label class="form-check-label">Oral Polio Vaccine 1 (OPV1)</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="vaccines[]" value="PENTA2">
                                <label class="form-check-label">Pentavalent Vaccine 2 (PENTA 2)</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="vaccines[]" value="OPV2">
                                <label class="form-check-label">Oral Polio Vaccine 2 (OPV2)</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="vaccines[]" value="PENTA3">
                                <label class="form-check-label">Pentavalent Vaccine 3 (PENTA 3)</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="vaccines[]" value="OPV3">
                                <label class="form-check-label">Oral Polio Vaccine 3 (OPV3)</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="vaccines[]" value="IPV">
                                <label class="form-check-label">Inactivated Poliovirus Vaccine (IPV)</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="vaccines[]" value="VitaminA">
                                <label class="form-check-label">Vitamin A</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="vaccines[]" value="Measles">
                                <label class="form-check-label">Measles</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="vaccines[]" value="MMR">
                                <label class="form-check-label">Measles, Mumps, and Rubella (MMR)</label>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="row mb-3">
                        <div class="col-md-9 offset-md-3">
                            <button type="submit" class="btn btn-success btn-lg">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>
@endsection

@include('bhw.partials.__footer')
