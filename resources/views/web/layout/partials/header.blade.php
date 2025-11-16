<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid position-relative d-flex align-items-center justify-content-between">

        <a href="{{ route('home') }}" class="logo d-flex align-items-center me-auto me-xl-0">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <img src="assets/img/logo.png" alt="">
            <h1 class="sitename">AlRaad</h1>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li>
                    <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">
                        Home
                    </a>
                </li>

                <li>
                    <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">
                        About
                    </a>
                </li>

                <li class="dropdown">
                    <a href="{{ route('services.all') }}"
                        class="{{ request()->routeIs('services.*') ? 'active' : '' }}">
                        <span>Services</span>
                        <i class="bi bi-chevron-down toggle-dropdown"></i>
                    </a>

                    <ul>
                        <li><a href="#">Signboards</a></li>
                        <li><a href="#">Furniture & Interior Design</a></li>
                        <li><a href="#">Branding & Digital Printing</a></li>
                        <li><a href="#">Booths & Kiosks</a></li>
                        <li><a href="#">Stands & Gondolas</a></li>
                        <li><a href="#">Creative Consultancy</a></li>
                    </ul>
                </li>

                <li>
                    <a href="{{ route('project.all') }}" class="{{ request()->routeIs('project.*') ? 'active' : '' }}">
                        Projects
                    </a>
                </li>

                <li>
                    <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">
                        Contact
                    </a>
                </li>
            </ul>

            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>


        <div class="header-social-links">
            <a href="#" class="twitter"><i class="bi bi-twitter-x"></i></a>
            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
        </div>

    </div>
</header>
