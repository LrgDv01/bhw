<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
      <a href="{{ url('/bhw/dashboard') }}" class="logo d-flex align-items-center justify-content-center">
        <img src="{{ URL::asset('img/bhw-logo.png') }}" alt="app-logo">
        {{--<span class="d-none d-lg-block">{{ isset($appInfo->app_name) ? $appInfo->app_name : "BHW" }} BHW</span>--}}
        <span class="d-block d-lg-block">BHW</span>
      </a>
      <i class="text-dark bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->
    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        <li class="nav-item dropdown pe-3">
          <div class="d-flex align-items-center">
            <a href="{{ route('bhw.Announcement') }}" class="btn btn-warning w-100 text-start d-flex align-items-center me-5">
                <i class="bi bi-bell me-2"></i>
                <span>Announcement</span>
            </a>
            <a class="nav-link bg-transparent border border-0 text-dark nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
              {{-- <img src="{{ Auth::user()->profile_img != '' ? asset('storage/'.Auth::user()->profile_img) : URL::asset('img/admin-profile.png') }}" alt="Profile" class="rounded-circle"> --}}
              <img src="{{ Auth::user()->profile_img ? asset('storage/'.Auth::user()->profile_img) : URL::asset('img/admin-profile.png') }}" alt="Profile" class="rounded-circle">
              <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->username }}</span>
            </a><!-- End Profile Iamge Icon -->
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
              <li class="dropdown-header">
            
                <span>BHW</span>
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

  
{{-- <style>
  .nav-item .nav-link.active  {
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
  }

  .nav-link.inactive .bi {
    color: #f8f3f2; 
  }

  .nav-link.inactive:hover {
    background-color: gray; 
    color: #f8f3f2;
    .bi {
      color: #f8f3f2; 
    }
  }


  .nav-item .nav-link[aria-expanded="true"] i.bi-chevron-down {
    color: #f8f3f2; 
    transform: rotate(180deg);
    transition: transform 0.3s ease;
  
  } 
  .nav-item .nav-link[aria-expanded=""] i.bi-chevron-down {
    color: #f8f3f2; 
    transform: rotate(0deg);
    transition: transform 0.3s ease;
  }
  

</style> --}}

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

  /* Dropdown Indicator */
  .nav-item .nav-link[aria-expanded="true"] i.bi-chevron-down {
    transform: rotate(180deg);
    transition: transform 0.3s ease;
  }

  .nav-item .nav-link[aria-expanded="false"] i.bi-chevron-down {
    transform: rotate(0deg);
    transition: transform 0.3s ease;
  }

  /* Sidebar Styling */
  .sidebar {
    background-color: #a6a6a6;
  }

  /* Submenu (My Services) Styling */
  .nav-content {
    background-color: transparent; /* Light gray background for sub-menu */
    padding-left: 10px;
    border-left: 3px solid #a6a6a6; /* Adds a left border to distinguish it */
  }

  .nav-content a {
    display: flex;
    align-items: center;
    padding: 8px 12px;
    color: white !important; /* Dark text for visibility */
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease, color 0.3s ease;
  }

  .nav-content a:hover {
    background-color: gray; /* Slightly lighter shade for hover */
    color: #000;
  }

  .nav-content a.active {
    background-color: #bfbfbf; /* Active item color */
    color: #000;
    font-weight: bold;
  }

  .nav-content a.active i {
    color: #000;
  }

</style> 


{{--<aside id="sidebar" class="sidebar d-flex flex-column justify-content-between" style="background-color:#a6a6a6">
    <ul class="sidebar-nav" id="sidebar-nav">
    @if (auth()->user() && auth()->user()->isBHW())
        @php
          $isService =  Request::is('bhw/services') || Request::is('bhw/child') ||  Request::is('bhw/mother-census') ||  Request::is('/familyplanning')
                        ||  Request::is('bhw/wreproductiveage.index') ||  Request::is('bhw/child') ||  Request::is('bhw/deworming.index')
                        ? 'true' : ''
        @endphp
          <!-- ✅ Fixed Dashboard Link -->
          <li class="nav-item">
            <a class="nav-link border border-0 {{ Request::is('bhw/dashboard') ? 'active' : 'inactive' }}" href="{{ url('/bhw/dashboard') }}">
              <i class="bi bi-grid-fill"></i>  
              <span>Dashboard</span>
            </a>
          </li>
          <!-- ✅ Fixed Collapse Issue in My Services -->
          <li class="nav-item">
            <a class="nav-link border border-0 {{ Request::is('bhw/services') ? 'active collapsed' : 'inactive' }}"
                data-bs-toggle="collapse" href="#services-nav" aria-expanded="{{ $isService }}">
                <i class="bi bi-briefcase"></i>  
                <span>My Services</span>
                <i class=" bi bi-chevron-down ms-auto"></i> <!-- Arrow indicator -->
            </a>
            <ul id="services-nav" class="nav-content collapse {{ $isService ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
                <li><a href="{{ route('bhw.child') }}"><i class="text-white bi-person-workspace fs-6"></i><span class="text-white">Census</span></a></li>
                <li><a href="{{ route('bhw.mother-census') }}"><i class="text-white bi-person-workspace fs-6"></i><span class="text-white">Maternal Care</span></a></li>
                <li><a href="{{ route('bhw.familyplanning') }}"><i class="text-white bi-person-workspace fs-6"></i><span class="text-white">Family Planning</span></a></li>
                <li><a href="{{ route('bhw.wreproductiveage.index') }}"><i class="text-white bi-person-workspace fs-6"></i><span class="text-white">Woman in Reproductive Age</span></a></li> <!-- ✅ Fixed extra </i> -->
                <li><a href="{{ route('bhw.child') }}"><i class="text-white bi-person-workspace fs-6"></i><span class="text-white">Immunization</span></a></li>
                <li><a href="{{ route('bhw.deworming.index') }}"><i class="text-white bi-person-workspace fs-6"></i><span class="text-white">Deworming</span></a></li>
                <li><a href="{{ route('bhw.deworming.index') }}"><i class="text-white bi-person-workspace fs-6"></i><span class="text-white">Overall Monthly Report</span></a></li>
            </ul>
          </li>

          <li class="nav-item">
            <a class="nav-link border border-0 {{ Request::is('bhw/list') ? 'active' : 'inactive' }}" href="{{ url('/bhw/list') }}">
              <i class="bi bi-list-ul"></i>  
              <span>List</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link border border-0 {{ Request::is('bhw/schedule') || Request::is('bhw/duty') ? 'active' : 'inactive' }}" href="{{ url('/bhw/schedule') }}">
              <i class="bi bi-calendar-check"></i>  
              <span>Schedule</span>
            </a>
          </li>

          <!-- ✅ Fixed Announcement Button Position -->
          <li class="nav-item">
            <a href="{{ route('bhw.Announcement') }}" class="btn btn-warning w-100 mt-3">
                <i class="bi bi-bell"></i> Announcement
            </a>
          </li>
      @endif
    </ul>

    <!-- ✅ Fixed Logout Button -->
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
--}}

{{--aside id="sidebar" class="sidebar d-flex flex-column justify-content-between">
    <ul class="sidebar-nav" id="sidebar-nav">
        @auth
            @if (auth()->user()->isBHW())
                @php
                    $isServiceActive = Request::is('bhw/services', 'bhw/child', 'bhw/mother-census', 'bhw/familyplanning', 
                                                  'bhw/wreproductiveage.index', 'bhw/deworming.index');
                @endphp

                <!-- Dashboard -->
                <li class="nav-item">
                    <a class="nav-link border-0 {{ Request::is('bhw/dashboard') ? 'active' : 'inactive' }}" 
                       href="{{ route('bhw.dashboard') }}">
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <!-- My Services Dropdown -->
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
                            <a href="{{ route('bhw.child') }}" class="d-flex align-items-center">
                                <i class="bi bi-person-workspace fs-6"></i>
                                <span>Census</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('bhw.mother-census') }}" class="d-flex align-items-center">
                                <i class="bi bi-person-workspace fs-6"></i>
                                <span>Maternal Care</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('bhw.familyplanning') }}" class="d-flex align-items-center">
                                <i class="bi bi-person-workspace fs-6"></i>
                                <span>Family Planning</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('bhw.wreproductiveage.index') }}" class="d-flex align-items-center">
                                <i class="bi bi-person-workspace fs-6"></i>
                                <span>Woman in Reproductive Age</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('bhw.child') }}" class="d-flex align-items-center">
                                <i class="bi bi-person-workspace fs-6"></i>
                                <span>Immunization</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('bhw.deworming.index') }}" class="d-flex align-items-center">
                                <i class="bi bi-person-workspace fs-6"></i>
                                <span>Deworming</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('bhw.deworming.index') }}" class="d-flex align-items-center">
                                <i class="bi bi-person-workspace fs-6"></i>
                                <span>Overall Monthly Report</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- List -->
                <li class="nav-item">
                    <a class="nav-link border-0 {{ Request::is('bhw/list') ? 'active' : 'inactive' }}" 
                       href="{{ route('bhw.pages.list') }}">
                        <i class="bi bi-list-ul"></i>
                        <span>List</span>
                    </a>
                </li>

                <!-- Schedule -->
                <li class="nav-item">
                    <a class="nav-link border-0 {{ Request::is('bhw/schedule', 'bhw/duty') ? 'active' : 'inactive' }}" 
                       href="{{ route('bhw.schedule') }}">
                        <i class="bi bi-calendar-check"></i>
                        <span>Schedule</span>
                    </a>
                </li>

                <!-- Announcement -->
                <li class="nav-item mt-3">
                    <a href="{{ route('bhw.Announcement') }}" class="btn btn-warning w-100 text-start d-flex align-items-center">
                        <i class="bi bi-bell me-2"></i>
                        <span>Announcement</span>
                    </a>
                </li>
            @endif
        @endauth
    </ul>

    <!-- Logout -->
    <div class="sidebar-nav pb-3">
        <button type="button" 
                class="nav-link bg-transparent border-0 text-white w-100 text-start d-flex align-items-center" 
                data-bs-toggle="modal" 
                data-bs-target="#logoutModal">
            <i class="bi bi-arrow-bar-left me-2"></i>
            <span>Logout</span>
        </button>
    </div>
</aside>--}}


<aside id="sidebar" class="sidebar d-flex flex-column justify-content-between">
    <ul class="sidebar-nav flex-column" id="sidebar-nav">
        @auth
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
                    <span>Dashboard</span>
                </a>
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
                              <span>- Census</span>
                          </a>
                      </li>
                      <li>
                          <a href="{{ route('bhw.mother-census') }}" class="{{ Request::is('bhw/mother-census') ? 'active' : '' }}">
                              <span>- Maternal Care</span>
                          </a>
                      </li>

                      <li>
                          <a href="{{ route('bhw.deworming.index') }}" class="{{ Request::is('deworming') ? 'active' : '' }}">
                  
                              <span>- Deworming</span>
                          </a>
                      </li>
                      
                     <li>
                          <a href="{{ route('bhw.familyplanning') }}" class="{{ Request::is('familyplanning') ? 'active' : '' }}">
                       
                              <span>- Family Planning</span>
                          </a>
                      </li>
                      
                      <li>
                          <a href="{{ route('bhw.wreproductiveage.index') }}" class="{{ Request::is('wreproductiveage') ? 'active' : '' }}">
                           
                              <span>- Woman in Reproductive Age</span>
                          </a>
                      </li>
                      
                      <li>
                          <a href="{{ route('bhw.child') }}" class="{{ Request::is('bhw/child') ? 'active' : '' }}">
                
                              <span>- Immunization</span>
                          </a>
                      </li>
                      
                  
                      
                      <li>
                          <a href="{{ route('bhw.deworming.index') }}" class="{{ Request::is('bhw/deworming') ? 'active' : '' }}">
                              {{-- <i class="bi bi-person-workspace fs-6"></i> --}}
                              <span>- Overall Monthly Report</span>
                          </a>
                      </li>
                  </ul>
              </li>

                <!-- List -->
                <li class="nav-item">
                    <a class="nav-link border-0 {{ Request::is('bhw/list') ? 'active' : 'inactive' }}" 
                       href="{{ route('bhw.pages.list') }}">
                        <i class="bi bi-list-ul"></i>
                        <span>List</span>
                    </a>
                </li>

                <!-- Schedule -->
                <li class="nav-item">
                    <a class="nav-link border-0 {{ Request::is('bhw/schedule', 'bhw/duty') ? 'active' : 'inactive' }}" 
                       href="{{ route('bhw.schedule') }}">
                        <i class="bi bi-calendar-check"></i>
                        <span>Schedule</span>
                    </a>
                </li>

            @endif
        @endauth
    </ul>

    <!-- Logout -->
    <div class="sidebar-nav">
        <button type="button" 
                class="nav-link bg-transparent border-0 text-white collapsed" 
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

