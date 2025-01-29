@include('bhw.partials.__header')
@include('bhw.partials.__nav')

<main id="main" class="main">
    <div class="pagetitle text-center mb-5">
        <h1 class="fw-bold">Mother Census Data</h1>
    </div>

    <div class="container shadow p-5 rounded bg-light">
        <h3>{{ $familyMember->full_name }}'s Data</h3>
        <div class="row">
            <div class="col-md-6"><strong>House No:</strong> {{ $familyMember->house_no }}</div>
            <div class="col-md-6"><strong>Role in Family:</strong> {{ $familyMember->role }}</div>
            <div class="col-md-6"><strong>Date of Birth:</strong> {{ $familyMember->dob }}</div>
            <div class="col-md-6"><strong>Age:</strong> {{ $familyMember->age }}</div>
            <div class="col-md-6"><strong>4P's Member:</strong> {{ $familyMember->is_4ps }}</div>
            <div class="col-md-6"><strong>Senior Citizen:</strong> {{ $familyMember->is_senior_citizen }}</div>
            <div class="col-md-6"><strong>Pregnant:</strong> {{ $familyMember->is_pregnant }}</div>
            <div class="col-md-6"><strong>Pregnancy Months:</strong> {{ $familyMember->pregnancy_months }}</div>
            <div class="col-md-6"><strong>Birth Plan:</strong> {{ $familyMember->birth_plan }}</div>
            <div class="col-md-6"><strong>Civil Status:</strong> {{ $familyMember->civil_status }}</div>
            <div class="col-md-6"><strong>Next Visit to Midwife:</strong> {{ $familyMember->next_visit }}</div>
            <div class="col-md-6"><strong>Family Planning Method:</strong> {{ $familyMember->family_planning_method }}</div>
            <div class="col-md-6"><strong>Registered Voter:</strong> {{ $familyMember->is_registered_voter }}</div>
            <div class="col-md-6"><strong>Own Toilet:</strong> {{ $familyMember->own_toilet }}</div>
            <div class="col-md-6"><strong>Clean Water:</strong> {{ $familyMember->clean_water }}</div>
            <div class="col-md-6"><strong>Hypertension:</strong> {{ $familyMember->hypertension }}</div>
            <div class="col-md-6"><strong>Next Visit Clinic:</strong> {{ $familyMember->next_visit_clinic }}</div>
            <div class="col-md-6"><strong>TB Symptoms:</strong> {{ $familyMember->has_tb_symptoms }}</div>
            <div class="col-md-6"><strong>Sputum Test:</strong> {{ $familyMember->sputum_test }}</div>
            <div class="col-md-6"><strong>Sputum Result:</strong> {{ $familyMember->sputum_result }}</div>
            <div class="col-md-6"><strong>Treatment Partner:</strong> {{ $familyMember->treatment_partner }}</div>
            <div class="col-md-6"><strong>Next Checkup:</strong> {{ $familyMember->next_checkup }}</div>
        </div>
        <!-- Back Button -->
        <div class="mt-4">
            <a href="{{ route('bhw.pages.list') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
</main>

@include('bhw.partials.__footer')
