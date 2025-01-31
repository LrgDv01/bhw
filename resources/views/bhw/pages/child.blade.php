@include('bhw.partials.__header')
@include('bhw.partials.__nav')

@extends('layouts.app')

@section('content')
<main id="main" class="main">
    <div class="pagetitle text-center mb-4">
        <h1 class="fw-bold">Child Census</h1>
    </div>
    
    <div class="text-center mb-3">
        <a href="{{ route('bhw.services') }}" class="btn btn-outline-primary">
            &larr; Go to Pregnancy Census
        </a>
    </div>

    <section class="section">
        <div class="container">
            <div class="card shadow-lg p-4">
                <form action="{{ route('child.census.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="house_number" class="form-label fw-bold">No. of House</label>
                        <input type="text" class="form-control" id="house_number" name="house_number" required>
                    </div>

                    <div class="mb-3">
                        <label for="complete_name" class="form-label fw-bold">Complete Name (FN, MN, LN)</label>
                        <input type="text" class="form-control" id="complete_name" name="complete_name" required>
                    </div>

                    <div class="mb-3">
                        <label for="role_in_family" class="form-label fw-bold">Role in the Family</label>
                        <input type="text" class="form-control" id="role_in_family" name="role_in_family" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="dob" class="form-label fw-bold">Date of Birth</label>
                            <input type="date" class="form-control" id="dob" name="dob" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="age" class="form-label fw-bold">Age</label>
                            <input type="text" class="form-control" id="age" name="age" required>
                        </div>
                    </div>

                    <h5 class="fw-bold">Vaccines</h5>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                @php
                                    $vaccines = [
                                        'PCV1' => 'Pneumococcal Vaccines 1 (PCV1)',
                                        'PCV2' => 'Pneumococcal Vaccines 2 (PCV2)',
                                        'PCV3' => 'Pneumococcal Vaccines 3 (PCV3)',
                                        'BCG' => 'Bacillus Calmette-Guérin (BCG)',
                                        'PENTA1' => 'Pentavalent Vaccine 1 (PENTA 1)',
                                        'OPV1' => 'Oral Polio Vaccine 1 (OPV1)',
                                        'PENTA2' => 'Pentavalent Vaccine 2 (PENTA 2)',
                                        'OPV2' => 'Oral Polio Vaccine 2 (OPV2)',
                                        'PENTA3' => 'Pentavalent Vaccine 3 (PENTA 3)',
                                        'OPV3' => 'Oral Polio Vaccine 3 (OPV3)',
                                        'IPV' => 'Inactivated Poliovirus Vaccine (IPV)',
                                        'VitaminA' => 'Vitamin A',
                                        'Measles' => 'Measles',
                                        'MMR' => 'Measles, Mumps, and Rubella (MMR)'
                                    ];
                                @endphp
                                
                                @foreach($vaccines as $key => $label)
                                    <div class="col-md-4 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="vaccines[]" value="{{ $key }}" id="vaccine_{{ $key }}">
                                            <label class="form-check-label" for="vaccine_{{ $key }}">{{ $label }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-success btn-lg">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>
@endsection

@include('bhw.partials.__footer')
