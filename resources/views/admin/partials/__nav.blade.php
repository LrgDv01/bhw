
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="{{ url('/admin') }}" class="logo d-flex align-items-center justify-content-center">
        <img src="{{ URL::asset('img/logo.png') }}" alt="">
        <span class="d-none d-lg-block fs-5">Coco-Spot</span>
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
              <span class="d-none d-md-block dropdown-toggle ps-2">{{ auth()->user()->isAdmin() ? "Admin" : "Farmer" }}</span>
            </a>

            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
              <li class="dropdown-header">
                <h6>{{ auth()->user()->isAdmin() ? "Administrator" : "Personel" }}</h6>
                <span>{{ auth()->user()->isAdmin() ? "Super Admin" : "Sub Admin" }}</span>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>
    
              @if (auth()->user()->isAdmin())
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
  
  <aside id="sidebar" class="sidebar d-flex flex-column justify-content-between" style="background-color:#134125">
    <ul class="sidebar-nav flex-column" id="sidebar-nav">
      @if (auth()->user()->isAdmin())
        <li class="nav-item">
          <a class="nav-link bg-transparent border border-0 text-white " href="{{ url('/admin') }}">
            <i class="text-white bi bi-grid-fill"></i>
            <span>Dashboard</span>
          </a>
        </li>  
        <li class="nav-item">
          <a class="nav-link bg-transparent border border-0 text-white " href="{{ url('/admin/map') }}">
            <i class="text-white bi bi-map-fill"></i>
            <span>Map</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link bg-transparent border border-0 text-white " href="{{ url('/admin/map_simulation') }}">
            <i class="text-white bi-geo-fill"></i> 
            <span>Simulation</span>
          </a>
        </li>
      @endif
    </ul>

    <div class="sidebar-nav">
        <form action="{{ route('logout') }}" id="logoutform" method="POST">
          @csrf
        </form>
        <button form="logoutform" type="submit" class="nav-link bg-transparent border border-0 text-white collapsed">
          <i class="text-white bi bi-arrow-bar-left"></i>
          <span>Logout</span>
        </button>
    </div>
  </aside>

  
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
            <div class="col-lg-12 mb-3">
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
            <div class="text-end"><button type="submit" class="btn btn-success px-4">Change password</button></div>
          </form>
        </div>
      </div>
    </div>
  </div>
  
