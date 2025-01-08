<link rel="stylesheet" href="{{ asset('css/contact.css') }}">
<div class="contact-container">
    <div class="contact-header">
        <div class="contact-header-icon">
            <i class="fas fa-user-circle" style="color: #3182ce; font-size: 1.25rem;"></i>
        </div>
        <h2 class="contact-header-title">Kontakt Vlasnika</h2>
    </div>

    <div class="contact-body">
        <!-- Name -->
        <div class="contact-item">
            <div class="contact-item-icon">
                <i class="fas fa-id-card" style="color: #a0aec0;"></i>
            </div>
            <div>
                <p class="contact-item-value">{{ $property->owner->first_name }} {{ $property->owner->last_name }}</p>
            </div>
        </div>

        <!-- Phone -->
        <a href="tel:{{ $property->owner->phone_number }}" class="contact-item">
            <div class="contact-item-icon">
                <i class="fas fa-phone" style="color: #48bb78;"></i>
            </div>
            <div>
                <p class="contact-item-text">Telefon</p>
                <p class="contact-item-value">{{ $property->owner->phone_number }}</p>
            </div>
        </a>

        <!-- Email -->
        <a href="mailto:{{ $property->owner->email }}" class="contact-item">
            <div class="contact-item-icon">
                <i class="fas fa-envelope" style="color: #3182ce;"></i>
            </div>
            <div>
                <p class="contact-item-text">Email</p>
                <p class="contact-item-value">{{ $property->owner->email }}</p>
            </div>
        </a>
    </div>

    <!-- Action Button -->
    <div class="contact-action">
        <button onclick="window.location.href='mailto:{{ $property->owner->email }}'" class="contact-action-button">
            <i class="fas fa-paper-plane"></i>
            <span>Pošalji Poruku</span>
        </button>
    </div>
</div>

