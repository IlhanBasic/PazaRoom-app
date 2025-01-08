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
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="{{ asset('js/toggleNavbar.js') }}" defer></script>
    <!-- Lightbox2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
    <!-- Lightbox2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

</head>

<body class="bg-gray-100 font-roboto">

    <!-- Navigaciona traka -->
    <x-flash-message />
    <nav class="bg-white shadow gradient-bg relative z-50">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <div class="text-2xl font-bold text-white flex items-center">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="logo" class="h-16 w-auto">
                </a>
            </div>

            <!-- Hamburger Icon -->
            <div class="md:hidden">
                <button id="hamburger" class="text-white focus:outline-none" onclick="toggleMenu()">
                    <i class="fas fa-bars"></i>
                </button>
            </div>

            <!-- Menu -->
            <div class="hidden md:flex space-x-4 z-20">
                <a href="{{ route('home') }}" class="text-gray-200 hover:text-white">Home </a>
                @if (Auth::check())
                    @if(Auth::user()->role->name == 'Admin')
                    <a href="{{ route('admin') }}"
                        class="text-gray-200 hover:text-white">Dashboard <i class="fa-solid fa-wrench"></i></a>
                    @endif
                    @if(Auth::user()->role->name == 'Vlasnik')
                    <a href="{{ route('owner_properties', Auth::user()) }}"
                        class="text-gray-200 hover:text-white">Moj smeštaj <i
                            class="fas fa-home"></i></a>
                    @endif
                @endif  

                @if (Auth::check())
                    <!-- User Dropdown -->
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open"
                            class="flex items-center text-gray-200 hover:text-white focus:outline-none">
                            Korisnik <i class="fas fa-user-circle ml-2"></i>
                        </button>
                        <div x-show.transition.opacity.duration.300ms="open" @click.away="open = false"
                            class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-50"
                            style="display: none;">
                            <a href="{{ route('show_user', Auth::user()->id) }}"
                                class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Profil <i
                                    class="fas fa-user"></i></a>
                            @if(Auth::user()->role->name == 'Vlasnik')
                            <a href="{{ route('properties_create') }}"
                                class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Dodaj smeštaj <i
                                    class="fas fa-add"></i></a>
                            @endif
                            <form action="{{ route('logout') }}" method="GET" style="display:inline;">
                                @csrf
                                <button type="submit"
                                    class="block w-full text-left px-4 py-2 text-gray-800 hover:bg-gray-100">
                                    Odjavi se <i class="fas fa-sign-out-alt"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-gray-200 hover:text-white">Prijava <i
                            class="fas fa-sign-in-alt"></i></a>
                    <a href="{{ route('register') }}" class="text-gray-200 hover:text-white">Registracija <i
                            class="fas fa-user-plus"></i></a>
                @endif
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu"
            class="md:hidden bg-white shadow-lg absolute w-full z-10 hidden transition-all duration-300 ease-in-out">
            <div class="flex flex-col p-4 space-y-2 z-10">
                <a href="{{ route('home') }}" class="text-gray-800 hover:bg-gray-100 py-2 px-4 rounded">Home</a>
                @if (Auth::check())
                    @if(Auth::user()->role->name != 'Admin')
                    <a href="{{ route('owner_properties', Auth::user()) }}"
                        class="text-gray-800 hover:bg-gray-100 py-2 px-4 rounded">Moj smeštaj <i
                            class="fas fa-home"></i></a>
                    @endif
                @endif

                @if (Auth::check())
                    <a href="{{ route('show_user', Auth::user()->id) }}"
                        class="text-gray-800 hover:bg-gray-100 py-2 px-4 rounded">Profil <i class="fas fa-user"></i>
                    </a>
                    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="text-gray-800 hover:bg-gray-100 py-2 px-4 rounded">Odjavi
                            se <i class="fas fa-sign-out-alt"></i></button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                        class="text-gray-800 hover:bg-gray-100 py-2 px-4 rounded">Prijava</a>
                    <a href="{{ route('register') }}"
                        class="text-gray-800 hover:bg-gray-100 py-2 px-4 rounded">Registracija</a>
                @endif
            </div>
        </div>
    </nav>

    <!-- Glavni sadržaj -->
    <main>
        {{ $slot }}
    </main>

    <!-- Podnožje -->
    <footer class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 py-6 text-center">
            <p class="text-gray-600">&copy; {{ date('Y') }} Izdavanje Stanova. Sva prava zadržana.</p>
            <div class="flex justify-center space-x-4 mt-2">
                <a href="{{ url('/policy') }}" class="text-gray600 hover:text-blue500">Politika privatnosti</a>
                <a href="{{ url('/conditions') }}" class="text-gray600 hover:text-blue500">Uslovi korišćenja</a>
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
    <script src="{{ asset('js/scrollButton.js') }}"></script>
</body>

</html>
