@Section('title', 'PazaRoom - Registruj se')
<x-layout>
    <div class="registration-container">
        <div class="registration-box">
            <!-- Image Section with Ken Burns effect -->
            <div class="image-section"></div>

            <!-- Form Section -->
            <div class="form-section">
                <h2 class="form-title">Registrujte se</h2>
                <form action="{{ route('register') }}" method="POST" class="form">

                    @csrf
                    <div class="form-input-container">
                        <label for="first_name" class="label">Ime</label>
                        <input type="text" id="first_name" name="first_name" required class="input-field" placeholder="Vaše ime" value="{{ old('first_name') }}">
                        @error('first_name')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-input-container">
                        <label for="last_name" class="label">Prezime</label>
                        <input type="text" id="last_name" name="last_name" required class="input-field" placeholder="Vaše prezime" value="{{ old('last_name') }}">
                        @error('last_name')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-input-container">
                        <label for="phone_number" class="label">Broj telefona</label>
                        <input type="text" id="phone_number" name="phone_number" class="input-field" placeholder="Vaš broj telefona (opcionalno)" value="{{ old('phone_number') }}">
                        @error('phone_number')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-input-container">
                        <label for="email" class="label">Email</label>
                        <input type="email" id="email" name="email" required class="input-field" placeholder="vaš@email.com" value="{{ old('email') }}">
                        @error('email')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-input-container">
                        <label for="password" class="label">Lozinka</label>
                        <input type="password" id="password" name="password" required class="input-field" placeholder="Vaša lozinka">
                        @error('password')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-input-container">
                        <label for="role_id" class="label">Vi ste</label>
                        <select id="role_id" name="role_id" required class="input-field">
                            @foreach ($roles as $role)
                                @if ($role->name == 'Admin')
                                    @continue
                                @endif
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                        @error('role_id')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" id="submit-button" class="submit-btn">
                        Registrujte se
                        <i class="fa-solid fa-user-plus"></i>
                    </button>
                </form>
                <p class="login-link">
                    Već imate račun? <a href="{{ route('login') }}">Prijavite se ovde</a>
                </p>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <script src="{{ asset('js/loading.js') }}" defer></script>
</x-layout>
