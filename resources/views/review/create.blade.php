@section('title', 'PazaRoom - Ostavi recenziju')
<x-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Ostavi recenziju</h2>
            <form action="{{ route('review_store') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="property_id" value="{{ $property->id }}">
                <input type="hidden" name="student_id" value="{{ auth()->id() }}">
                <!-- Property Info -->
                <div class="bg-gray-50 p-4 rounded-lg mb-6">
                    <h3 class="font-semibold text-lg text-gray-700">{{ $property->title }}</h3>
                    <p class="text-gray-600">{{ $property->address }}</p>
                    <p class="text-gray-600">{{$property->owner->first_name}} {{ $property->owner->last_name }} tel: {{$property->owner->phone_number}}</p>
                </div>
    
                <!-- Rating Stars -->
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-3">Ocena</label>
                    <div class="flex items-center space-x-1">
                        @for ($i = 5; $i > 0; $i--)
                            <input type="radio" name="rating" id="star{{ $i }}" value="{{ $i }}" class="hidden peer" required>
                            <label for="star{{ $i }}" class="cursor-pointer">
                                <svg class="w-8 h-8 text-gray-300 peer-checked:text-yellow-400 hover:text-yellow-400 transition-colors duration-200"
                                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            </label>
                        @endfor
                    </div>
                    @error('rating')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
    
                <!-- Comment -->
                <div class="mb-6">
                    <label for="comment" class="block text-gray-700 text-sm font-bold mb-2">Vaš komentar</label>
                    <textarea
                        id="comment"
                        name="comment"
                        rows="4"
                        class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none"
                        placeholder="Podelite vaše iskustvo sa ovom nekretninom..."
                        required
                    ></textarea>
                    @error('comment')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
    
                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button
                        type="submit"
                        class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                    >
                        Potvrdi recenziju
                    </button>
                </div>
            </form>
        </div>
    </div>
    <style>
        /* Custom styles for better star rating interaction */
        input[name="rating"]:checked ~ label svg {
            color: #FBBF24;
        }
        
        input[name="rating"]:hover ~ label svg {
            color: #FBBF24;
        }
    </style>
</x-layout>