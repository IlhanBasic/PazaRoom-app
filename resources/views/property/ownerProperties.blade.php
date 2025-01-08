@section('title', 'PazaRoom - Moj smeštaj')
<x-layout>
    @section('title', 'Moji stanovi - Izdati stanovi')
    <!-- Lista stanova -->
    <section class="property-list-section">
        <div class="property-container">
            <h2 class="section-heading">Moji stanovi</h2>
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
<link rel="stylesheet" href="{{ asset('css/owner-properties.css') }}">