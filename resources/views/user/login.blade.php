@Section('title', 'PazaRoom - Prijavi se')
<x-layout>
    <div class="login-container">
        <div class="login-form-container">
            <!-- Form Section -->
            <div class="form-section">
                <h2 class="form-title">Prijavite se</h2>
                <form action="{{ route('authenticate') }}" method="POST" class="form" id="form">
                    @csrf
                    <div class="input-field" style="--delay: 200ms">
                        <label for="email" class="input-label">Email</label>
                        <input type="email" id="email" name="email" required
                            class="input"
                            placeholder="vaš@email.com" value="{{ old('email') }}">
                        @error('email')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-field" style="--delay: 400ms">
                        <label for="password" class="input-label">Lozinka</label>
                        <input type="password" id="password" name="password" required
                            class="input"
                            placeholder="Vaša lozinka">
                        @error('password')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" id="submit-button" class="submit-button" style="--delay: 600ms">
                        Prijavi se
                        <i class="fa-solid fa-user"></i>
                    </button>
                </form>

                <p class="register-link" style="--delay: 800ms">
                    Nemate profil?
                    <a href="{{ route('register') }}" class="register-text">
                        Registrujte se ovde
                        <i class="fa-solid fa-chevron-right"></i>
                    </a>
                </p>
            </div>

            <!-- Image Section with Ken Burns effect -->
            <div class="image-section" style="background-image: url('{{ asset('images/login-photo.jpg') }}');">
            </div>
            @include('partials._loader')
        </div>
    </div>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}"></link>
    <script src="{{ asset('js/loading.js') }}"></script>
</x-layout>
