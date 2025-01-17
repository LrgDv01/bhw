<header id="header" class="header d-flex align-items-center sticky-top bg-transparent">
    <div class="container-fluid container-xl position-relative d-flex flex-row-reverse align-items-end">
        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="{{ url('/') }}" class="active">Home<br></a></li>
                {{--  <li class="dropdown"><a href="#"><span>About us</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>   --}}
                <li><a href="{{ url('/about') }}"><span>About us</span></a>
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
