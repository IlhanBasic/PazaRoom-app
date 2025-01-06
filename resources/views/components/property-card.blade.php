@props(['property'])

<div
    class="bg-white rounded-lg shadow-md overflow-hidden flex flex-col md:flex-row md:h-[200px] h-[160px] w-full max-w-4xl mx-auto transition-all duration-300 hover:shadow-lg {{ $property->status == 'Declined' ? 'bg-red-200 pointer-events-none' : '' }}">
    {{-- Property Image --}}
    <div class="w-full md:w-1/3 md:h-full relative">
        <img src="{{ $property['images'] ? asset('storage/' . explode(',', $property['images'])[0]) : asset('images/no-image.png') }}"
            alt="{{ $property->title }}" class="w-full h-32 md:h-full object-cover">
        @if ($property->status == 'Declined')
            <div class="absolute inset-0 bg-red-600 bg-opacity-60 flex items-center justify-center">
                <span class="text-white font-bold text-lg md:text-xl">Odbijena od Admina</span>
            </div>
        @endif
    </div>

    {{-- Property Details --}}
    <div class="flex-1 p-2 md:p-4 flex flex-col justify-between">
        <div>
            {{-- Header Section --}}
            <div class="mb-2 md:mb-3">
                <h3 class="text-base md:text-xl font-semibold text-gray-800 mb-1 md:mb-2">{{ $property->title }}</h3>
                <x-property-tags :tagsCsv="$property['tags']" />
            </div>

            {{-- Location --}}
            <div class="flex items-center gap-2 text-gray-600 text-sm md:text-base mb-2 md:mb-3">
                <i class="fa-solid fa-location-dot"></i>
                <span>{{ $property['address'] }}</span>
            </div>

            {{-- Price --}}
            <div class="text-base md:text-lg font-bold text-blue-600">
                {{ number_format($property['rent_price'], 0, ',', '.') }} € <span
                    class="text-xs md:text-sm font-normal text-gray-600">/ mesec</span>
            </div>
        </div>

        {{-- Actions --}}
        @if ($property->status != 'Declined')
            <div class="flex items-center gap-2 md:gap-3 mt-2 md:mt-4">
                <a href="{{ route('property_show', $property->id) }}"
                    class="inline-flex items-center gap-1 md:gap-2 bg-blue-600 text-white text-sm md:text-base px-3 md:px-4 py-1.5 md:py-2 rounded-md hover:bg-blue-700 transition-colors">
                    <span>Detalji</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
                @if (auth()->check() && auth()->user()->role->name == 'Vlasnik' && $property->owner_id == auth()->user()->id)
                    <form action="{{ route('property_delete', $property->id) }}" method="POST"
                        class="inline delete-property-form" data-property-id="{{ $property->id }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="inline-flex items-center gap-1 md:gap-2 bg-red-500 text-white text-sm md:text-base px-3 md:px-4 py-1.5 md:py-2 rounded-md hover:bg-red-600 transition-colors">
                            <span>Obriši</span>
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                @endif
            </div>
        @endif
    </div>
</div>
