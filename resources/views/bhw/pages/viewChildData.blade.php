@include('bhw.partials.__header')
@include('admin.partials.__nav')

<main id="main" class="main">
    <div class="pagetitle text-center mb-5">
        <h1 class="fw-bold">Child Census Data</h1>
    </div>
    <div class="text-left mt-4 no-print">
    <a href="{{ route('bhw.pages.list') }}" class="btn btn-secondary">Back</a>
        <button class="btn btn-primary" onclick="printData()">Print</button>
    </div>
    <div class="mt-4 text-left">
    </div>
    <div class="container shadow-lg p-5 rounded bg-light" id="printable-area">
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

        
        <div class="col-md-4 mb-3">
        <strong>Vaccines:</strong>
        <ul>
            @if(is_array($childs->vaccines))
                @foreach($childs->vaccines as $vaccine)
                    <li class="mb-2">{{ $vaccine }}</li>
                @endforeach
            @else
                <li>No vaccine records available</li>
            @endif
        </ul>
    </div>

    </div>
    
    
</main>

@include('bhw.partials.__footer')

<script>
    function printData() {
        var printContents = document.getElementById('printable-area').innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        location.reload(); 
    }
</script>

<style>
    @media print {
        .no-print { display: none !important; }
    }
</style>
