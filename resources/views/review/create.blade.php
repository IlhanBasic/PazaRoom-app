@section('title', 'PazaRoom - Ostavi recenziju')
<x-layout>
    <div class="container">
        <div class="review-form">
            <h2 class="form-title">Ostavi recenziju</h2>
            <form action="{{ route('review_store') }}" method="POST" class="form-content">
                @csrf
                <input type="hidden" name="property_id" value="{{ $property->id }}">
                <input type="hidden" name="student_id" value="{{ auth()->id() }}">
                
                <!-- Property Info -->
                <div class="property-info">
                    <h3 class="property-title">{{ $property->title }}</h3>
                    <p class="property-address">{{ $property->address }}</p>
                    <p class="property-owner">{{ $property->owner->first_name }} {{ $property->owner->last_name }} tel: {{ $property->owner->phone_number }}</p>
                </div>

                <!-- Rating Stars -->
                <div class="rating-section">
                    <label class="rating-label">Ocena</label>
                    <div class="rating-stars">
                        @for ($i = 0; $i< 5; $i++)
                            <input type="radio" name="rating" id="star{{ $i }}" value="{{ 5-$i}}" class="rating-input" required>
                            <label for="star{{ $i }}" class="rating-label">
                                <svg class="star-icon" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            </label>
                        @endfor
                    </div>
                    @error('rating')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Comment -->
                <div class="comment-section">
                    <label for="comment" class="comment-label">Vaš komentar</label>
                    <textarea id="comment" name="comment" rows="4" class="comment-input" placeholder="Podelite vaše iskustvo sa ovom nekretninom..." required></textarea>
                    @error('comment')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="form-actions">
                    <button type="submit" class="submit-button">Potvrdi recenziju</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
<link rel="stylesheet" href="{{ asset('css/create-review.css') }}">