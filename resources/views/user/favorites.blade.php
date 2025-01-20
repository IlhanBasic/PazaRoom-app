@section('title', 'Omiljeni smeštaj - Lista izabranih')
<x-layout>

    <!-- Lista stanova -->
    <section class="property-list-section">
        <div class="property-container">
            <h2 class="section-heading">Omiljeni stanovi</h2>
            <div class="property">
                @forelse ($favorites as $favorite)
                    <x-property-card :property="$favorite" />
                @empty
                    <p class="empty-message">Nema stanova za prikaz.</p>
                @endforelse
                <div class="pagination-container">
                    {{ $favorites->links() }}
                </div>
            </div>
        </div>
    </section>
</x-layout>
<link rel="stylesheet" href="{{ asset('css/owner-properties.css') }}">
