@props(['propertyTag'])

<div class="property-card">
    <div class="property-card-content">
        <div class="property-title">
            <h3>{{ $propertyTag->tag }}</h3>
        </div>

        <!-- Actions -->
        <div class="property-actions">
            <a 
                href="{{ route('property_tag_show', $propertyTag->id) }}" 
                class="details-button"
            >
                <span>Detalji</span>
                <i class="fa-solid fa-arrow-right"></i>
            </a>
            <form 
                action="{{ route('property_tag_delete', $propertyTag->id) }}" 
                method="POST" 
                class="delete-property-form" 
                data-property-id="{{ $propertyTag->id }}"
            >
                @csrf
                @method('DELETE')
                <button 
                    type="submit" 
                    class="delete-button"
                >
                    <span>Obriši</span>
                    <i class="fa-solid fa-trash"></i>
                </button>
            </form>
        </div>
    </div>
</div>

{{-- Delete Confirmation Modal --}}
<script src="{{ asset('js/deleteButton.js') }}"></script>
<link rel="stylesheet" href="{{ asset('css/property-tags-card.css') }}">