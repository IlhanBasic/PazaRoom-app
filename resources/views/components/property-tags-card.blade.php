@props(['propertyTag'])

<div class="bg-white rounded-lg shadow-md overflow-hidden flex flex-col md:flex-row md:h-[200px] h-[160px] w-full max-w-4xl mx-auto transition-all duration-300 hover:shadow-lg">
    <div class="flex-1 p-2 md:p-4 flex flex-col justify-between">
        <div>
            <div class="mb-2 md:mb-3">
                <h3 class="text-base md:text-xl font-semibold text-gray-800 mb-1 md:mb-2">{{ $propertyTag->tag }}</h3>
            </div>
        </div>

        {{-- Actions --}}
        <div class="flex items-center gap-2 md:gap-3 mt-2 md:mt-4">
            <a 
                href="{{ route('property_tag_show', $propertyTag->id) }}" 
                class="inline-flex items-center gap-1 md:gap-2 bg-blue-600 text-white text-sm md:text-base px-3 md:px-4 py-1.5 md:py-2 rounded-md hover:bg-blue-700 transition-colors"
            >
                <span>Detalji</span>
                <i class="fa-solid fa-arrow-right"></i>
            </a>
            <form 
                action="{{ route('property_tag_delete', $propertyTag->id) }}" 
                method="POST" 
                class="inline delete-property-form" 
                data-property-id="{{ $propertyTag->id }}"
            >
                @csrf
                @method('DELETE')
                <button 
                    type="submit" 
                    class="inline-flex items-center gap-1 md:gap-2 bg-red-500 text-white text-sm md:text-base px-3 md:px-4 py-1.5 md:py-2 rounded-md hover:bg-red-600 transition-colors"
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