@include('bhw.partials.__header')
@include('bhw.partials.__nav')

<main id="main" class="main">
    <div class="pagetitle text-center mb-5">
        <h1 class="fw-bold">Child Census Data</h1>
    </div>

    <div class="container shadow-lg p-5 rounded bg-light">
        <h3 class="mb-4">{{ $childs->complete_name }}'s Data</h3>

        <div class="row">
            <div class="col-md-6 mb-3">
                <strong>House No:</strong> {{ $childs->house_number }}
            </div>
            <div class="col-md-6 mb-3">
                <strong>Role in Family:</strong> {{ $childs->role_in_family }}
            </div>
            <div class="col-md-6 mb-3">
                <strong>Date of Birth:</strong> {{ $childs->dob }}
            </div>
            <div class="col-md-6 mb-3">
                <strong>Age:</strong> {{ $childs->age }}
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <strong>Vaccines:</strong>
                <ul>
                    @foreach($childs->vaccines as $vaccine)
                        <li class="mb-2">{{ $vaccine }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
            <a href="{{ route('bhw.pages.list') }}" class="btn btn-secondary">Back</a>       
    </div>
</main>

@include('bhw.partials.__footer')
