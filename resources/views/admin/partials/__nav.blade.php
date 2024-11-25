@php
    $notifications = auth()->user()->notifications->toArray();
@endphp
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="{{ url('/admin') }}" class="logo d-flex align-items-center justify-content-center">
        <img src="{{ URL::asset('img/logo.png') }}" alt="">
        <span class="d-none d-lg-block">{{ isset($appInfo->app_name) ? $appInfo->app_name : "" }}</span>
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
              <i class="text-dark bi bi-bell"></i>
              <span class="notification-bell position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
                <span class="visually-hidden">New alerts</span>
              </span>
            </a>
            <a class="nav-link bg-transparent border border-0 text-dark nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
              <img src="{{ Auth::user()->profile_img != '' ? asset('storage/'.Auth::user()->profile_img) : URL::asset('img/admin-profile.png') }}" alt="Profile" class="rounded-circle">
              <span class="d-none d-md-block dropdown-toggle ps-2">{{ auth()->user()->isAdmin() ? "Admin" : "Personel" }}</span>
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
              @if (in_array(1007, auth()->user()->module_access()) || auth()->user()->isAdmin())
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
      @if (in_array(1, auth()->user()->module_access()) || auth()->user()->isAdmin())
        <li class="nav-item">
          <a class="nav-link bg-transparent border border-0 text-white " href="{{ url('/admin') }}">
            <i class="text-white bi bi-grid-fill"></i>
            <span>Dashboard</span>
          </a>
        </li>
      @else 
      <li class="nav-item">
        <a class="nav-link bg-transparent border border-0 text-white " href="{{ url('/admin') }}">
          <i class="text-white bi bi-house"></i>
          <span>Home</span>
        </a>
      </li>
      @endif

      @if (auth()->user()->isAdmin())
        <li class="nav-item">
          <a class="nav-link bg-transparent border border-0 text-white " href="{{ url('/admin/map_locations') }}">
            <i class="text-white bi bi-map-fill"></i>
            <span>Map</span>
          </a>
        </li>
      @endif

      @if (auth()->user()->isAdmin())
        <li class="nav-item">
          <a class="nav-link bg-transparent border border-0 text-white " href="{{ url('/admin/map_simulation') }}">
            <!-- <i class="text-white bi-geo-fill"></i>  -->
            <i class="text-white bi-geo-fill"></i> 

            <span>Simulation</span>
          </a>
        </li>
      @endif

{{-- 
  
        @if (in_array(1000, auth()->user()->module_access()) || auth()->user()->isAdmin())
        <li class="nav-item">
          <a class="nav-link bg-transparent border border-0 text-white collapsed" data-bs-target="#visitation-nav" data-bs-toggle="collapse" href="#">
            <i class="text-white bi bi-people"></i><span>User Management</span>
          </a>
          <ul id="visitation-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
            <li>
              <a href="{{ url('/admin/users_management') }}">
                <i class="text-white bi bi-circle"></i><span class="text-white">Management</span> 
              </a>
            </li>
             <li>
              <a href="{{ url('/admin/users_verification') }}">
                <i class="text-white bi bi-circle"></i><span class="text-white">Verification</span> <span class="ms-2 badge bg-warning user_verification_request" style="display: none">0</span>
              </a>
            </li> 
          </ul>
        </li>
      @endif
      @if (in_array(2001, auth()->user()->module_access()) || auth()->user()->isAdmin())
        <li class="nav-item">
          <a class="nav-link bg-transparent border border-0 text-white collapsed" data-bs-target="#report-nav" data-bs-toggle="collapse" href="#">
            <i class="text-white bi bi-folder"></i><span>Reports</span>
          </a>
          <ul id="report-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
            @if (in_array(2002, auth()->user()->module_access()) || auth()->user()->isAdmin())
              <li>
                <a href="{{ url('/admin/add_data') }}">
                  <i class="text-white bi bi-plus fs-6"></i>
                  <span class="text-white">Add Data</span>
                </a>
              </li>
            @endif
            <li>
              <a href="{{ url('/admin/reports') }}">
                <i class="text-white bi bi-files fs-6"></i><span class="text-white">Manage Reports</span> 
              </a>
            </li>
          </ul>
        </li>
      @endif
      @if (in_array(2000, auth()->user()->module_access()) || auth()->user()->isAdmin())
        <li class="nav-item">
          <a class="nav-link bg-transparent border border-0 text-white " href="{{ url('/admin/qr_scanner') }}">
            <i class="text-white bi bi-upc-scan"></i>
            <span>QR Scanner</span>
          </a>
        </li>
      @endif
      @if (in_array(1001, auth()->user()->module_access()) || auth()->user()->isAdmin())
         <li class="nav-item">
          <a class="nav-link bg-transparent border border-0 text-white collapsed" data-bs-target="#visitation-nav" data-bs-toggle="collapse" href="#">
            <i class="text-white bi bi-file-earmark"></i><span>Visitation Request</span><i class="text-white bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="visitation-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
            <li>
              <a href="{{ url('/admin/visitation/physical') }}">
                <i class="text-white bi bi-circle"></i><span class="text-white">Onsite visit</span> <span class="ms-2 badge bg-warning physical_alert" style="display: none">0</span>
              </a>
            </li>
            <li>
              <a href="{{ url('/admin/visitation/virtual') }}">
                <i class="text-white bi bi-circle"></i><span class="text-white">Virtual Visit</span> <span class="ms-2 badge bg-warning virtual_alert" style="display: none">0</span>
              </a>
            </li>
          </ul>
        </li> 
      @endif
      @if (in_array(1002, auth()->user()->module_access()) || auth()->user()->isAdmin())
         <li class="nav-item">
          <a class="nav-link bg-transparent border border-0 text-white collapsed" data-bs-target="#schedule-nav" data-bs-toggle="collapse" href="#">
            <i class="text-white bi bi-calendar"></i><span>Schedule</span><i class="text-white bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="schedule-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
            <li>
              <a href="{{ url('/admin/schedule/') }}">
                <i class="text-white bi bi-circle"></i><span class="text-white">Calendar</span>
              </a>
            </li>
            <li>
              <a href="{{ url('/admin/schedule/onsite') }}">
                <i class="text-white bi bi-circle"></i><span class="text-white">Onsite visit</span>
              </a>
            </li>
            <li>
              <a href="{{ url('/admin/schedule/virtual') }}">
                <i class="text-white bi bi-circle"></i><span class="text-white">Virtual Visit</span>
              </a>
            </li>
          </ul>
        </li> 
      @endif
      @if (in_array(1003, auth()->user()->module_access()) || auth()->user()->isAdmin())
        <li class="nav-item">
          <a class="nav-link bg-transparent border border-0 text-white " href="{{ url('/admin/library') }}">
            <i class="text-white bi bi-journal-bookmark-fill"></i>
            <span>Jail Library</span>
          </a>
        </li> 
      @endif
      @if (in_array(1005, auth()->user()->module_access()) || auth()->user()->isAdmin())
        <li class="nav-item">
          <a class="nav-link bg-transparent border border-0 text-white " href="{{ url('/admin/announcement') }}">
            <i class="text-white bi bi-megaphone"></i>
            <span>Announcement</span>
          </a>
        </li>
      @endif
      <li class="nav-heading text-white fw-bold">Others</li>
      @if (in_array(1008, auth()->user()->module_access()) || auth()->user()->isAdmin())
        <li class="nav-item">
          <a class="nav-link bg-transparent border border-0 text-white " href="{{ url('/admin/feedback') }}">
            <i class="text-white bi bi-card-list"></i>
            <span>Feedback</span>
          </a>
        </li> 
      @endif
      @if (in_array(1006, auth()->user()->module_access()) || auth()->user()->isAdmin())
        <li class="nav-item">
          <a class="nav-link bg-transparent border border-0 text-white " href="{{ url('/admin/audit') }}">
            <i class="text-white bi bi-card-list"></i>
            <span>Audit Trail</span>
          </a>
        </li>
      @endif
      @if (in_array(1007, auth()->user()->module_access()) || auth()->user()->isAdmin())
        <li class="nav-item">
          <a class="nav-link bg-transparent border border-0 text-white " href="{{ url('/admin/settings') }}">
            <i class="text-white bi bi-gear"></i>
            <span>Settings</span>
          </a>
        </li>
      @endif
      --}}
   

 
      {{-- <li class="nav-item">
        <a class="nav-link bg-transparent border border-0 text-white collapsed" href="{{ url('/admin/help') }}">
          <i class="text-white bi bi-info-circle"></i>
          <span>Help & Support</span>
        </a>
      </li> --}}
      {{-- 
        <li class="nav-item ">
        <form action="{{ route('logout') }}" id="logoutform" method="POST">
          @csrf
        </form>
        <button form="logoutform" type="submit" class="nav-link bg-transparent border border-0 text-white collapsed">
          <i class="text-white bi bi-arrow-bar-left"></i>
          <span>Logout</span>
        </button>
      </li>
         --}}
    
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
    id="notificationmodal"
    tabindex="-1"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    
    role="dialog"
    aria-labelledby="notificationmodalTitle"
    aria-hidden="true"
  >
    <div
      class="modal-dialog modal-dialog-scrollable modal-dialog-centered"
      role="document"
    >
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="notificationmodalTitle">
            Notification
          </h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">
          <div class="list-group list-group-flush">
            @if (!empty($notifications))
              @foreach ($notifications as $notification)
                <a
                  href="#"
                  class="list-group-item list-group-item-action flex-column align-items-start"
                  aria-current="true"
                >
                  <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">{{ $notification['title'] }}</h5>
                    <small class="text-muted">{{ date('M/d/Y', strtotime($notification['created_at']))}}</small>
                  </div>
                  <p class="mb-1">{{ $notification['content'] }}</p>
                </a>
              @endforeach
            @else 
              <div class="text-center">No Notification</div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
  
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
  
  <script>
    checkUnreadNotifications();
    
    function checkUnreadNotifications() {
        $.ajax({
            type: 'GET',
            url: '/notifications/unread', // Update this to the correct route
            success: function (response) {
                if (response.unread_count > 0) {
                    // Show the notification icon with the alert badge
                    $('.notification-bell').removeClass('d-none');
                } else {
                    // Hide the notification icon
                    $('.notification-bell').addClass('d-none');
                }
            },
            error: function (xhr, status, error) {
                console.error("Error fetching notifications: " + error);
            }
        });
    }
    $(document).on('click', '#notification-bell', function () {
        $.ajax({
            type: 'POST',
            url: '/notifications/mark-read',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Add CSRF token
            },
            success: function (response) {
                if (response.success) {
                    // Optionally hide the notification alert after marking as read
                    checkUnreadNotifications(); // Refresh the notification state
                }
            },
            error: function (xhr, status, error) {
                console.error("Error marking notifications as read: " + error);
            }
        });
    });
  </script>