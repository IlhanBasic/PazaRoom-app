<form action="" method="GET" class="filter-form animate-fadeIn">
    <div class="filter-container">
        <!-- Filter by Type -->
        <div class="form-group">
            <label for="type" class="form-label">Tip nekretnine:</label>
            <select id="type" name="type" class="form-select">
                <option value="">Sve</option>
                <option value="Stan">Stan</option>
                <option value="Soba">Soba</option>
            </select>
        </div>

        <!-- Filter by Rent Price -->
        <div class="form-group">
            <label for="price" class="form-label">Cena zakupa (EUR):</label>
            <div class="input-group">
                <input type="number" id="price-min" name="rent_price_min" class="form-input" placeholder="Min. cena">
                <input type="number" id="price-max" name="rent_price_max" class="form-input" placeholder="Max. cena">
            </div>
        </div>

        <!-- Filter by Area -->
        <div class="form-group">
            <label for="area" class="form-label">Kvadratura (m²):</label>
            <div class="input-group">
                <input type="number" id="area-min" name="area_min" class="form-input" placeholder="Min. kvadratura">
                <input type="number" id="area-max" name="area_max" class="form-input" placeholder="Max. kvadratura">
            </div>
        </div>

        <!-- Submit Button -->
        <div class="text-right">
            <button type="submit" class="submit-button">Filtriraj</button>
        </div>
    </div>
</form>

<link rel="stylesheet" href="{{ asset('css/filter.css') }}">
