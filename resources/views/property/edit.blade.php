@section('title', 'PazaRoom - Izmeni smeštaj')
<x-layout>
    <x-back-button />
    <div class="pz-container">
        <h1 class="pz-title">Izmeni smeštaj</h1>
        <form action="{{ route('property_update', $property) }}" method="POST" enctype="multipart/form-data" id="form"
            class="pz-form">
            @csrf
            {{-- Izmeni status  --}}
            <div class="pz-form-group">
                <label for="status" class="pz-label">Status</label>
                <div>
                    <select name="status" id="status" required class="pz-select">
                        <option value="Active" {{ $property->status == 'Active' ? 'selected' : '' }}>Aktivan</option>
                        <option value="Inactive" {{ $property->status == 'Inactive' ? 'selected' : '' }}>Neaktivan
                        </option>
                    </select>
                    @error('status')
                        <p class="pz-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Naslov  --}}
            <div class="pz-form-group">
                <label for="title" class="pz-label">Naslov</label>
                <div>
                    <input type="text" name="title" id="title" required class="pz-input"
                        value="{{ $property->title }}" />
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
                        <option value="Stan" {{ $property->type == 'Stan' ? 'selected' : '' }}>Stan</option>
                        <option value="Soba" {{ $property->type == 'Soba' ? 'selected' : '' }}>Soba</option>
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
                        <option value="{{ $property->property_type }}" selected>{{ $property->property_type }}</option>
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
                    <textarea name="description" id="description" rows="3" required class="pz-textarea">{{ trim($property->description) }}</textarea>
                    @error('description')
                        <p class="pz-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Lokacija  --}}
            <div class="pz-map-container">
                <h2 class="pz-label">Dodaj lokaciju</h2>
                <input type="hidden" id="address" name="address" required value="{{ $property->address }}">
                <input type="hidden" id="latitude" name="latitude" value="{{ $property->latitude }}">
                <input type="hidden" id="longitude" name="longitude" value="{{ $property->longitude }}">
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

                    @if ($property->images)
                        <div class="pz-image-grid">
                            @foreach (explode(',', $property->images) as $index => $image)
                                <div class="pz-image-item">
                                    <img src="{{ asset('storage/' . $image) }}" alt="Slika" class="pz-image">
                                    <label class="pz-checkbox-label">
                                        <input type="checkbox" name="delete_images[]" value="{{ $image }}">
                                        Obriši
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            {{-- Tagovi  --}}
            <div class="pz-form-group">
                <label class="pz-label">Tagovi</label>
                <div class="pz-tag-grid">
                    @foreach ($tags as $tag)
                        <div class="pz-tag-item">
                            <input type="checkbox" name="tags[]" id="tag-{{ $tag->id }}"
                                value="{{ $tag->tag }}" class="pz-tag-checkbox" {{ in_array($tag->tag, explode(',', $property->tags)) ? 'checked' : '' }}>
                            <label for="tag-{{ $tag->id }}" class="pz-label">{{ $tag->tag }}</label>
                        </div>
                    @endforeach
                    @error('tags')
                        <p class="pz-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Površina i spratovi --}}
            <div class="pz-grid-2">
                <div class="pz-form-group">
                    <label for="area" class="pz-label">Površina (m²)</label>
                    <div>
                        <input type="number" name="area" id="area" min="1" step="1" required
                            class="pz-input" value="{{ $property->area }}" />
                        @error('area')
                            <p class="pz-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="pz-form-group">
                    <label for="floors" class="pz-label">Ukupan Broj Spratova</label>
                    <div>
                        <input type="number" name="floors" id="floors" min="1" step="1" required
                            max="50" maxlength="2" value="{{ $property->floors }}" class="pz-input" />
                        @error('floors')
                            <p class="pz-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="pz-form-group">
                    <label for="current_floor" class="pz-label">Sprat na kojem se nalazi</label>
                    <div>
                        <input type="number" name="current_floor" id="current_floor" min="1" step="1"
                            max="50" maxlength="2" required value="{{ $property->current_floor }}"
                            class="pz-input" />
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
                        <option value="Centralno" {{ $property->heating == 'Centralno' ? 'selected' : '' }}>Centralno
                            grejanje</option>
                        <option value="Struja" {{ $property->heating == 'Struja' ? 'selected' : '' }}>Električno
                            grejanje</option>
                        <option value="Gas" {{ $property->heating == 'Gas' ? 'selected' : '' }}>Grejanje na gas
                        </option>
                        <option value="Nema" {{ $property->heating == 'Nema' ? 'selected' : '' }}>Bez grejanja
                        </option>
                    </select>
                    @error('heating')
                        <p class="pz-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="pz-form-group">
                <label for="monthly_utilities" class="pz-label">Mesečni troškovi (€)</label>
                <div>
                    <input type="number" name="monthly_utilities" id="monthly_utilities" min="0"
                        step="1" placeholder="0.00" required class="pz-input"
                        value="{{ $property->monthly_utilities }}" />
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
                        <input type="number" name="rent_price" id="rent_price" min="0" step="0.01"
                            placeholder="0.00" required class="pz-input" value="{{ $property->rent_price }}" />
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
    {{-- <script src="{{ asset('js/mapaRegister.js') }}"></script> --}}
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
            const selectedOption = propertyTypeSelect.value;

            propertyTypeSelect.innerHTML = '<option value="">Izaberite vrstu</option>';

            options.forEach(option => {
                const opt = document.createElement('option');
                opt.value = option;
                opt.textContent = option;
                if (option === selectedOption) {
                    opt.selected = true;
                }
                propertyTypeSelect.appendChild(opt);
            });
        }

        typeSelect.addEventListener('change', updatePropertyTypeOptions);

        document.addEventListener('DOMContentLoaded', () => {
            if (typeSelect.value) updatePropertyTypeOptions();
        });
    </script>
    <script>
        // Inicijalizacija mape sa tačnim koordinatama iz PHP-a
        const lat = {{ $property->latitude }};
        const lng = {{ $property->longitude }};
        const map = L.map('map').setView([lat, lng], 13); // Postavite početnu poziciju sa latitude i longitude

        // Dodavanje OpenStreetMap sloja
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Dodavanje marker-a na mapu sa tačnim početnim koordinatama
        const marker = L.marker([lat, lng], {
            draggable: true
        }).addTo(map);

        // Kada se povuče marker, ažuriraj skrivena polja sa novim koordinatama
        marker.on('dragend', function(e) {
            const position = marker.getLatLng();
            document.getElementById('latitude').value = position.lat;
            document.getElementById('longitude').value = position.lng;

            // Traženje adrese na osnovu koordinata
            fetch(
                    `https://nominatim.openstreetmap.org/reverse?format=json&lat=${position.lat}&lon=${position.lng}&addressdetails=1`
                )
                .then(response => response.json())
                .then(data => {
                    const address = data.display_name;
                    document.getElementById('address').value = address;
                });
        });

        // Kada korisnik klikne na mapu, premesti marker na novo mesto
        map.on('click', function(e) {
            const {
                lat,
                lng
            } = e.latlng;
            marker.setLatLng([lat, lng]);
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;

            // Traženje adrese na osnovu novih koordinata
            fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&addressdetails=1`)
                .then(response => response.json())
                .then(data => {
                    const address = data.display_name;
                    document.getElementById('address').value = address;
                });
        });
    </script>

</x-layout>
<link rel="stylesheet" href="{{ asset('css/edit-property.css') }}">
