@Section('title', 'PazaRoom - Izmeni profil')
<x-layout>
    <div class="flex items-center justify-center py-12 bg-gradient-to-r from-white to-blue-500 min-h-screen z-0">
        <div class="flex bg-white rounded-lg shadow-2xl overflow-hidden w-3/4 md:w-1/2 transform hover:scale-[1.02] transition-all duration-300 ease-out">
            <!-- Image Section with Ken Burns effect -->
            <div class="md:block w-1/2 bg-cover bg-center animate-kenburns" 
                 style="background-image: url('{{asset('images/profile-photo.jpg')}}');">
            </div>

            <!-- Form Section -->
            <div class="w-full p-8 animate-fadeIn">
                <h2 class="text-2xl font-bold text-center mb-6 animate-slideDown">Izmenite profil</h2>
                <form action="{{ route('update_user', $user) }}" method="POST" class="space-y-4" id="form">
                    @csrf
                    <div class="animate-slideRight" style="--delay: 100ms">
                        <label for="first_name" class="block text-sm font-medium text-gray-700">Ime</label>
                        <input type="text" id="first_name" name="first_name" required 
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2
                                      transition-all duration-300 ease-in-out
                                      focus:ring-2 focus:ring-blue-500 focus:border-transparent
                                      hover:border-blue-300"
                               placeholder="Vaše ime" value="{{ $user->first_name }}">
                        @error('first_name')
                            <span class="text-red-500 text-sm animate-shake">{{ $message }}</span>
                        @enderror
                    </div>
            
                    <div class="animate-slideRight" style="--delay: 200ms">
                        <label for="last_name" class="block text-sm font-medium text-gray-700">Prezime</label>
                        <input type="text" id="last_name" name="last_name" required 
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2
                                      transition-all duration-300 ease-in-out
                                      focus:ring-2 focus:ring-blue-500 focus:border-transparent
                                      hover:border-blue-300"
                               placeholder="Vaše prezime" value="{{ $user->last_name }}">
                        @error('last_name')
                            <span class="text-red-500 text-sm animate-shake">{{ $message }}</span>
                        @enderror
                    </div>
            
                    <div class="animate-slideRight" style="--delay: 300ms">
                        <label for="phone_number" class="block text-sm font-medium text-gray-700">Broj telefona</label>
                        <input type="text" id="phone_number" name="phone_number" 
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2
                                      transition-all duration-300 ease-in-out
                                      focus:ring-2 focus:ring-blue-500 focus:border-transparent
                                      hover:border-blue-300"
                               placeholder="Vaš broj telefona (opcionalno)" value="{{ $user->phone_number }}">
                        @error('phone_number')
                            <span class="text-red-500 text-sm animate-shake">{{ $message }}</span>
                        @enderror
                    </div>
            
                    <div class="animate-slideRight" style="--delay: 500ms">
                        <label for="current_password" class="block text-sm font-medium text-gray-700">Trenutna lozinka (opcionalno)</label>
                        <input type="password" id="current_password" name="current_password" 
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2
                                      transition-all duration-300 ease-in-out
                                      focus:ring-2 focus:ring-blue-500 focus:border-transparent
                                      hover:border-blue-300"
                               placeholder="Unesite trenutnu lozinku ako želite da je promenite">
                        @error('current_password')
                            <span class="text-red-500 text-sm animate-shake">{{ $message }}</span>
                        @enderror
                    </div>
            
                    <div class="animate-slideRight" style="--delay: 600ms">
                        <label for="new_password" class="block text-sm font-medium text-gray-700">Nova lozinka (opcionalno)</label>
                        <input type="password" id="new_password" name="new_password" 
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2
                                      transition-all duration-300 ease-in-out
                                      focus:ring-2 focus:ring-blue-500 focus:border-transparent
                                      hover:border-blue-300"
                               placeholder="Unesite novu lozinku">
                        @error('new_password')
                            <span class="text-red-500 text-sm animate-shake">{{ $message }}</span>
                        @enderror
                    </div>
            
                    <div class="animate-slideRight" style="--delay: 700ms">
                        <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700">Potvrdite novu lozinku</label>
                        <input type="password" id="new_password_confirmation" name="new_password_confirmation" 
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2
                                      transition-all duration-300 ease-in-out
                                      focus:ring-2 focus:ring-blue-500 focus:border-transparent
                                      hover:border-blue-300"
                               placeholder="Ponovo unesite novu lozinku">
                        @error('new_password_confirmation')
                            <span class="text-red-500 text-sm animate-shake">{{ $message }}</span>
                        @enderror
                    </div>
            
                    <button type="submit" 
                            id="submit-button"
                            class="w-full bg-blue-600 text-white rounded-md py-2 mt-6
                                   transform transition-all duration-300 ease-out
                                   hover:bg-blue-500 hover:scale-105 hover:shadow-lg
                                   focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2
                                   animate-slideUp">
                        Sačuvajte izmene
                        <i class="fa fa-save ml-2"></i>
                    </button>
                </form>
            </div>
            @include('partials._loader')
        </div>
    </div>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <script src="{{ asset('js/loading.js') }}" defer></script>
</x-layout>