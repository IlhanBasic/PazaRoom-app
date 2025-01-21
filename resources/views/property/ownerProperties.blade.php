@section('title', 'PazaRoom - Moj smeštaj')
<x-layout>
    <x-back-button />
    <!-- List of Property -->
    <section class="property-list-section">
        <div class="property-container">
            <h2 class="section-heading">Moji smeštaji</h2>
            <div class="property">
                @foreach ($properties as $stan)
                    <x-property-card :property="$stan" />
                @endforeach
                @if ($properties->isEmpty())
                    <p class="empty-message">Nema stanova za prikaz.</p>
                @endif
                <div class="pagination-container">
                    {{ $properties->links() }}
                </div>
            </div>
        </div>
    </section>
</x-layout>
<script src="{{ asset('js/deleteButton.js') }}"></script>
<link rel="stylesheet" href="{{ asset('css/owner-properties.css') }}">