<form action="" method="GET" class="animate-fadeIn">
    <div class="border-2 border-gray-100 my-4 mx-8 p-4 rounded-lg 
                transform transition-all duration-300 hover:shadow-lg hover:border-blue-200
                animate-slideDown" style="--delay: 200ms">
        <!-- Filter by Type -->
        <div class="mb-4">
            <label for="type" class="block text-gray-600 font-semibold mb-2">Tip nekretnine:</label>
            <select id="type" name="type" 
                    class="w-full border-gray-300 rounded-lg p-2 text-gray-800 
                           transition-all duration-300 ease-in-out
                           focus:ring-2 focus:ring-blue-500 focus:border-transparent 
                           hover:border-blue-300">
                <option value="">Sve</option>
                <option value="Stan">Stan</option>
                <option value="Soba">Soba</option>
            </select>
        </div>

        <!-- Filter by Rent Price -->
        <div class="mb-4">
            <label for="price" class="block text-gray-600 font-semibold mb-2">Cena zakupa (EUR):</label>
            <div class="flex space-x-4">
                <input type="number" id="price-min" name="rent_price_min" 
                       class="w-full border-gray-300 rounded-lg p-2 text-gray-800 
                              transition-all duration-300 ease-in-out
                              focus:ring-2 focus:ring-blue-500 focus:border-transparent 
                              hover:border-blue-300" 
                       placeholder="Min. cena">
                <input type="number" id="price-max" name="rent_price_max" 
                       class="w-full border-gray-300 rounded-lg p-2 text-gray-800 
                              transition-all duration-300 ease-in-out
                              focus:ring-2 focus:ring-blue-500 focus:border-transparent 
                              hover:border-blue-300" 
                       placeholder="Max. cena">
            </div>
        </div>

        <!-- Filter by Area -->
        <div class="mb-4">
            <label for="area" class="block text-gray-600 font-semibold mb-2">Kvadratura (m²):</label>
            <div class="flex space-x-4">
                <input type="number" id="area-min" name="area_min" 
                       class="w-full border-gray-300 rounded-lg p-2 text-gray-800 
                              transition-all duration-300 ease-in-out
                              focus:ring-2 focus:ring-blue-500 focus:border-transparent 
                              hover:border-blue-300" 
                       placeholder="Min. kvadratura">
                <input type="number" id="area-max" name="area_max" 
                       class="w-full border-gray-300 rounded-lg p-2 text-gray-800 
                              transition-all duration-300 ease-in-out
                              focus:ring-2 focus:ring-blue-500 focus:border-transparent 
                              hover:border-blue-300" 
                       placeholder="Max. kvadratura">
            </div>
        </div>

        <!-- Submit Button -->
        <div class="text-right">
            <button type="submit" 
                    class="h-10 w-32 text-white rounded-lg bg-blue-500
                           transform transition-all duration-300 ease-out
                           hover:bg-blue-600 hover:scale-105 hover:shadow-md
                           focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Filtriraj
            </button>
        </div>
    </div>
</form>

<link rel="stylesheet" href="{{ asset('css/filter.css') }}">
