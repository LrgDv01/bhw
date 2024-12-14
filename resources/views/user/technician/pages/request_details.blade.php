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
                    <strong>Farm Location : </strong><i class="bi bi-geo-alt-fill" style="color: red;"></i> {{ $requestDetails->farms->location }} 
                </div>
                <div class="mb-2">
                    <strong>Farm Size : </strong> {{ $requestDetails->farms->hectares }} hectares
                </div>
                <div class="mb-2">
                    <strong>No. of Coconut Trees : </strong> {{ $requestDetails->farms->planted_coconut }} trees
                </div>
                <div class="mb-3">
                    <strong>NOTE : </strong>
                    <textarea name="note" class="form-control" rows="2" placeholder="Add a note here..."></textarea>
                </div>
            
                <div class="d-flex justify-content-center gap-5">
                    <button type="button" class="btn btn-danger px-3 w-35 btn-block rounded-pill" 
                            data-status="declined"
                            data-message="decline"
                            data-bs-toggle="modal" 
                            data-bs-target="#actionModal">
                        <i class="bi bi-x-circle"></i> Decline
                    </button>
                    <button type="button" class="btn btn-success px-3 w-35 btn-block rounded-pill" 
                            data-status="accepted"
                            data-message="accept"
                            data-bs-toggle="modal" 
                            data-bs-target="#actionModal">
                        <i class="bi bi-check-circle"></i> Accept
                    </button>
                </div>
            </div>
              <!-- Back Button -->
            <div class="text-center d-flex">
                <a href="{{ route('user.notifications') }}" class="btn btn-success align-self-start px-4">
                    <i class="bi bi-arrow-left w-4"></i> 
                </a>
            </div>
        </div>
        @include('user.technician.others.request_action')
    </section>
</main>
@include('user.partials.__footer')

<script>
   $('#actionModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);  
        var status = button.data('status');   
        var message = button.data('message'); 
        var modal = $(this);
        modal.find('.modal-title').text('Confirm ' + message.charAt(0).toUpperCase() + message.slice(1));
        modal.find('#actionModalBody').html(
            `Are you sure you want to <strong>${message}</strong> this request from 
            <strong>{{ $requestDetails->farmer_name }}</strong>?`
        );
        var requestId = "{{ $requestDetails->id }}"; 
        var formAction = `/user/notifications/${requestId}/${status}/request-details`;
        modal.find('#actionForm').attr('action', formAction);
        var buttonClass = status === 'accepted' ? 'btn-success' : 'btn-danger';
        var buttonIcon = status === 'accepted' ? 'bi-check-circle' : 'bi-x-circle';
        modal.find('#actionSubmitBtn')
            .removeClass('btn-success btn-danger')
            .addClass(buttonClass);
        modal.find('#actionSubmitBtn i')
            .removeClass('bi-check-circle bi-x-circle')
            .addClass(buttonIcon);
    });
</script>
