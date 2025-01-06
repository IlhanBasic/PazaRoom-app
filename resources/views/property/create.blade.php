@section('title', 'PazaRoom - Dodaj smeštaj')
<x-layout>
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-semibold mb-4 text-center">Dodaj novi smeštaj</h1>
        <form action="{{ route('properties_store') }}" method="POST" enctype="multipart/form-data" id="form"
            class="bg-white shadow-md rounded-lg p-6 space-y-6 md:space-y-8 border border-gray-200 mx-auto max-w-4xl">
            @csrf
            {{-- Naslov  --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-center">
                <label for="title" class="text-sm font-medium text-gray-700">Naslov</label>
                <div class="md:col-span-3">
                    <input type="text" name="title" id="title" required
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border"
                        value="{{ old('title') }}" />
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

            </div>
            <!-- Tip smeštaja -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-center">
                <label for="type" class="text-sm font-medium text-gray-700">Tip</label>
                <div class="md:col-span-3">
                    <select name="type" id="type" required
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border">
                        <option value="">Izaberite tip</option>
                        <option value="Stan" {{ old('type') == 'Stan' ? 'selected' : '' }}>Stan</option>
                        <option value="Soba" {{ old('type') == 'Soba' ? 'selected' : '' }}>Soba</option>
                    </select>
                    @error('type')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <!-- Vrsta smeštaja -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-center">
                <label for="property_type" class="text-sm font-medium text-gray-700">Vrsta smeštaja</label>
                <div class="md:col-span-3">
                    <select name="property_type" id="property_type" required
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border">
                        <option value="">Izaberite vrstu</option>
                    </select>
                    @error('property_type')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            {{-- Opis  --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-start">
                <label for="description" class="text-sm font-medium text-gray-700">Opis</label>
                <div class="md:col-span-3">
                    <textarea name="description" id="description" rows="3" required
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border"
                        value="{{ old('description') }}"></textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Lokacija  --}}
            <div class="container">
                <h1>Dodaj lokaciju</h1>
                <!-- Skrivena polja za adresu, latitudu i longitud -->
                <input type="hidden" id="address" name="address" required>
                <input type="hidden" id="latitude" name="latitude">
                <input type="hidden" id="longitude" name="longitude">
                <!-- Mapa -->
                <div id="map"></div>
            </div>
            @error('address')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror

            <!-- Slike -->
            <div class="mb-4">
                <label for="images" class="block text-sm font-medium text-gray-700">Slike</label>
                <input type="file" id="images" name="images[]" multiple
                    class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                @error('images')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            {{-- Tagovi  --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-center">
                <label for="tags" class="text-sm font-medium text-gray-700">Tagovi</label>
                <div class="md:col-span-3 flex flex-wrap gap-4 ">
                    @foreach ($tags as $tag)
                        <div class="flex items-center mb-2">
                            <input type="checkbox" name="tags[]" id="tag-{{ $tag->id }}"
                                value="{{ $tag->tag }}" class="mr-2">
                            <label for="tag-{{ $tag->id }}"
                                class="text-sm font-medium text-gray-700">{{ $tag->tag }}</label>
                        </div>
                    @endforeach
                    @error('tags')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <!-- Dokaz o vlasništvu -->
            <div class="mb-4">
                <label for="ownership_proof" class="block text-sm font-medium text-gray-700">Dokaz o vlasništvu</label>
                <input type="file" accept=".pdf,.jpg,.jpeg,.png" id="ownership_proof" name="ownership_proof"
                    class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                @error('ownership_proof')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            {{-- Povrsina  --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-center">
                    <label for="area" class="text-sm font-medium text-gray-700">Površina (m²)</label>
                    <div class="md:col-span-3">
                        <input type="number" name="area" id="area" min="1" step="1" required
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border"
                            value="{{ old('area') }}" />
                        @error('area')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                {{-- Broj spratova  --}}
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-center">
                    <label for="floors" class="text-sm font-medium text-gray-700">Ukupan Broj Spratova</label>
                    <div class="md:col-span-3">
                        <input type="number" name="floors" id="floors" min="1" step="1" required
                            max="50" maxlength="2"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border" />
                        @error('floors')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                {{-- Trentuni sprat  --}}
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-center">
                    <label for="current_floor" class="text-sm font-medium text-gray-700">Sprat na kojem se
                        nalazi</label>
                    <div class="md:col-span-3">
                        <input type="number" name="current_floor" id="current_floor" min="1" step="1"
                            max="50" maxlength="2" required
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border" />
                        @error('current_floor')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            {{-- Grejanje i Mesecni troskovi  --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-center">
                <label for="heating" class="text-sm font-medium text-gray-700">Grejanje</label>
                {{-- Grejanje  --}}
                <div class="md:col-span-3">
                    <select name="heating" id="heating" required
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border">
                        <option value="Centralno">Centralno grejanje</option>
                        <option value="Struja">Električno grejanje</option>
                        <option value="Gas">Grejanje na gas</option>
                        <option value="Nema">Bez grejanja</option>
                    </select>
                    @error('heating')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                {{-- Mesecni troskovi  --}}
                <div class="md:col-span-3">
                    <label for="monthly_utilities" class="text-sm font-medium text-gray-700">Mesecni troskovi
                        (€)</label>
                    <input type="number" name="monthly_utilities" id="monthly_utilities" min="0"
                        step="1" placeholder="0.00" required
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border"
                        value="{{ old('monthly_utilities') }}" />
                    @error('monthly_utilities')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            {{-- Cena Najma --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-center">
                    <label for="rent_price" class="text-sm font-medium text-gray-700">Cena Najma (€)</label>
                    <div class="md:col-span-3">
                        <input type="number" name="rent_price" id="rent_price" min="0" step="0.01"
                            placeholder="0.00" required
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border"
                            value="{{ old('rent_price') }}" />
                        @error('rent_price')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <button id="submit-button"
                    class="w-full bg-blue-600 text-white hover:bg-blue-500 rounded-md py-2 transition duration-200"
                    type="submit">Potvrdite</button>
            </div>
        </form>
        @include('partials._loader')
    </div>
    <script src="{{ asset('js/mapaRegister.js') }}"></script>
    <script src="{{ asset('js/loading.js') }}"></script>
    <script>
        // Definicija zavisnih opcija
        const propertyOptions = {
            Stan: ['Garsonjera', 'Jednosoban', 'Dvosoban', 'Trosoban', '4+ soba'],
            Soba: ['Jednokrevetna', 'Dvokrevetna', 'Trokrevetna']
        };

        // HTML elementi
        const typeSelect = document.getElementById('type');
        const propertyTypeSelect = document.getElementById('property_type');

        // Funkcija za ažuriranje opcija
        function updatePropertyTypeOptions() {
            const selectedType = typeSelect.value;
            const options = propertyOptions[selectedType] || [];

            // Očisti trenutne opcije
            propertyTypeSelect.innerHTML = '<option value="">Izaberite vrstu</option>';

            // Dodaj nove opcije
            options.forEach(option => {
                const opt = document.createElement('option');
                opt.value = option;
                opt.textContent = option;
                propertyTypeSelect.appendChild(opt);
            });
        }

        // Dodaj događaj za promenu tipa smeštaja
        typeSelect.addEventListener('change', updatePropertyTypeOptions);

        // Inicijalizuj opcije prilikom učitavanja stranice (ako postoji prethodno stanje)
        document.addEventListener('DOMContentLoaded', () => {
            if (typeSelect.value) updatePropertyTypeOptions();
        });
    </script>
</x-layout>
