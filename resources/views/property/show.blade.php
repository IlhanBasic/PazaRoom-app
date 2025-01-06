@section('title', 'PazaRoom - Stan ' . $property->id)
<x-layout>
    <div class="min-h-screen bg-gradient-to-b from-gray-50 to-gray-100 md:w-3/4">
        <div class="container mx-auto px-4 py-12">
            @auth
                @if ($property->owner_id == Auth::user()->id)
                    <a href="{{ $property->id . '/edit' }}"
                        class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg mb-4">Edit</a>
                @endif
            @endauth
            {{-- Main Content Container --}}
            <div class="mt-4 bg-white rounded-2xl shadow-2xl overflow-hidden">
                {{-- Image Gallery Section --}}
                @if ($property->images)
                    <div class="relative h-72 sm:h-96 md:h-120 bg-black">
                        <div class="swiper-container h-full">
                            <div class="swiper-wrapper">
                                @foreach (explode(',', $property->images) as $image)
                                    <div class="swiper-slide">
                                        <!-- Wrap the image in an anchor tag for lightbox functionality -->
                                        <a href="{{ asset('storage/' . $image) }}" data-lightbox="apartment-gallery"
                                            data-title="Apartment view">
                                            <img src="{{ asset('storage/' . $image) }}" alt="Apartment view"
                                                class="w-full h-full object-cover">
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                            <div class="swiper-pagination"></div>
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                        </div>
                    </div>
                @else
                    <div class="relative h-72 sm:h-96 md:h-120 bg-black">
                        <img src="{{ asset('images/no-image.png') }}" alt="Apartment view"
                            class="w-full h-full object-cover ">
                    </div>
                @endif
                {{-- Content Section --}}
                <div class="p-8">
                    {{-- Header Section --}}
                    <div class="mb-8">
                        <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $property->title }}</h1>
                        <div class="flex items-center space-x-4 text-gray-600">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                {{ $property->address }}
                            </div>
                        </div>
                    </div>
                    {{-- Pricing Section --}}
                    <div class="bg-gray-900 rounded-xl p-8 text-white mb-12 text-center">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                            <div>
                                <div class="text-gray-400 mb-2">Cena zakupa</div>
                                <div class="text-3xl font-bold">€{{ number_format($property->rent_price, 2) }}</div>
                            </div>
                            <div>
                                <div class="text-gray-400 mb-2">Mesečni troškovi</div>
                                <div class="text-3xl font-bold">€{{ number_format($property->monthly_utilities, 2) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Key Details Grid --}}
                    <div
                        class="border-t border-gray-200 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mb-12 md:gap-12 lg:gap-16">
                        {{-- Area --}}
                        <div class="bg-gray-50 rounded-xl p-6 transition-all hover:shadow-md">
                            <div class="flex items-center space-x-4">
                                <div class="bg-gray-200 rounded-full p-4">
                                    <i class="fa-solid fa-ruler"></i>
                                </div>
                                <div>
                                    <div class="text-sm text-gray-500">Površina</div>
                                    <div class="text-lg font-semibold text-gray-900">
                                        {{ $property->area }} m<sup>2</sup>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Floor --}}
                        <div class="bg-gray-50 rounded-xl p-6 transition-all hover:shadow-md">
                            <div class="flex items-center space-x-4">
                                <div class="bg-gray-200 rounded-full p-4">
                                    <i class="fa-solid fa-building"></i>
                                </div>
                                <div>
                                    <div class="text-sm text-gray-500">Sprat</div>
                                    <div class="text-lg font-semibold text-gray-900">
                                        {{ $property->current_floor }}/{{ $property->floors }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Heating --}}
                        <div class="bg-gray-50 rounded-xl p-6 transition-all hover:shadow-md">
                            <div class="flex items-center space-x-4">
                                <div class="bg-gray-200 rounded-full p-4">
                                    <i class="fa-solid fa-fire"></i>
                                </div>
                                <div>
                                    <div class="text-sm text-gray-500">Grejanje</div>
                                    <div class="text-lg font-semibold text-gray-900">
                                        {{ $property->heating }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Type Property Grid --}}
                    <div
                        class="border-gray-200 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mb-12 md:gap-12 lg:gap-16">
                        {{-- Type --}}
                        <div class="bg-gray-50 rounded-xl p-6 transition-all hover:shadow-md">
                            <div class="flex items-center space-x-4">
                                <div class="bg-gray-200 rounded-full p-4">
                                    <i class="fa-solid fa-home"></i>
                                </div>
                                <div>
                                    <div class="text-sm text-gray-500">Tip smeštaja</div>
                                    <div class="text-lg font-semibold text-gray-900">
                                        {{ $property->type }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Property Type --}}
                        <div class="bg-gray-50 rounded-xl p-6 transition-all hover:shadow-md">
                            <div class="flex items-center space-x-4">
                                <div class="bg-gray-200 rounded-full p-4">
                                    <i class="fa-solid fa-bed"></i>
                                </div>
                                <div>
                                    <div class="text-sm text-gray-500">Vrsta</div>
                                    <div class="text-lg font-semibold text-gray-900">
                                        {{ $property->property_type }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Owner and Tags Section --}}
                    <div
                        class="border-t border-gray-200 flex flex-col sm:flex-row justify-between gap-4 rounded-xl p-8 mb-12">
                        {{-- Owner Information --}}
                        <div class="flex items-center space-x-4">
                            <div class="bg-gray-200 rounded-full p-4">
                                <i class="fa-solid fa-user"></i>
                            </div>
                            <div>
                                <div class="text-sm text-gray-500">Vlasnik</div>
                                <div class="text-lg font-semibold text-gray-900">
                                    {{ $owner->first_name }} {{ $owner->last_name }}
                                </div>
                                <p><i class="fa-solid fa-phone"></i> {{ $property->owner->phone_number }}</p>
                                <p><i class="fa-solid fa-envelope"></i> {{ $property->owner->email }}</p>
                            </div>
                        </div>

                        {{-- Tags --}}
                        @if ($property->tags)
                            <div>
                                <div class="text-gray-500 mb-4">Karakteristike</div>
                                <div class="flex flex-wrap gap-2">
                                    <x-property-tags :tagsCsv="$property['tags']" />
                                </div>
                            </div>
                        @endif

                    </div>
                    <!-- Mapa -->
                    <div
                        class="border-t border-gray-200 flex flex-col sm:flex-row justify-between gap-4 rounded-xl p-8 mb-12">
                        <div class="flex items-center space-x-4">
                            <div class="bg-gray-200 rounded-full p-4">
                                <i class="fa-solid fa-map"></i>
                            </div>
                            <div>
                                <div class="text-sm text-gray-500">Karta</div>
                            </div>
                        </div>
                        <div id="map"></div>
                    </div>
                    {{-- Opis  --}}
                    <div
                        class="border-t border-gray-200 flex flex-col sm:flex-row justify-between gap-4 rounded-xl p-8 mb-12">
                        <div class="flex items-center space-x-4">
                            <div class="bg-gray-200 rounded-full p-4">
                                <i class="fa-solid fa-pen-nib"></i>
                            </div>
                            <div>
                                <div class="text-sm text-gray-500">Opis</div>
                                <div class="text-lg font-semibold text-gray-900">
                                    {{ $property->description }}
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Reviews --}}
                    <div class="bg-gray-50 rounded-xl p-6 transition-all hover:shadow-md">
                        <div class="flex items-center space-x-4">
                            <div class="bg-gray-200 rounded-full p-4">
                                <i class="fa-solid fa-bed"></i>
                            </div>
                            <div>
                                <div class="text-sm text-gray-500">Recenzije</div>
                                <div class="text-lg font-semibold text-gray-900">
                                    <div class="text-sm text-gray-500">Ukupno: {{ count($property->reviews) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if ($property->reviews->count() > 0)
                            @foreach ($property->reviews as $review)
                                <div class="mt-4 p-4 border-b border-gray-300">
                                    <div class="flex items-center justify-between">
                                        <div class="text-sm font-semibold text-gray-700">
                                            {{ $review->user->first_name }} {{ $review->user->last_name }}
                                        </div>
                                        <div class="ml-2 text-sm text-gray-500">
                                            {{ $review->created_at->format('d M Y') }}
                                        </div>
                                    </div>

                                    <div class="mt-2 text-gray-600">
                                        <strong class="font-semibold">Ocena: </strong>
                                        <span class="text-yellow-500">
                                            @for ($i = 0; $i < $review->rating; $i++)
                                                <i class="fa-solid fa-star"></i>
                                            @endfor
                                            @for ($i = $review->rating; $i < 5; $i++)
                                                <i class="fa-solid fa-star text-gray-300"></i>
                                            @endfor
                                        </span>
                                        / 5
                                    </div>
                                    <div class="mt-2 text-gray-800">
                                        <p>{{ $review->comment }}</p>
                                    </div>
                                </div>
                            @endforeach
                            <div class="mt-4 flex justify-end">
                                <a href="{{ route('review_create', $property) }}"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Ostavi recenziju
                                </a>
                            </div>
                        @else
                            <p class="text-gray-600 mt-4">Još uvek nema recenzija za ovaj apartman.</p>
                            <div class="mt-4 flex justify-end">
                                <a href="{{ route('review_create', $property) }}"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Ostavi recenziju
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            {{-- Contact --}}
            <x-contact :property="$property" />
        </div>
    </div>

    {{-- Swiper Configuration --}}
    <script src="{{ asset('js/swiperConfiguration.js') }}"></script>
    {{-- Custom Styles --}}
    <link rel="stylesheet" href="{{ asset('css/swiper.css') }}">
    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google.maps_api_key') }}"></script>
    {{-- Init map function --}}
    <script>
        function initMap() {
            const location = [{{ $property->latitude }}, {{ $property->longitude }}];

            const map = L.map('map').setView(location, 15);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            L.marker(location).addTo(map);
        }
        window.addEventListener("load", initMap);
    </script>
</x-layout>
