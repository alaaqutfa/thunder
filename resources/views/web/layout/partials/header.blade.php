<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid position-relative d-flex align-items-center justify-content-between">

        <a href="{{ route('home') }}" class="logo d-flex align-items-center me-auto me-xl-0">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <img src="{{ asset('public/assets/img/logo.png') }}" alt="AlRaad Logo" />
            <h1 class="sitename">AlRaad</h1>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>

                @auth
                    @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                        <li class="dropdown">
                            <a href="{{ route('admin.dashboard') }}"
                                class="flex items-center gap-2 {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                                <i class="bi bi-speedometer2"></i>
                                <span>Dashboard</span>
                                <i class="bi bi-chevron-down toggle-dropdown"></i>
                            </a>

                            <ul>
                                <li>
                                    <a href="{{ route('admin.projects.index') }}">
                                        Projects Management
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.services.index') }}">
                                        Services Management
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.brands.index') }}">
                                        Brands Management
                                    </a>
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                        @csrf
                                        <button type="submit" class="w-full">
                                            <a href="#" style="justify-content: flex-start;gap: 0.5rem;">
                                                <i class="bi bi-box-arrow-right"></i>
                                                Log out
                                            </a>
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                @endauth
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
                        @php($services = get_services())
                        @foreach ($services as $service)
                            <li>
                                <a href="{{ route('services.details', $service->slug) }}">
                                    {{ $service->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>

                <li>
                    <a href="{{ route('project.all') }}"
                        class="{{ request()->routeIs('project.*') ? 'active' : '' }}">
                        Projects
                    </a>
                </li>

                <li>
                    <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">
                        Contact
                    </a>
                </li>
                <li>
                    <a href="{{ asset('public/assets/pdf/AlRaad Profile 2025.pdf') }}" class="gap-1" download>
                        <i class="bi bi-filetype-pdf"></i>
                        <span>Download Catalog</span>
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
