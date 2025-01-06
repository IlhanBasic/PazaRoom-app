<section class="relative flex flex-col justify-center items-center overflow-hidden h-96">
    <!-- Hero Section for Logged-in Users -->
    @auth
        <!-- Dynamic Background for Logged-in Users -->
        <div class="absolute top-0 left-0 w-full h-full">
            <!-- Black opacity layer -->
            <div class="absolute inset-0 bg-black opacity-50 z-10"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-black/90 to-transparent z-0"></div>
            <div class="absolute inset-0 bg-cover bg-center animate-scale-slow"
            style='background-image: url({{ asset("images/hero-banner.jpg") }});'>
            </div>
        </div>

        <!-- Content Container for Logged-in Users -->
        <div class="relative z-10 container mx-auto px-4 text-center space-y-6">
            <!-- Logo Animation -->
            <div class="animate-slideDown" style="--delay: 200ms">
                <h1 class="text-5xl sm:text-4xl md:text-6xl font-bold tracking-tighter mb-2 text-white">
                    Dobrodošli, <span class="text-blue-400">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>
                </h1>
            </div>

            <!-- Tagline -->
            <div class="animate-slideUp" style="--delay: 400ms">
                <p class="text-lg sm:text-sm md:text-xl text-white font-light">
                    Uživajte u istraživanju ponude.
                </p>
            </div>
        </div>
    @endauth

    <!-- Hero Section for Guests -->
    @guest
        <!-- Dynamic Background for Guests -->
        <div class="absolute top-0 left-0 w-full h-full">
            <!-- Black opacity layer -->
            <div class="absolute inset-0 bg-black opacity-50 z-10"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-black/90 to-transparent z-0"></div>
            <div class="absolute inset-0 bg-cover bg-center animate-scale-slow"
                style="background-image: url('https://plus.unsplash.com/premium_photo-1676321046262-4978a752fb15?q=80&w=2071&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');">
            </div>
        </div>

        <!-- Content Container for Guests -->
        <div class="relative z-10 container mx-auto px-4 text-center space-y-6">
            <!-- Logo Animation -->
            <div class="animate-slideDown" style="--delay: 200ms">
                <h1
                    class="text-5xl sm:text-4xl md:text-6xl font-bold tracking-tighter mb-2 text-transparent bg-clip-text bg-gradient-to-r from-blue-500 to-white">
                    Paza<span class="text-blue-400">Room</span>
                </h1>
            </div>

            <!-- Tagline -->
            <div class="animate-slideUp" style="--delay: 400ms">
                <p class="text-lg sm:text-sm md:text-xl text-white font-light">
                    Istražite široku ponudu stanova za iznajmljivanje u Novom Pazaru.
                </p>
            </div>

            <!-- CTA Button -->
            <div class="animate-fadeIn" style="--delay: 600ms">
                <a href="{{ route('register') }}"
                    class="group relative inline-flex items-center justify-center px-6 py-3 sm:px-4 sm:py-2 text-base md:text-lg font-medium">
                    <span
                        class="absolute inset-0 w-full h-full transition-all duration-300 ease-out transform translate-x-0 -skew-x-12 bg-blue-500 group-hover:bg-blue-700 group-hover:skew-x-12"></span>
                    <span
                        class="absolute inset-0 w-full h-full transition-all duration-300 ease-out transform skew-x-12 bg-blue-700 group-hover:bg-blue-500 group-hover:-skew-x-12"></span>
                    <span class="relative text-white">Registrujte se</span>
                </a>
            </div>
        </div>
    @endguest
</section>
