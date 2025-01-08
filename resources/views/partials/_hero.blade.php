<section class="hero-section">
    <!-- Hero Section for Logged-in Users -->
    @auth
        <!-- Dynamic Background for Logged-in Users -->
        <div class="background-layer">
            <div class="overlay"></div>
            <div class="gradient-layer"></div>
            <div class="background-image" style='background-image: url({{ asset("images/hero-banner.jpg") }});'></div>
        </div>

        <!-- Content Container for Logged-in Users -->
        <div class="content-container">
            <!-- Logo Animation -->
            <div class="animate-slideDown" style="--delay: 200ms">
                <h1 class="welcome-text">
                    Dobrodošli, <span class="user-name">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>
                </h1>
            </div>

            <!-- Tagline -->
            <div class="animate-slideUp" style="--delay: 400ms">
                <p class="tagline">
                    Uživajte u istraživanju ponude.
                </p>
            </div>
        </div>
    @endauth

    <!-- Hero Section for Guests -->
    @guest
        <!-- Dynamic Background for Guests -->
        <div class="background-layer">
            <div class="overlay"></div>
            <div class="gradient-layer"></div>
            <div class="background-image" style="background-image: url('https://plus.unsplash.com/premium_photo-1676321046262-4978a752fb15?q=80&w=2071&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');"></div>
        </div>

        <!-- Content Container for Guests -->
        <div class="content-container">
            <!-- Logo Animation -->
            <div class="animate-slideDown" style="--delay: 200ms">
                <h1 class="hero-title">
                    Paza<span class="highlight">Room</span>
                </h1>
            </div>

            <!-- Tagline -->
            <div class="animate-slideUp" style="--delay: 400ms">
                <p class="tagline">
                    Istražite široku ponudu stanova za iznajmljivanje u Novom Pazaru.
                </p>
            </div>

            <!-- CTA Button -->
            <div class="animate-fadeIn" style="--delay: 600ms">
                <a href="{{ route('register') }}" class="cta-button">
                    Registrujte se
                </a>
            </div>
        </div>
    @endguest
</section>

<link rel="stylesheet" href="{{ asset('css/hero.css') }}">
