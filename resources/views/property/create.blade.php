@section('title', 'PazaRoom - Dodaj smeštaj')
<x-layout>
    <div class="pz-container">
        <h1 class="pz-title">Dodaj novi smeštaj</h1>
        <form action="{{ route('properties_store') }}" method="POST" enctype="multipart/form-data" id="form" class="pz-form">
            @csrf
            {{-- Naslov  --}}
            <div class="pz-form-group">
                <label for="title" class="pz-label">Naslov</label>
                <div>
                    <input type="text" name="title" id="title" required class="pz-input" value="{{ old('title') }}" />
                    @error('title')
                        <p class="pz-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Tip smeštaja -->
            <div class="pz-form-group">
                <label for="type" class="pz-label">Tip</label>
                <div>
                    <select name="type" id="type" required class="pz-select">
                        <option value="">Izaberite tip</option>
                        <option value="Stan" {{ old('type') == 'Stan' ? 'selected' : '' }}>Stan</option>
                        <option value="Soba" {{ old('type') == 'Soba' ? 'selected' : '' }}>Soba</option>
                    </select>
                    @error('type')
                        <p class="pz-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Vrsta smeštaja -->
            <div class="pz-form-group">
                <label for="property_type" class="pz-label">Vrsta smeštaja</label>
                <div>
                    <select name="property_type" id="property_type" required class="pz-select">
                        <option value="">Izaberite vrstu</option>
                    </select>
                    @error('property_type')
                        <p class="pz-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Opis  --}}
            <div class="pz-form-group">
                <label for="description" class="pz-label">Opis</label>
                <div>
                    <textarea name="description" id="description" rows="3" required class="pz-textarea" value="{{ old('description') }}"></textarea>
                    @error('description')
                        <p class="pz-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Lokacija  --}}
            <div class="pz-map-container">
                <h2 class="pz-label">Dodaj lokaciju</h2>
                <input type="hidden" id="address" name="address" required>
                <input type="hidden" id="latitude" name="latitude">
                <input type="hidden" id="longitude" name="longitude">
                <div id="map" class="pz-map"></div>
                @error('address')
                    <p class="pz-error">{{ $message }}</p>
                @enderror
            </div>

            <!-- Slike -->
            <div class="pz-form-group">
                <label for="images" class="pz-label">Slike</label>
                <div>
                    <input type="file" id="images" name="images[]" multiple class="pz-file-input" />
                    @error('images')
                        <p class="pz-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Tagovi  --}}
            <div class="pz-form-group">
                <label class="pz-label">Tagovi</label>
                <div class="pz-tag-grid">
                    @foreach ($tags as $tag)
                        <div class="pz-tag-item">
                            <input type="checkbox" name="tags[]" id="tag-{{ $tag->id }}" value="{{ $tag->tag }}" class="pz-tag-checkbox">
                            <label for="tag-{{ $tag->id }}" class="pz-label">{{ $tag->tag }}</label>
                        </div>
                    @endforeach
                    @error('tags')
                        <p class="pz-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Dokaz o vlasništvu -->
            <div class="pz-form-group">
                <label for="ownership_proof" class="pz-label">Dokaz o vlasništvu</label>
                <div>
                    <input type="file" accept=".pdf,.jpg,.jpeg,.png" id="ownership_proof" name="ownership_proof" class="pz-file-input">
                    @error('ownership_proof')
                        <p class="pz-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Površina i spratovi --}}
            <div class="pz-grid-2">
                <div class="pz-form-group">
                    <label for="area" class="pz-label">Površina (m²)</label>
                    <div>
                        <input type="number" name="area" id="area" min="1" step="1" required class="pz-input" value="{{ old('area') }}" />
                        @error('area')
                            <p class="pz-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="pz-form-group">
                    <label for="floors" class="pz-label">Ukupan Broj Spratova</label>
                    <div>
                        <input type="number" name="floors" id="floors" min="1" step="1" required max="50" maxlength="2" class="pz-input" />
                        @error('floors')
                            <p class="pz-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="pz-form-group">
                    <label for="current_floor" class="pz-label">Sprat na kojem se nalazi</label>
                    <div>
                        <input type="number" name="current_floor" id="current_floor" min="1" step="1" max="50" maxlength="2" required class="pz-input" />
                        @error('current_floor')
                            <p class="pz-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Grejanje i Mesečni troškovi --}}
            <div class="pz-form-group">
                <label for="heating" class="pz-label">Grejanje</label>
                <div>
                    <select name="heating" id="heating" required class="pz-select">
                        <option value="Centralno">Centralno grejanje</option>
                        <option value="Struja">Električno grejanje</option>
                        <option value="Gas">Grejanje na gas</option>
                        <option value="Nema">Bez grejanja</option>
                    </select>
                    @error('heating')
                        <p class="pz-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="pz-form-group">
                <label for="monthly_utilities" class="pz-label">Mesečni troškovi (€)</label>
                <div>
                    <input type="number" name="monthly_utilities" id="monthly_utilities" min="0" step="1" placeholder="0.00" required class="pz-input" value="{{ old('monthly_utilities') }}" />
                    @error('monthly_utilities')
                        <p class="pz-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Cena Najma --}}
            <div class="pz-grid-2">
                <div class="pz-form-group">
                    <label for="rent_price" class="pz-label">Cena Najma (€)</label>
                    <div>
                        <input type="number" name="rent_price" id="rent_price" min="0" step="0.01" placeholder="0.00" required class="pz-input" value="{{ old('rent_price') }}" />
                        @error('rent_price')
                            <p class="pz-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <button id="submit-button" class="pz-submit-button" type="submit">Potvrdite</button>
            </div>
        </form>
        @include('partials._loader')
    </div>
    <script src="{{ asset('js/mapaRegister.js') }}"></script>
    <script src="{{ asset('js/loading.js') }}"></script>
    <script>
        const propertyOptions = {
            Stan: ['Garsonjera', 'Jednosoban', 'Dvosoban', 'Trosoban', '4+ soba'],
            Soba: ['Jednokrevetna', 'Dvokrevetna', 'Trokrevetna']
        };

        const typeSelect = document.getElementById('type');
        const propertyTypeSelect = document.getElementById('property_type');

        function updatePropertyTypeOptions() {
            const selectedType = typeSelect.value;
            const options = propertyOptions[selectedType] || [];

            propertyTypeSelect.innerHTML = '<option value="">Izaberite vrstu</option>';

            options.forEach(option => {
                const opt = document.createElement('option');
                opt.value = option;
                opt.textContent = option;
                propertyTypeSelect.appendChild(opt);
            });
        }

        typeSelect.addEventListener('change', updatePropertyTypeOptions);

        document.addEventListener('DOMContentLoaded', () => {
            if (typeSelect.value) updatePropertyTypeOptions();
        });
    </script>
</x-layout>
<link rel="stylesheet" href="{{ asset('css/create-property.css') }}">