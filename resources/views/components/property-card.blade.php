@props(['property'])

<div class="property-card {{ $property->status == 'Declined' ? 'declined' : '' }}">
    {{-- Property Image --}}
    <div class="property-image">
        <img src="{{ $property['images'] ? asset('storage/' . explode(',', $property['images'])[0]) : asset('images/no-image.png') }}"
            alt="{{ $property->title }}" class="image">
        @if ($property->status == 'Declined')
            <div class="declined-overlay">
                <span>Odbijena od Admina</span>
            </div>
        @endif
    </div>

    {{-- Property Details --}}
    <div class="property-details">
        <div>
            {{-- Header Section --}}
            <div class="header-section">
                <h3 class="property-title">{{ $property->title }}</h3>
                <x-property-tags :tagsCsv="$property['tags']" />
            </div>

            {{-- Location --}}
            <div class="location">
                <i class="fa-solid fa-location-dot"></i>
                <span>{{ $property['address'] }}</span>
            </div>

            {{-- Price --}}
            <div class="price">
                {{ number_format($property['rent_price'], 0, ',', '.') }} €
                <span class="price-per-month">/ mesec</span>
            </div>

        </div>
        {{-- Actions --}}
        @if ($property->status != 'Declined')
            <div class="action-buttons">
                <a href="{{ route('property_show', $property->id) }}" class="details-button">
                    <span>Detalji</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
                @if (auth()->check() && auth()->user()->role->name == 'Vlasnik' && $property->owner_id == auth()->user()->id)
                    <form action="{{ route('property_delete', $property->id) }}" method="POST"
                        class="delete-property-form" data-property-id="{{ $property->id }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-button">
                            <span>Obriši</span>
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                @endif
            </div>
        @endif

    </div>
</div>

{{-- Delete Confirmation Modal --}}
<script src="{{ asset('js/deleteButton.js') }}"></script>
<link rel="stylesheet" href="{{ asset('css/property-card.css') }}">
