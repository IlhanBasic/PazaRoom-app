<!DOCTYPE html>
<html lang="hr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PazaRoom - Izdavanje stanova za studente')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">
    <script src="//unpkg.com/alpinejs" defer></script>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="{{ asset('js/toggleNavbar.js') }}" defer></script>
    <!-- Lightbox2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
    <!-- Lightbox2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
</head>

<body>
    <!-- Navigation -->
    <x-flash-message />
    <nav class="nav">
        <div class="nav-container">
            <div class="nav-logo">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="logo">
                </a>
            </div>

            <!-- Hamburger Icon -->
            <button class="hamburger" id="hamburger" onclick="toggleMenu()">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Menu -->
            <div class="nav-menu">
                <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                    Home <i class="fa-solid fa-house-chimney icon"></i>
                </a>
                <a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}">
                    About <i class="fas fa-info icon"></i>
                </a>
                <a href="{{ route('blogs') }}" class="nav-link {{ request()->routeIs('blogs') ? 'active' : '' }}">
                    Blog <i class="fas fa-newspaper icon"></i>
                </a>
                <a href="{{ route('contact') }}"
                class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">
                Kontakt <i class="fas fa-phone icon"></i>
                </a>
                @if (Auth::check())
                    @if (Auth::user()->role->name == 'Admin')
                        <a href="{{ route('admin') }}" class="nav-link">
                            Dashboard <i class="fa-solid fa-wrench icon"></i>
                        </a>
                    @endif
                    @if (Auth::user()->role->name == 'Vlasnik')
                        <a href="{{ route('owner_properties', Auth::user()) }}" class="nav-link">
                            Moj smeštaj <i class="fas fa-home icon"></i>
                        </a>
                    @endif
                @endif

                @if (Auth::check())
                    <!-- User Dropdown -->
                    <div class="user-dropdown">
                        <button id="dropdownButton" class="dropdown-button">
                            Korisnik <i class="fas fa-user-circle icon"></i>
                        </button>
                        <div id="dropdownMenu" class="dropdown-menu" style="display: none;">
                            <a href="{{ route('show_user', Auth::user()->id) }}" class="dropdown-item">
                                Profil <i class="fas fa-user icon"></i>
                            </a>
                            @if (Auth::user()->role->name == 'Vlasnik')
                                <a href="{{ route('properties_create') }}" class="dropdown-item">
                                    Dodaj smeštaj <i class="fas fa-add icon"></i>
                                </a>
                            @elseif(Auth::user()->role->name == 'Student')
                                <a href="{{ route('favorites', Auth::user()) }}" class="dropdown-item">
                                    Favorites <i class="fas fa-heart icon"></i>
                                </a>
                            @endif
                            <a href="{{ route('logout') }}" class="dropdown-item">
                                Odjavi se <i class="fas fa-sign-out-alt icon"></i>
                            </a>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="nav-link">
                        Prijava <i class="fas fa-sign-in-alt icon"></i>
                    </a>
                    <a href="{{ route('register') }}" class="nav-link">
                        Registracija <i class="fas fa-user-plus icon"></i>
                    </a>
                @endif
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="mobile-menu">
            <div class="mobile-menu-items">
                <a href="{{ route('home') }}" class="mobile-link">
                    Home <i class="fa-solid fa-house-chimney icon"></i>
                </a>
                <a href="{{ route('about') }}" class="mobile-link">
                    About <i class="fas fa-info icon"></i>
                </a>
                <a href="{{ route('blogs') }}" class="mobile-link">
                    Blog <i class="fas fa-newspaper icon"></i>
                </a>
                <a href="{{ route('contact') }}" class="mobile-link">
                    Kontakt <i class="fas fa-phone icon"></i>
                </a>

                @if (Auth::check())
                    @if (Auth::user()->role->name === 'Vlasnik')
                        <a href="{{ route('owner_properties', Auth::user()) }}" class="mobile-link">
                            Moj smeštaj <i class="fas fa-home icon"></i>
                        </a>
                        <a href="{{ route('properties_create') }}" class="mobile-link">
                            Dodaj smeštaj <i class="fas fa-add icon"></i>
                        </a>
                    @endif
                    @if (Auth::user()->role->name == 'Student')
                        <a href="{{ route('favorites', Auth::user()) }}" class="mobile-link">
                            Favorites <i class="fas fa-heart icon"></i>
                        </a>
                    @endif
                    @if (Auth::user()->role->name == 'Admin')
                        <a href="{{ route('admin') }}" class="mobile-link">
                            Dashboard <i class="fa-solid fa-wrench icon"></i>
                        </a>
                    @endif
                @endif

                @if (Auth::check())
                    <a href="{{ route('show_user', Auth::user()->id) }}" class="mobile-link">
                        Profil <i class="fas fa-user icon"></i>
                    </a>
                    <a href="{{ route('logout') }}" class="mobile-link">
                        Odjavi se <i class="fas fa-sign-out-alt icon"></i>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="mobile-link">
                        Prijava <i class="fas fa-sign-in-alt icon"></i>
                    </a>
                    <a href="{{ route('register') }}" class="mobile-link">
                        Registracija <i class="fas fa-user-plus icon"></i>
                    </a>
                @endif
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="slot">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <p class="footer-text">&copy; {{ date('Y') }} Izdavanje Stanova. Sva prava zadržana PazaRoom.</p>
            <div class="footer-links">
                <a href="{{ url('/policy') }}" class="footer-link">Politika privatnosti</a>
                <a href="{{ url('/conditions') }}" class="footer-link">Uslovi korišćenja</a>
                <a href="{{ url('/faq') }}" class="footer-link">FAQ</a>
            </div>
        </div>
    </footer>
    @include('partials._scroll-button')
    <script>
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true
        })
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dropdownButton = document.getElementById('dropdownButton');
            const dropdownMenu = document.getElementById('dropdownMenu');
            dropdownButton.addEventListener('click', function() {
                if (dropdownMenu.style.display === 'none' || dropdownMenu.style.display === '') {
                    dropdownMenu.style.display = 'block';
                } else {
                    dropdownMenu.style.display = 'none';
                }
            });
            document.addEventListener('click', function(event) {
                if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                    dropdownMenu.style.display = 'none';
                }
            });
        });
    </script>

    <script src="{{ asset('js/scrollButton.js') }}"></script>
</body>

</html>
