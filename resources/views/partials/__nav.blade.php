<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

        <a href="{{ url('/') }}" class="logo d-flex align-items-center me-auto">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <img src="{{ isset($appInfo->logo) ? asset('storage/'.$appInfo->logo) : asset('img/logo.png') }}" alt="">
            <h1 class="sitename">{{ isset($appInfo->app_name) ? $appInfo->app_name : 'COCO SPOT' }}</h1>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="{{ url('/') }}" class="active">Home<br></a></li>
                {{--  <li class="dropdown"><a href="#"><span>About us</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>   --}}
                <li class="dropdown"><a href="#"><span>About us</span></a>

                    <ul>
                       {{-- <li><a href="{{ url('/about') }}">About us</a></li>
                        <li><a href="{{ url('/mission_vision') }}">Mission and Vision</a></li>
                        <li><a href="{{ url('/announcement') }}">Announcements</a></li> --}}
                        {{-- <li><a href="{{ url('/guidelines') }}">Guidelines to visit</a></li> --}}
                        {{--<li><a href="{{ url('/contact') }}">Contact us</a></li> --}}
                    </ul>
                </li>
                <li class="dropdown"><a href="#services"><span>Services</span></a>
                    <ul style="display: none">
                        <li><a href="{{ url('/register') }}">Request a visit</a></li>
                    </ul>
                </li>
                <li><a href="{{ url('/contact') }}">Contact us</a></li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

       {{-- <a class="btn-getstarted" href="{{ url('/login') }}">Get Started</a> --}} 

    </div>
</header>
