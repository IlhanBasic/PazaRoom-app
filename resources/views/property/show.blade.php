@section('title', 'PazaRoom - Stan ' . $property->id)
<x-layout>
    <div class="min-h-screen bg-gradient main-width">
        <div class="container">
            @auth
                @if ($property->owner_id == Auth::user()->id)
                    <a href="{{ $property->id . '/edit' }}" class="edit-btn">Edit</a>
                @endif
            @endauth
            
            <div class="content-container">
                @if ($property->images)
                    <div class="gallery-container">
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                @foreach (explode(',', $property->images) as $image)
                                    <div class="swiper-slide">
                                        <a href="{{ asset('storage/' . $image) }}" data-lightbox="apartment-gallery"
                                            data-title="Apartment view">
                                            <img src="{{ asset('storage/' . $image) }}" alt="Apartment view"
                                                class="gallery-img">
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
                    <div class="gallery-container">
                        <img src="{{ asset('images/no-image.png') }}" alt="Apartment view" class="gallery-img">
                    </div>
                @endif

                <div class="content-section">
                    <div class="header">
                        <h1 class="title">{{ $property->title }}</h1>
                        <div class="location">
                            <svg class="location-icon" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            {{ $property->address }}
                        </div>
                    </div>

                    <div class="pricing">
                        <div class="pricing-grid">
                            <div>
                                <div class="pricing-label">Cena zakupa</div>
                                <div class="pricing-value">€{{ number_format($property->rent_price, 2) }}</div>
                            </div>
                            <div>
                                <div class="pricing-label">Mesečni troškovi</div>
                                <div class="pricing-value">€{{ number_format($property->monthly_utilities, 2) }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="details-grid">
                        <div class="detail-card">
                            <div class="detail-content">
                                <div class="detail-icon">
                                    <i class="fa-solid fa-ruler"></i>
                                </div>
                                <div>
                                    <div class="detail-label">Površina</div>
                                    <div class="detail-value">{{ $property->area }} m<sup>2</sup></div>
                                </div>
                            </div>
                        </div>

                        <div class="detail-card">
                            <div class="detail-content">
                                <div class="detail-icon">
                                    <i class="fa-solid fa-building"></i>
                                </div>
                                <div>
                                    <div class="detail-label">Sprat</div>
                                    <div class="detail-value">{{ $property->current_floor }}/{{ $property->floors }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="detail-card">
                            <div class="detail-content">
                                <div class="detail-icon">
                                    <i class="fa-solid fa-fire"></i>
                                </div>
                                <div>
                                    <div class="detail-label">Grejanje</div>
                                    <div class="detail-value">{{ $property->heating }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="details-grid">
                        <div class="detail-card">
                            <div class="detail-content">
                                <div class="detail-icon">
                                    <i class="fa-solid fa-home"></i>
                                </div>
                                <div>
                                    <div class="detail-label">Tip smeštaja</div>
                                    <div class="detail-value">{{ $property->type }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="detail-card">
                            <div class="detail-content">
                                <div class="detail-icon">
                                    <i class="fa-solid fa-bed"></i>
                                </div>
                                <div>
                                    <div class="detail-label">Vrsta</div>
                                    <div class="detail-value">{{ $property->property_type }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="owner-tags">
                        <div class="owner-info">
                            <div class="detail-icon">
                                <i class="fa-solid fa-user"></i>
                            </div>
                            <div>
                                <div class="detail-label">Vlasnik</div>
                                <div class="detail-value">
                                    {{ $owner->first_name }} {{ $owner->last_name }}
                                </div>
                                <p><i class="fa-solid fa-phone"></i> {{ $property->owner->phone_number }}</p>
                                <p><i class="fa-solid fa-envelope"></i> {{ $property->owner->email }}</p>
                            </div>
                        </div>

                        @if ($property->tags)
                            <div>
                                <div class="detail-label">Karakteristike</div>
                                <div class="tags-container">
                                    <x-property-tags :tagsCsv="$property['tags']" />
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="owner-tags">
                        <div class="owner-info">
                            <div class="detail-icon">
                                <i class="fa-solid fa-map"></i>
                            </div>
                            <div>
                                <div class="detail-label">Karta</div>
                            </div>
                        </div>
                        <div id="map"></div>
                    </div>

                    <div class="owner-tags">
                        <div class="owner-info">
                            <div class="detail-icon">
                                <i class="fa-solid fa-pen-nib"></i>
                            </div>
                            <div>
                                <div class="detail-label">Opis</div>
                                <div class="detail-value">
                                    {{ $property->description }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="reviews">
                        <div class="detail-content">
                            <div class="detail-icon">
                                <i class="fa-solid fa-bed"></i>
                            </div>
                            <div>
                                <div class="detail-label">Recenzije</div>
                                <div class="detail-value">
                                    <div class="detail-label">Ukupno: {{ count($property->reviews) }}</div>
                                </div>
                            </div>
                        </div>

                        @if ($property->reviews->count() > 0)
                            @foreach ($property->reviews as $review)
                                <div class="review-item">
                                    <div class="review-header">
                                        <div class="review-author">
                                            {{ $review->user->first_name }} {{ $review->user->last_name }}
                                        </div>
                                        <div class="review-date">
                                            {{ $review->created_at->format('d M Y') }}
                                        </div>
                                    </div>

                                    <div class="review-rating">
                                        <strong>Ocena: </strong>
                                        <span class="star-rating">
                                            @for ($i = 0; $i < $review->rating; $i++)
                                                <i class="fa-solid fa-star"></i>
                                            @endfor
                                            @for ($i = $review->rating; $i < 5; $i++)
                                                <i class="fa-solid fa-star star-empty"></i>
                                            @endfor
                                        </span>
                                        / 5
                                    </div>
                                    <div class="review-comment">
                                        <p>{{ $review->comment }}</p>
                                    </div>
                                </div>
                            @endforeach
                            <div class="review-actions">
                                <a href="{{ route('review_create', $property) }}" class="review-btn">
                                    Ostavi recenziju
                                </a>
                            </div>
                        @else
                            <p class="review-empty">Još uvek nema recenzija za ovaj apartman.</p>
                            <div class="review-actions">
                                <a href="{{ route('review_create', $property) }}" class="review-btn">
                                    Ostavi recenziju
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <x-contact :property="$property" />
        </div>
    </div>

    <script src="{{ asset('js/swiperConfiguration.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/swiper.css') }}">
    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google.maps_api_key') }}"></script>
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
<link rel="stylesheet" href="{{ asset('css/show-property.css') }}">