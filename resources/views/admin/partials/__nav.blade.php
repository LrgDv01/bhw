

<header id="header" class="header fixed-top d-flex align-items-center">

  <div class="d-flex align-items-center justify-content-between">
    <a href="{{ url('/admin/dashboard') }}" class="logo d-flex align-items-center justify-content-center">
      <img src="{{ URL::asset('img/bhw-logo.png') }}" alt="app-logo">
      <span class="d-none d-lg-block">{{ auth()->user()->isSuperAdmin() ? "BHW President" : (auth()->user()->isAdmin() ?  "BHW Midwife" : "BHW")}}</span>
    </a>
    <i class="text-dark bi bi-list toggle-sidebar-btn"></i>
  </div>
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
            <span class="d-none d-md-block dropdown-toggle ps-2">{{ auth()->user()->isSuperAdmin() ? "Super Admin" 
                       : (auth()->user()->isAdmin() ?  "Admin" : Auth::user()->username )}}</span>
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

          </ul>
        </div>
      </li>

    </ul>
  </nav>
</header>

<style>
  .nav-item .nav-link.active {
    background-color: #f8f3f2;
    color: #a6a6a6;
    font-weight: bold;
  }
  .nav-item .nav-link.active .bi,
  .nav-item .nav-link.active:hover,
  .nav-item .nav-link.active:hover .bi {
    color: #a6a6a6;
  }
  .nav-item .nav-link.inactive {
    background-color: transparent;
    color: #f8f3f2;
  }
  .nav-item .nav-link.inactive .bi,
  .nav-item .nav-link.inactive:hover .bi {
    color: #f8f3f2;
  }
  .nav-item .nav-link.inactive:hover {
    background-color: gray;
    color: #f8f3f2;
  }
  .nav-item .nav-link i.bi-chevron-down {
    transition: transform 0.5s ease;
  }
  .nav-item .nav-link[aria-expanded="true"] i.bi-chevron-down {
    transform: rotate(180deg);
  }
  .nav-item .nav-link[aria-expanded="false"] i.bi-chevron-down {
    transform: rotate(0deg);
  }
  .nav-content.collapse {
    transition: height 1s ease !important; 
    overflow: hidden; 
  }
  .nav-content.collapsing {
    transition: height 1s ease !important;
    overflow: hidden;
  }
  .nav-content.collapse.show {
    transition: height 3s ease !important; 
    overflow: hidden;
  }
  .sidebar {
    background-color: #a6a6a6;
  }
  .nav-content {
    background-color: transparent; 
    padding-left: 10px;
    border-left: 3px solid #a6a6a6;
  }
  .nav-content a {
    display: flex;
    align-items: center;
    padding: 8px 12px;
    color: white !important;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease, color 0.3s ease;
  }
  .nav-content a:hover {
    background-color: gray; 
    color: #000;
  }
  .nav-content a.active {
    background-color: #bfbfbf; 
    color: #000;
    font-weight: bold;
  }
  .nav-content a.active i {
    color: #000;
  }

</style> 

<aside id="sidebar" class="sidebar d-flex flex-column justify-content-between" style="background-color:#a6a6a6">
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
        @if (auth()->user()->isBHW())
          @php
            $isServiceActive = Request::is(
                'bhw/services', 'bhw/census-form', 'bhw/mother-census', 
                'deworming', 'familyplanning', 'wreproductiveage', 
                'bhw/child'
            );
          @endphp
          <li class="nav-item">
            <a class="nav-link border-0 {{ Request::is('bhw/dashboard') ? 'active' : 'inactive' }}" 
                href="{{ route('bhw.dashboard') }}">
                <i class="bi bi-grid-fill"></i>
                <span>Dashboard</span></a>
          </li>
          <li class="nav-item">
              <a class="nav-link border-0 {{ $isServiceActive ? 'active' : 'inactive' }}"
                  data-bs-toggle="collapse" 
                  href="#services-nav" 
                  aria-expanded="{{ $isServiceActive ? 'true' : 'false' }}" 
                  aria-controls="services-nav">
                  <i class="bi bi-briefcase"></i>
                  <span>My Services</span>
                  <i class="bi bi-chevron-down ms-auto"></i>
              </a>
              <ul id="services-nav" class="nav-content collapse {{ $isServiceActive ? 'show' : '' }}" 
                  data-bs-parent="#sidebar-nav">
                  <li>
                      <a href="{{ route('bhw.census-form') }}" class="{{ Request::is('bhw/census-form') ? 'active' : '' }}">
                        <span>+ Census</span> </a>
                  </li>
                  <li>
                      <a href="{{ route('bhw.mother-census') }}" class="{{ Request::is('bhw/mother-census') ? 'active' : '' }}">
                          <span>+ Maternal Care</span> </a>
                  </li>
                  <li>
                      <a href="{{ route('bhw.deworming.index') }}" class="{{ Request::is('deworming') ? 'active' : '' }}">
                          <span>+ Deworming</span> </a>
                  </li>
                  
                  <li>
                      <a href="{{ route('bhw.familyplanning') }}" class="{{ Request::is('familyplanning') ? 'active' : '' }}">
                          <span>+ Family Planning</span>
                      </a>
                  </li>
                  <li>
                      <a href="{{ route('bhw.wreproductiveage.index') }}" class="{{ Request::is('wreproductiveage') ? 'active' : '' }}">
                          <span>+ Woman in Reproductive Age</span>
                      </a>
                  </li>
                  <li>
                      <a href="{{ route('bhw.child') }}" class="{{ Request::is('bhw/child') ? 'active' : '' }}">
                          <span>+ Immunization</span></a>
                  </li>
                  <li>
                      <a href="{{ route('bhw.deworming.index') }}" class="{{ Request::is('bhw/deworming') ? 'active' : '' }}">
                          {{-- <i class="bi bi-person-workspace fs-6"></i> --}}
                          <span>+ Overall Monthly Report</span></a>
                  </li>
              </ul>
          </li>
          <li class="nav-item">
              <a class="nav-link border-0 {{ Request::is('bhw/list') ? 'active' : 'inactive' }}" 
                  href="{{ route('bhw.pages.list') }}">
                  <i class="bi bi-list-ul"></i>
                  <span>List</span>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link border-0 {{ Request::is('bhw/schedule', 'bhw/duty') ? 'active' : 'inactive' }}" 
                  href="{{ route('bhw.schedule') }}">
                  <i class="bi bi-calendar-check"></i>
                  <span>Schedule</span>
              </a>
          </li>

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

