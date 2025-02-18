

<header id="header" class="header fixed-top d-flex align-items-center">

  <div class="d-flex align-items-center justify-content-between">
    <a href="{{ url('/admin/dashboard') }}" class="logo d-flex align-items-center justify-content-center">
      <img src="{{ URL::asset('img/bhw-logo.png') }}" alt="app-logo">
      <span class="d-none d-lg-block fs-5">{{ auth()->user()->isSuperAdmin() ? "BHW President" : "BHW Midwife" }}</span>
    </a>
    <i class="text-dark bi bi-list toggle-sidebar-btn"></i>
  </div><!-- End Logo -->


  <nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">
      <li class="nav-item dropdown pe-3">
         
        <div class="d-flex align-items-center">
          <a href="#notification"
            data-bs-toggle="modal"
            data-bs-target="#notificationmodal" id="notification-bell" class="me-4 fs-2 position-relative">
          </a>
          <a class="nav-link bg-transparent border border-0 text-dark nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="{{ Auth::user()->profile_img != '' ? asset('storage/'.Auth::user()->profile_img) : URL::asset('img/admin-profile.png') }}" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">{{ auth()->user()->isSuperAdmin() ? "Super Admin" : "Admin" }}</span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>{{ auth()->user()->isSuperAdmin() ? "BHW President" : "Midwife" }}</h6>
              <span>{{ auth()->user()->isSuperAdmin() ? "Super Admin" : "Admin" }}</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
  
            @if (auth()->user()->isSuperAdmin())
              <li>
                <a class="dropdown-item d-flex align-items-center" href="{{ url('/admin/settings') }}">
                  <i class="text-dark bi bi-gear"></i>
                  <span>Settings</span>
                </a>
              </li>
            @endif
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" 
                data-bs-toggle="modal"
                data-bs-target="#forgotpasswordmodal" href="#forgotpassword">
                <i class="text-dark bi bi-question-circle"></i>
                <span>Forgot Passwword?</span>
              </a>
            </li>
            {{-- <li>
              <a class="dropdown-item d-flex align-items-center" href="{{ url('/admin/help') }}">
                <i class="text-dark bi bi-question-circle"></i>
                <span>Need Help?</span>
              </a>
            </li> --}}
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <button form="logoutform" type="submit" class="dropdown-item d-flex align-items-center">
                <i class="text-dark bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </button>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </div><!-- End Profile Iamge Icon -->
      </li><!-- End Profile Nav -->

    </ul>
  </nav><!-- End Icons Navigation -->

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

<aside id="sidebar" class="sidebar d-flex flex-column justify-content-between px-0" style="background-color:#a6a6a6">
  <ul class="sidebar-nav flex-column" id="sidebar-nav">
    @if (auth()->user())
        @if (auth()->user()->isSuperAdmin())
            <li class="nav-item">
                <a class="nav-link border border-0 {{ Request::is('admin/dashboard') ? 'active' : 'inactive' }}" href="{{ url('/admin/dashboard') }}">
                    <i class="bi bi-grid-fill"></i>
                    <span>Dashboard</span>
                </a> 
            </li>  
            <li class="nav-item">
                <a class="nav-link border border-0 {{ Request::is('admin/announcement') ? 'active' : 'inactive' }}" href="{{ url('/admin/announcement') }}">
                    <i class="bi bi-megaphone-fill"></i>
                    <span>Announcement</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link border border-0  {{ Request::is('admin/summary-list') ? 'active' : 'inactive' }}" href="{{ url('/admin/summary-list') }}">
                    <i class="bi bi-list-ul"></i> 
                    <span>Summary / List</span>
                </a> 
            </li>
            <li class="nav-item">
                <a class="nav-link border border-0  {{ Request::is('admin/list_bhw') || Request::is('admin/bhwregistration') ? 'active' : 'inactive' }}" href="{{ url('/admin/list_bhw') }}">
                    <i class="bi bi-people-fill"></i> 
                    <span>List of BHW</span>
                </a>
            </li>
        @endif
        @if (auth()->user()->isAdmin())
            <li class="nav-item">
                <a class="nav-link border border-0 {{ Request::is('admin-midwife/dashboard') ? 'active' : 'inactive' }}" href="{{ url('/admin-midwife/dashboard') }}">
                    <i class="bi bi-grid-fill"></i>
                    <span>Dashboard</span>
                </a> 
            </li>  
            <li class="nav-item">
                <a class="nav-link border border-0  {{ Request::is('admin-midwife/schedule') ? 'active' : 'inactive'  }}" href="{{ url('/admin-midwife/schedule') }}">
                    <i class="bi bi-calendar-check"></i> 
                    <span>Schedule</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link transparent border border-0  {{ Request::is('admin-midwife/list_bhw') ? 'active' : 'inactive'  }}" href="{{ url('/admin-midwife/list_bhw') }}">
                    <i class="bi bi-list-ul"></i> 
                    <span>BHW List</span>
                </a>
            </li>
            <li class="nav-item">
              <a class="nav-link border border-0 {{ Request::is('admin-midwife/user-activity') ? 'active' : 'inactive' }}" href="{{ url('/admin-midwife/user-activity') }}">
                <i class="bi bi-person-lines-fill "></i>  
                <span>User Activity</span>
              </a>
            </li> 
            <div class="position-relative">
              <a href="{{ route('admin.Announcement') }}" class="btn btn-warning position-absolute" style="top: 15px; left: 15px; z-index: 1000;">
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



<div
  class="modal fade"
  id="forgotpasswordmodal"
  tabindex="-1"
  data-bs-backdrop="static"
  data-bs-keyboard="false"
  
  role="dialog"
  aria-labelledby="forgotpasswordTitle"
  aria-hidden="true"
>
  <div
    class="modal-dialog modal-dialog-scrollable modal-dialog-centered"
    role="document"
  >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="forgotpasswordTitle">
          Forgot Password?
        </h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close"
        ></button>
      </div>
      <div class="modal-body">
        <form class="row" id="changepasswordform">
          {{--<div class="col-lg-12 mb-3">
              @csrf <!-- Add CSRF token field -->
      
              <div class="col-lg-12 mb-3">
                  <label for="old_password" class="form-label">Old Password</label>
                  <input type="password" class="form-control" id="old_password_input" name="old_password" required>
              </div>
          
              <div class="col-lg-12 mb-3">
                  <label for="new_password" class="form-label">New Password</label>
                  <input type="password" class="form-control" id="new_password_input" name="password" required>
              </div>
          
              <div class="col-lg-12 mb-3">
                  <label for="password_confirmation" class="form-label">Confirm New Password</label>
                  <input type="password" class="form-control" id="password_confirmation_input" name="password_confirmation" required>
              </div>
          </div>
          <div class="text-end"><button type="submit" class="btn btn-success px-4">Change password</button></div>--}}
        </form>
      </div>
    </div>
  </div>
</div>

