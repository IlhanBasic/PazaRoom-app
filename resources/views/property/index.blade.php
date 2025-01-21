@section('title', 'PazaRoom - Početna')
<x-layout>
    @section('title', 'Početna - Izdavanje Stanova')
    @include('partials._hero')
    <!-- Search section -->
    <section class="search-section">
        <h1 class="search-title">Pronađite svoj idealan stan</h1>
        @include('partials._search')
    </section>
    <!-- Filter section -->
    <section class="filter-section">
        <h2 class="filter-title">Primenite filtere</h2>
        @include('partials._filter')
    </section>
    <!-- Property List -->
    <section class="properties-section">
        <h2 class="properties-title">Naši stanovi</h2>
        <!-- Sort -->
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
            {{ $properties->links() }}
        </div>
    </section>
</x-layout>
<script src="{{ asset('js/deleteButton.js') }}"></script>
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
