<link rel="stylesheet" href="{{ asset('css/sort.css') }}">
<form action="{{ request()->routeIs('properties') ? route('properties') : route('home') }}" method="GET" class="sort-form">
    <select name="sort" class="sort-select">
        <option value="">Sortiraj po</option>
        <option value="newest" {{ request('sort') === 'newest' ? 'selected' : '' }}>Najnovije</option>
        <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Najstarije</option>
        <option value="best_to_worst" {{ request('sort') === 'best_to_worst' ? 'selected' : '' }}>Ocena: Najbolja ka najnižoj</option>
        <option value="worst_to_best" {{ request('sort') === 'worst_to_best' ? 'selected' : '' }}>Ocena: Najniža ka najvišoj</option>
        <option value="price_low_to_high" {{ request('sort') === 'price_low_to_high' ? 'selected' : '' }}>Cena: Najniža ka Najvišoj</option>
        <option value="price_high_to_low" {{ request('sort') === 'price_high_to_low' ? 'selected' : '' }}>Cena: Najviša ka Najnižoj</option>
        <option value="area_low_to_high" {{ request('sort') === 'area_low_to_high' ? 'selected' : '' }}>Kvadratura: Najmanja ka Najvećoj</option>
        <option value="area_high_to_low" {{ request('sort') === 'area_high_to_low' ? 'selected' : '' }}>Kvadratura: Najveća ka Najmanjoj</option>
        <option value="type_asc" {{ request('sort') === 'type_asc' ? 'selected' : '' }}>Tip: Stan-Soba</option>
        <option value="type_desc" {{ request('sort') === 'type_desc' ? 'selected' : '' }}>Tip: Soba-Stan</option>
    </select>
    <button type="submit" class="sort-button">Primeni</button>
</form>
