<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
      <a href="{{ url('/user/home') }}" class="logo d-flex align-items-center justify-content-center">
        {{-- <img src="{{ URL::asset('img/admin-profile.png') }}" alt=""> --}}
        {{--<span class="d-none d-lg-block">{{ isset($appInfo->app_name) ? $appInfo->app_name : "BHW" }} BHW</span>--}}
        <span class="d-none d-lg-block"> BHW</span>

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

              <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->user_name }}</span>
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
            </ul><!-- End Profile Dropdown Items -->
          </div>
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header>
  
  <aside id="sidebar" class="sidebar d-flex flex-column justify-content-between" style="background-color:#134125">
    <ul class="sidebar-nav" id="sidebar-nav">
      @if (auth()->user()->isBHW())
        <li class="nav-item">
          <a class="nav-link bg-transparent border border-0 text-white " href="{{ url('/user/farm') }}">
            <i class="bi bi-house text-white"></i>  
            <span>Services</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link bg-transparent border border-0 text-white " href="{{ url('/user/services') }}">
            <i class="bi bi-briefcase text-white"></i>  
            <span>List</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link bg-transparent border border-0 text-white " href="{{ url('/user/farmer/settings') }}">
            <i class="bi bi-gear text-white"></i>  
            <span>Schedule</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link bg-transparent border border-0 text-white " href="{{ url('/user/farmer/settings') }}">
            <i class="bi bi-gear text-white"></i>  
            <span>User Activity</span>
          </a>
        </li>
      @endif
    
    </ul>
    <div class="sidebar-nav">
   {{--   <form action="{{ route('logout') }}" id="logoutform" method="POST">
        @csrf
      </form>
      <button form="logoutform" type="submit" class="nav-link bg-transparent border border-0 text-white collapsed">
        <i class="text-white bi bi-arrow-bar-left"></i>
        <span>Logout</span>
      </button>--}}
        {{-- <form action="{{ route('logout') }}" id="logoutform" method="POST">  --}}
       
        <form action="{{ route('logout') }}" id="logoutform" method="POST">
          @csrf
          <button type="submit" class="nav-link bg-transparent border border-0 text-white collapsed">
            <i class="text-white bi bi-arrow-bar-left"></i>
            <span>Logout</span>
          </button>
        </form>
    </div>
  </aside>

  <form action="{{ route('logout') }}" id="logoutform" method="POST">
    @csrf
  </form>
