@include('user.partials.__header')
@include('user.partials.__nav')

<style>
    .sticky-alert {
        position: fixed;
        top: 20px;
        left: -100%;  /* Start off-screen to the left */
        transform: translateY(0);
        z-index: 1050;
        width: 90%;
        max-width: 600px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        animation: slideInFromLeft 0.3s ease-in-out forwards;  /* Animation for entering */
    }

    @keyframes slideInFromLeft {
        0% {
            left: -100%;  /* Off-screen to the left */
            opacity: 0;
        }
        100% {
            left: 50%;  /* Center the message */
            opacity: 1;
            transform: translateX(-50%);
        }
    }

    @keyframes slideOutToRight {
        0% {
            left: 50%;  /* Center the message */
            opacity: 1;
        }
        100% {
            left: 100%;  /* Move off-screen to the right */
            opacity: 0;
        }
    }

</style>

<main id="main" class="main">
    <!-- Flash Messages -->
    @if (session('accepted'))
        <div class="alert alert-success alert-dismissible fade show sticky-alert" role="alert" id="flashMessage">
            {{ session('accepted') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('declined'))
        <div class="alert alert-warning alert-dismissible fade show sticky-alert" role="alert" id="flashMessage">
            {{ session('declined') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show sticky-alert" role="alert" id="flashMessage">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (auth()->user()->isFarmer())
        <section class="section farm">
            <div class="container">
                <div class="position-fixed bg-white text-center" 
                    style="top:7%; right:0; left:0; z-index: 995; width: 100%;">
                    <h2 class="py-2 mt-2">My Farm</h2>
                    <div class="d-flex flex-start px-4 mb-3">
                        <button type="button" class="btn btn-success rounded rounded-3" data-bs-toggle="modal" data-bs-target="#addFarmModal">
                            Add Farm
                        </button>
                    </div>
                </div>
                    <!-- Spacer to prevent content overlap -->
                <div style="margin-top: 100px;">
                </div>
                <!-- Farm Cards -->
                <div id="farm-list">
                    @foreach($farms as $farm)
                        <div class="card mb-2">
                            <div class="card-body">
                                <h5 class="card-title p-0">{{ $farm->name }}<hr></h5>
                                <p class="card-text text-truncate">
                                    <strong>Address :</strong> {{ $farm->location }}<br>
                                    <strong>Variety :</strong> {{ $farm->variety }} <br>
                                    <strong>Hectares :</strong> {{ $farm->hectares }} <br>
                                    <strong>Tree Age :</strong> {{ $farm->tree_age }} <br>
                                    <strong>Planted Coconut :</strong> {{ $farm->planted_coconut }} <br>
                                    <strong>Soil Type :</strong> {{ $farm->soil_type }} 
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            
            </div>
            @include('user.others.add_farm')
        </section>
    @endif
    @if (auth()->user()->isTechnician())
        <section class="section notifications">
            <div class="container">
                @if($notifications->isEmpty())
                    <p class="text-center">No notifications available at the moment.</p>
                @else
                    <div class="card shadow-sm">
                        <div class="card-header bg-success text-white sticky-top" style="z-index: 1;">
                            <h4>Notifications</h4>
                        </div>
                        <div class="card-body text-truncate p-0" style="max-height: 80vh; overflow-y: auto;">
                            <ul class="list-group">
                                @foreach ($notifications as $notifs)
                                    <li class="list-group-item d-flex flex-column align-items-center shadow-sm p-3">
                                        <div class="mb-2">
                                            <h5 class="mb-1">New Service Request from Farmer</h5>
                                            <p class="mb-1">
                                                <strong>Request ID:</strong> {{ $notifs->request_id }}<br>
                                                <strong>Date/Time:</strong> {{ $notifs->created_at->format('F d, Y | h:i A') }}
                                            </p>
                                        </div>
                                        <div class="align-self-end">
                                            <a href="{{ route('user.viewDetails', $notifs->id) }}" class="btn btn-success">
                                                View Details
                                            </a>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>  
                @endif
            </div>
        </section>
    @endif
</main>
@include('user.partials.__footer')

<script>
document.addEventListener('DOMContentLoaded', function () {
    const flashMessage = document.getElementById('flashMessage');
    if (flashMessage) {
        setTimeout(() => {
            flashMessage.classList.remove('show');
            flashMessage.style.animation = 'slideOutToRight 0.5s ease-in-out forwards';  
        }, 3000); 
    }
});
</script>
