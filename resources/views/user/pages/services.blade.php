@include('user.partials.__header')
@include('user.partials.__nav')
<main id="main" class="main">
    <section class="section services">
        <div class="container">
            <div class="position-fixed bg-white text-center" 
                style="top:6%; right:0; left:0; z-index: 995; width: 100%;">
                <h2 class="py-2 mt-2">Coconut Technicians</h2>
            </div>
            <!-- Spacer to prevent content overlap -->
            <div style="margin-top: 50px;">
            </div>
            <!-- Farm Cards -->
            <div id="farm-list">
                <ul class="list-unstyled">
                    @foreach($technicians as $technician)
                        <li class="card mb-2">
                            <div class="card-body">
                                <div>
                                    <h5 class="card-title p-0">{{ $technician->full_name }}</h5>
                                    <hr>
                                    <p class="card-text text-truncate">
                                        <strong>Address :</strong> {{ $technician->address }}<br>
                                        <strong>Phone # :</strong> {{ $technician->contact }}<br>
                                    </p>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                @php
                                    $isHired = in_array($technician->id, $hiredTechnicians);
                                    $buttonClass = $isHired ? 'btn-outline-danger active' : 'btn-success active';
                                    $buttonText = $isHired ? 'Already Hired' : 'Hire Technician';
                                @endphp
                                <button type="button" id="btn-hire"
                                        data-bs-toggle="modal"
                                        data-bs-target="#hireTechnicianModal"
                                        data-id="{{ $technician->id }}"
                                        data-name="{{ $technician->full_name }}"
                                        class="btn {{ $buttonClass }} btn-sm rounded rounded-3"
                                        {{ $isHired ? 'disabled' : '' }}>
                                    {{ $buttonText }}
                                </button>
                                <button type="button" class="btn btn-info btn-sm rounded rounded-3" 
                                        data-bs-toggle="modal" data-bs-target="#viewMoreInfoModal" 
                                        data-id="{{ $technician->id }}">
                                    <i class="bi bi-person-circle"></i> View More Info
                                </button>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        @include('user.others.hire_technician')
        @include('user.others.user_info')
    </section>
</main>
@include('user.partials.__footer')
