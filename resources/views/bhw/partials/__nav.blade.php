<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
      <a href="{{ url('/bhw/services') }}" class="logo d-flex align-items-center justify-content-center">
        {{-- <img src="{{ URL::asset('img/admin-profile.png') }}" alt=""> --}}
        {{--<span class="d-none d-lg-block">{{ isset($appInfo->app_name) ? $appInfo->app_name : "BHW" }} BHW</span>--}}
        <span class="d-block d-lg-block">BH Worker</span>
      </a>
      <i class="text-dark bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->
    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        <li class="nav-item dropdown pe-3">
          <div class="d-flex align-items-center">
            <a class="nav-link bg-transparent border border-0 text-dark nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
              {{-- <img src="{{ Auth::user()->profile_img != '' ? asset('storage/'.Auth::user()->profile_img) : URL::asset('img/admin-profile.png') }}" alt="Profile" class="rounded-circle"> --}}
              <img src="{{ Auth::user()->profile_img ? asset('storage/'.Auth::user()->profile_img) : URL::asset('img/admin-profile.png') }}" alt="Profile" class="rounded-circle">
              <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->username }}</span>
            </a><!-- End Profile Iamge Icon -->
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
              <li class="dropdown-header">
                <h6>{{ Auth::user()->full_name }}</h6>
                {{--<span>BHW</span>--}}
              </li>
              <li>
                <hr class="dropdown-divider mb-2">
              </li>
              <li class="">
                <button form="logoutform" type="submit" class="dropdown-item d-flex align-items-center justify-content-center">
                  <i class="text-dark bi bi-box-arrow-right"></i>
                  <span>Sign Out</span>
                </button>
              </li>
            </ul>
          </div>
        </li>
      </ul>
    </nav>
  </header>

  
<style>
  .nav-link.active  {
    background-color: #f8f3f2; 
    color: #a6a6a6; 
    font-weight: bold; 
    .bi {
      color: #a6a6a6; 
    }
  }
  .nav-link.active:hover {
    background-color:  #f8f3f2;
    color: #a6a6a6; 
    .bi {
      color: #a6a6a6; 
    }
  }
  .nav-link.inactive {
    background-color:transparent;
    color:#f8f3f2;
    .bi {
      color: #f8f3f2; 
    }
  }
  .nav-link.inactive:hover {
    background-color: gray; /* Hover background color */
    color: #f8f3f2; /* Hover text color */
    .bi {
      color: #f8f3f2; 
    }
  }
</style>
  
  <aside id="sidebar" class="sidebar d-flex flex-column justify-content-between" style="background-color:#a6a6a6">
    <ul class="sidebar-nav" id="sidebar-nav">
    @if (auth()->user())
      @if (auth()->user()->isBHW())
          <li class="nav-item">
            <a class="nav-link border border-0 {{ Request::is('bhw/serv') ? 'active' : 'inactive' }}" href="{{ url('/bhw/serv') }}">
              <i class="bi bi-briefcase "></i>  
              <span>Services</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link border border-0 {{ Request::is('bhw/list') ? 'active' : 'inactive' }}" href="{{ url('/bhw/list') }}">
              <i class="bi bi-list-ul "></i>  
              <span>List</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link border border-0 {{ Request::is('bhw/schedule') || Request::is('bhw/duty') ? 'active' : 'inactive' }}" href="{{ url('/bhw/schedule') }}">
              <i class="bi bi-calendar-check "></i>  
              <span>Schedule</span>
            </a>
          </li>
          
          <div class="position-relative">
            <a href="{{ route('bhw.Announcement') }}" class="btn btn-warning position-absolute" style="top: 15px; left: 15px; z-index: 1000;">
                <i class="bi bi-bell"></i> Announcement
            </a>
          </div>
      @endif
    @endif
    </ul>

    <div class="sidebar-nav">
      <button 
          type="button" 
          class="nav-link bg-transparent border border-0 text-white collapsed" 
          data-bs-toggle="modal" 
          data-bs-target="#logoutModal">
            <i class="text-white bi bi-arrow-bar-left"></i>
            <span>Logout</span>
      </button>
    </div>
  </aside>

  
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="logoutModalLabel"><strong>Confirm Logout</strong></h5>
      </div>
      <div class="modal-body">
        Are you sure you want to log out ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
          Cancel
        </button>
        <form action="{{ route('logout') }}" method="POST" onsubmit="disableSubmitButton(this)">
          @csrf
          <button type="submit" class="btn btn-primary" id="logoutSubmitButton">
            Yes, Log me out
          </button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  function disableSubmitButton(form) {
    const submitButton = form.querySelector('button[type="submit"]');
    submitButton.disabled = true; 
    submitButton.innerHTML = 'Logging out ...'; 
  }
</script> 

