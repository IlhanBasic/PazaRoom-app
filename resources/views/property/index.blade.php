@section('title', 'PazaRoom - Početna')
<x-layout>
    @section('title', 'Početna - Izdavanje Stanova')
    @include('partials._hero')
    <!-- Search sekcija -->
    <section class="search-section">
        <h1 class="search-title">Pronađite svoj idealan stan</h1>
        @include('partials._search')
    </section>
    <!-- Filter sekcija -->
    <section class="filter-section">
        <h2 class="filter-title">Primenite filtere</h2>
        @include('partials._filter')
    </section>
    <!-- Lista stanova -->
    <section class="properties-section">
        <h2 class="properties-title">Naši stanovi</h2>
        <!-- Sortiranje -->
        <section>
            <div class="sort-container">
                @include('partials._sort')
            </div>
        </section>
        <div class="properties-container">
            @foreach ($properties as $stan)
                <x-property-card :property="$stan" />
            @endforeach
            @if ($properties->isEmpty())
                <p class="empty-message">Nema stanova za prikaz.</p>
            @endif
            <div class="pagination-wrapper">
                {{ $properties->links() }}
            </div>
        </div>
    </section>
</x-layout>
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
