<header id="header" class="header d-flex align-items-center sticky-top bg-transparent d-block">
    <div class="container-fluid container-xl position-relative d-flex flex-row-reverse align-items-end">
        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="{{ url('/') }}" class="active"><br></a></li>
                {{--  <li class="dropdown"><a href="#"><span></span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>   --}}
                <li><a href="{{ url('/about') }}"><span></span></a>
                    <ul>
                       {{-- <li><a href="{{ url('/about') }}"></a></li>
                        <li><a href="{{ url('/mission_vision') }}"></a></li>
                        <li><a href="{{ url('/announcement') }}"></a></li> --}}
                        {{-- <li><a href="{{ url('/guidelines') }}"></a></li> --}}
                        {{--<li><a href="{{ url('/contact') }}"></a></li> --}}
                    </ul>
                </li>
                <li class="dropdown"><a href="#services"><span></span></a>
                    <ul style="display: none">
                        <li><a href="{{ url('/register') }}"></a></li>
                    </ul>
                </li>
                <li><a href="{{ url('/contact') }}"></a></li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

       {{-- <a class="btn-getstarted" href="{{ url('/login') }}">Get Started</a> --}} 

    </div>
</header>
