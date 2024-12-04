@include('user.partials.__header')
@include('user.partials.__nav')
<main id="main" class="main">
    <section class="section services">
        <div class="d-flex flex-column justify-content-between" style="height:85vh;">
            <div class="card shadow-sm p-3" style="border: 1px solid #188754; border-radius: 8px; background-color: #f9f9f9;">
                <h5 class="card-title text-center pt-0" style="font-weight: bold;">Request Details</h5>
                
                <div class="mb-2">
                    <strong>Farmer Name : </strong> {{ $requestDetails->farmer_name }}
                </div>
                <div class="mb-2">
                    <strong>Date/Time : </strong> {{ \Carbon\Carbon::parse($requestDetails->created_at)->format('F d, Y | h:i A') }}
                </div>
                <div class="mb-2">
                    <strong>Farm Location : </strong><i class="bi bi-geo-alt-fill" style="color: red;"></i> {{ $requestDetails->farm->location }} 
                </div>
                <div class="mb-2">
                    <strong>Farm Size : </strong> {{ $requestDetails->farm->hectares }} hectares
                </div>
                <div class="mb-2">
                    <strong>No. of Coconut Trees : </strong> {{ $requestDetails->farm->planted_coconut }} trees
                </div>
                <div class="mb-3">
                    <strong>NOTE : </strong>
                    <textarea name="note" class="form-control" rows="2" placeholder="Add a note here..."></textarea>
                </div>

                <div class="d-flex justify-content-around">
                    <form action="{{ route('requests.status', ['id' => $requestDetails->id, 'status' => 'accepted']) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success px-4">
                            <i class="bi bi-check-circle"></i> Accept
                        </button>
                    </form>
                    <form action="{{ route('requests.status', ['id' => $requestDetails->id, 'status' => 'declined']) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger px-4">
                            <i class="bi bi-x-circle"></i> Decline
                        </button>
                    </form>
                </div>
        
            </div>
              <!-- Back Button -->
            <div class="text-center d-flex">
                <a href="{{ url()->previous() }}" class="btn btn-success align-self-start px-4">
                    <i class="bi bi-arrow-left w-4"></i> 
                </a>
            </div>
        </div>
      
    </section>
</main>
@include('user.partials.__footer')
