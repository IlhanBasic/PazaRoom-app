@Section('title', 'PazaRoom - Registruj se')
<x-layout>
    <div class="flex items-center justify-center py-12 bg-gradient-to-r from-white to-blue-500 min-h-screen">
        <div
            class="flex bg-white rounded-lg shadow-2xl overflow-hidden w-3/4 md:w-1/2 transform hover:scale-[1.02] transition-all duration-300 ease-out">
            <!-- Image Section with Ken Burns effect -->
            <div class="md:block w-1/2 bg-cover bg-center animate-kenburns"
                style="background-image: url('{{ asset('images/register-photo.jpg') }}');">
            </div>

            <!-- Form Section -->
            <div class="w-full p-8 animate-fadeIn">
                <h2 class="text-2xl font-bold text-center mb-6 animate-slideDown">Registrujte se</h2>
                <form action="{{ route('register_user') }}" method="POST" class="space-y-4" id="form">
                    @csrf
                    <div class="animate-slideRight" style="--delay: 100ms">
                        <label for="first_name" class="block text-sm font-medium text-gray-700">Ime</label>
                        <input type="text" id="first_name" name="first_name" required
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2
                                      transition-all duration-300 ease-in-out
                                      focus:ring-2 focus:ring-blue-500 focus:border-transparent
                                      hover:border-blue-300"
                            placeholder="Vaše ime" value="{{ old('first_name') }}">
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
                            placeholder="Vaše prezime" value="{{ old('last_name') }}">
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
                            placeholder="Vaš broj telefona (opcionalno)" value="{{ old('phone_number') }}">
                        @error('phone_number')
                            <span class="text-red-500 text-sm animate-shake">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="animate-slideRight" style="--delay: 400ms">
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

                    <div class="animate-slideRight" style="--delay: 500ms">
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

                    <div class="animate-slideRight" style="--delay: 600ms">
                        <label for="role_id" class="block text-sm font-medium text-gray-700">Vi ste</label>
                        <select id="role_id" name="role_id" required
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2
                                       transition-all duration-300 ease-in-out
                                       focus:ring-2 focus:ring-blue-500 focus:border-transparent
                                       hover:border-blue-300">
                            @foreach ($roles as $role)
                                @if ($role->name == 'Admin')
                                    @continue
                                @endif
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                        @error('role_id')
                            <span class="text-red-500 text-sm animate-shake">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" id="submit-button"
                        class="w-full bg-blue-600 text-white rounded-md py-2 mt-6
                                   transform transition-all duration-300 ease-out
                                   hover:bg-blue-500 hover:scale-105 hover:shadow-lg
                                   focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2
                                   animate-slideUp">
                        Registrujte se
                        <i class="fa-solid fa-user-plus"></i>
                    </button>
                </form>
                <p class="mt-4 text-center text-sm text-gray-600 animate-fadeIn" style="--delay: 800ms">
                    Već imate račun?
                    <a href="{{ route('login') }}"
                        class="text-blue-600 hover:text-blue-500 transition-colors duration-300
                              hover:underline">
                        Prijavite se ovde
                        <i class="fa-solid fa-chevron-right"></i>
                    </a>
                </p>
            </div>
            {{-- Loader  --}}
            @include('partials._loader')
        </div>
    </div>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <script src="{{ asset('js/loading.js') }}" defer></script>
</x-layout>
