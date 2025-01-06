@Section('title', 'PazaRoom - Prijavi se')
<x-layout>
    <div class="flex items-center justify-center min-h-screen bg-gradient-to-r from-white to-blue-500">
        <div
            class="flex bg-white rounded-lg shadow-2xl overflow-hidden w-3/4 md:w-1/2 animate-slideIn transform hover:scale-[1.02] transition-all duration-300 ease-out">
            <!-- Form Section -->
            <div class="w-full p-8 animate-fadeIn">
                <h2 class="text-2xl font-bold text-center mb-6 text-gray-800 animate-slideDown">Prijavite se</h2>
                <form action="{{ route('authenticate') }}" method="POST" class="space-y-4" id="form">
                    @csrf
                    <div class="animate-slideRight" style="--delay: 200ms">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="email" name="email" required
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2
                                      transition-all duration-300 ease-in-out
                                      focus:ring-2 focus:ring-blue-500 focus:border-transparent
                                      hover:border-blue-300"
                            placeholder="vaš@email.com" value="{{ old('email') }}">
                        @error('email')
                            <span class="text-red-500 text-sm animate-shake">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="animate-slideRight" style="--delay: 400ms">
                        <label for="password" class="block text-sm font-medium text-gray-700">Lozinka</label>
                        <input type="password" id="password" name="password" required
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2
                                      transition-all duration-300 ease-in-out
                                      focus:ring-2 focus:ring-blue-500 focus:border-transparent
                                      hover:border-blue-300"
                            placeholder="Vaša lozinka">
                        @error('password')
                            <span class="text-red-500 text-sm animate-shake">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" id="submit-button"
                        class="w-full bg-blue-600 text-white rounded-md py-2 mt-6
                                   transform transition-all duration-300 ease-out
                                   hover:bg-blue-500 hover:scale-105 hover:shadow-lg
                                   focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2
                                   animate-slideUp"
                        style="--delay: 600ms">
                        Prijavi se
                        <i class="fa-solid fa-user"></i>
                    </button>
                </form>

                <p class="mt-4 text-center text-sm text-gray-600 animate-fadeIn" style="--delay: 800ms">
                    Nemate račun?
                    <a href="{{ route('register') }}"
                        class="text-blue-600 hover:text-blue-500 transition-colors duration-300
                              hover:underline">
                        Registrujte se ovde
                        <i class="fa-solid fa-chevron-right"></i>
                    </a>
                </p>
            </div>

            <!-- Image Section with Ken Burns effect -->
            <div class="hidden md:block w-1/2 bg-cover bg-center animate-kenburns"
                style="background-image: url('{{ asset('images/login-photo.jpg') }}');">
            </div>
            @include('partials._loader')
        </div>
    </div>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}"></link>
    <script src="{{ asset('js/loading.js') }}"></script>
</x-layout>
