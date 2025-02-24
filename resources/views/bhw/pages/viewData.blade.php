@include('bhw.partials.__header')
@include('admin.partials.__nav')

<main id="main" class="main">

    <div class="pagetitle text-center mb-5">
        <h1 class="fw-bold">Mother Census Data</h1>
    </div>
    <div class="mt-4 text-left">
        <a href="{{ route('bhw.pages.list') }}" class="btn btn-secondary">Back</a>
        <button class="btn btn-primary" onclick="printDiv('printableArea')">Print</button>
    </div>
    <div class="mt-4 text-left">
    </div>
    <div class="container shadow p-5 rounded bg-light" id="printableArea">
        <h3>{{ $familyMember->first_name }} {{ $familyMember->last_name }}'s Data</h3>
        <div class="row">
            <div class="col-md-6"><strong>House No:</strong> {{ $familyMember->house_no }}</div>
            <div class="col-md-6"><strong>Role in Family:</strong> {{ $familyMember->role_in_family }}</div>
            <div class="col-md-6"><strong>Date of Birth:</strong> {{ $familyMember->date_of_birth }}</div>
            <div class="col-md-6"><strong>Age:</strong> {{ $familyMember->age }}</div>
            <div class="col-md-6"><strong>4P's Member:</strong> {{ $familyMember->four_ps_member }}</div>
            <div class="col-md-6"><strong>Senior Citizen:</strong> {{ $familyMember->senior_citizen }}</div>
            <div class="col-md-6"><strong>Pregnant:</strong> {{ $familyMember->pregnant }}</div>
            <div class="col-md-6"><strong>Pregnancy Months:</strong> {{ $familyMember->months_pregnant }}</div>
            <div class="col-md-6"><strong>Birth Plan:</strong> {{ $familyMember->birth_plan }}</div>
            <div class="col-md-6"><strong>Civil Status:</strong> {{ $familyMember->civil_status }}</div>
            <div class="col-md-6"><strong>Next Visit to Midwife:</strong> {{ $familyMember->next_midwife_visit }}</div>
            <div class="col-md-6"><strong>Family Planning Method:</strong> {{ $familyMember->family_planning }}</div>
            <div class="col-md-6"><strong>Registered Voter:</strong> {{ $familyMember->registered_voter }}</div>
            <div class="col-md-6"><strong>Own Toilet:</strong> {{ $familyMember->own_toilet }}</div>
            <div class="col-md-6"><strong>Clean Water:</strong> {{ $familyMember->clean_water_source }}</div>
            <div class="col-md-6"><strong>Hypertension:</strong> {{ $familyMember->hypertension_experience }}</div>
            <div class="col-md-6"><strong>TB Symptoms:</strong> {{ $familyMember->tb_symptoms }}</div>
            <div class="col-md-6"><strong>Next Visit Clinic:</strong> {{ $familyMember->next_clinic_visit }}</div>
            <div class="col-md-6"><strong>Sputum Test:</strong> {{ $familyMember->sputum_test }}</div>
            <div class="col-md-6"><strong>Treatment Partner:</strong> {{ $familyMember->tb_treatment_partner }}</div>
            <div class="col-md-6"><strong>Sputum Result:</strong> {{ $familyMember->sputum_result }}</div>
            <div class="col-md-6"><strong>Next Checkup:</strong> {{ $familyMember->next_checkup }}</div>
        </div>
    </div>
</main>

@include('bhw.partials.__footer')

<script>
    function printDiv(divId) {
        var printContents = document.getElementById(divId).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        location.reload();
    }
</script>
