@if (session()->has('success'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
        class="fixed bottom-4 right-4 bg-green-500 text-white py-4 px-6 rounded-lg shadow-lg flex items-center transition-all duration-300 ease-in-out z-50">
        
        <i class="fas fa-check-circle mr-2 text-xl"></i>
        <span>{{ session('success') }}</span>
    </div>
@endif
@if (session()->has('error'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
        class="fixed bottom-4 right-4 bg-red-500 text-white py-4 px-6 rounded-lg shadow-lg flex items-center transition-all duration-300 ease-in-out z-50">
        
        <i class="fas fa-times-circle mr-2 text-xl"></i>
        <span>{{ session('error') }}</span>
    </div>
@endif
