
<div
    class="lg:fixed lg:right-8 lg:top-1/2 lg:transform lg:-translate-y-1/2 bg-white rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 max-w-sm z-50 mt-4">
    <div class="p-6">
        {{-- Header --}}
        <div class="flex items-center space-x-3 mb-4">
            <div class="bg-blue-50 rounded-full p-3">
                <i class="fas fa-user-circle text-blue-600 text-xl"></i>
            </div>
            <h2 class="text-lg font-semibold text-gray-800">Kontakt Vlasnika</h2>
        </div>

        <div class="space-y-4">
            {{-- Name --}}
            <div class="flex items-center space-x-3">
                <div class="flex-shrink-0">
                    <i class="fas fa-id-card text-gray-400"></i>
                </div>
                <div>
                    <p class="font-medium text-gray-900">
                        {{ $property->owner->first_name }} {{ $property->owner->last_name }}
                    </p>
                </div>
            </div>

            {{-- Phone --}}
            <a href="tel:{{ $property->owner->phone_number }}"
                class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-50 transition-colors duration-200 group">
                <div class="flex-shrink-0">
                    <i
                        class="fas fa-phone text-green-500 group-hover:text-green-600 transition-colors duration-200"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Telefon</p>
                    <p class="font-medium text-gray-900 group-hover:text-green-600 transition-colors duration-200">
                        {{ $property->owner->phone_number }}
                    </p>
                </div>
            </a>

            {{-- Email --}}
            <a href="mailto:{{ $property->owner->email }}"
                class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-50 transition-colors duration-200 group">
                <div class="flex-shrink-0">
                    <i
                        class="fas fa-envelope text-blue-500 group-hover:text-blue-600 transition-colors duration-200"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Email</p>
                    <p class="font-medium text-gray-900 group-hover:text-blue-600 transition-colors duration-200">
                        {{ $property->owner->email }}
                    </p>
                </div>
            </a>
        </div>

        {{-- Action Button --}}
        <div class="mt-6">
            <button onclick="window.location.href='mailto:{{ $property->owner->email }}'"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 px-4 rounded-lg transition-colors duration-200 flex items-center justify-center space-x-2">
                <i class="fas fa-paper-plane"></i>
                <span>Pošalji Poruku</span>
            </button>
        </div>
    </div>
</div>
