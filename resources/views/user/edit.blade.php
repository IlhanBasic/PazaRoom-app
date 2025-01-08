@Section('title', 'PazaRoom - Izmeni profil')
<x-layout>
    <div class="edit-user-container">
        <div class="edit-user-form">
            <!-- Image Section with Ken Burns effect -->
            <div class="edit-user-image-section">
            </div>

            <!-- Form Section -->
            <div class="edit-user-form-content">
                <h2 class="edit-user-form-title">Izmenite profil</h2>
                <form action="{{ route('update_user', $user) }}" method="POST" class="edit-user-form-fields" id="form">
                    @csrf
                    <div class="edit-user-form-group">
                        <label for="first_name" class="edit-user-label">Ime</label>
                        <input type="text" id="first_name" name="first_name" required 
                               class="edit-user-input-field" 
                               placeholder="Vaše ime" value="{{ $user->first_name }}">
                        @error('first_name')
                            <span class="edit-user-error-message">{{ $message }}</span>
                        @enderror
                    </div>
            
                    <div class="edit-user-form-group">
                        <label for="last_name" class="edit-user-label">Prezime</label>
                        <input type="text" id="last_name" name="last_name" required 
                               class="edit-user-input-field" 
                               placeholder="Vaše prezime" value="{{ $user->last_name }}">
                        @error('last_name')
                            <span class="edit-user-error-message">{{ $message }}</span>
                        @enderror
                    </div>
            
                    <div class="edit-user-form-group">
                        <label for="phone_number" class="edit-user-label">Broj telefona</label>
                        <input type="text" id="phone_number" name="phone_number" 
                               class="edit-user-input-field" 
                               placeholder="Vaš broj telefona (opcionalno)" value="{{ $user->phone_number }}">
                        @error('phone_number')
                            <span class="edit-user-error-message">{{ $message }}</span>
                        @enderror
                    </div>
            
                    <div class="edit-user-form-group">
                        <label for="current_password" class="edit-user-label">Trenutna lozinka (opcionalno)</label>
                        <input type="password" id="current_password" name="current_password" 
                               class="edit-user-input-field" 
                               placeholder="Unesite trenutnu lozinku ako želite da je promenite">
                        @error('current_password')
                            <span class="edit-user-error-message">{{ $message }}</span>
                        @enderror
                    </div>
            
                    <div class="edit-user-form-group">
                        <label for="new_password" class="edit-user-label">Nova lozinka (opcionalno)</label>
                        <input type="password" id="new_password" name="new_password" 
                               class="edit-user-input-field" 
                               placeholder="Unesite novu lozinku">
                        @error('new_password')
                            <span class="edit-user-error-message">{{ $message }}</span>
                        @enderror
                    </div>
            
                    <div class="edit-user-form-group">
                        <label for="new_password_confirmation" class="edit-user-label">Potvrdite novu lozinku</label>
                        <input type="password" id="new_password_confirmation" name="new_password_confirmation" 
                               class="edit-user-input-field" 
                               placeholder="Ponovo unesite novu lozinku">
                        @error('new_password_confirmation')
                            <span class="edit-user-error-message">{{ $message }}</span>
                        @enderror
                    </div>
            
                    <button type="submit" 
                            id="submit-button"
                            class="edit-user-submit-button">
                        Sačuvajte izmene
                        <i class="fa fa-save ml-2"></i>
                    </button>
                </form>
            </div>
            @include('partials._loader')
        </div>
    </div>
    <link rel="stylesheet" href="{{ asset('css/edit-user.css') }}">
    <script src="{{ asset('js/loading.js') }}" defer></script>
</x-layout>
