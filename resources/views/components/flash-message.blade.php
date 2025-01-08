<link rel="stylesheet" href="{{ asset('css/flash-message.css') }}">
@if (session()->has('success'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
        class="flash-message success">
        <i class="fas fa-check-circle flash-message-icon"></i>
        <span class="flash-message-text">{{ session('success') }}</span>
    </div>
@endif

@if (session()->has('error'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
        class="flash-message error">
        <i class="fas fa-times-circle flash-message-icon"></i>
        <span class="flash-message-text">{{ session('error') }}</span>
    </div>
@endif
