@section('title', 'PazaRoom - Detalji poruke')
<x-layout>
    <link rel="stylesheet" href="{{ asset('css/show-contact.css') }}">
    <div class="message-container">
        <div class="message-card">
            <!-- Header -->
            <div class="message-header">
                <h1>Detalji poruke</h1>
                <a href="{{ route('admin') }}" class="back-link">
                    <i class="fas fa-arrow-left"></i>
                    Nazad na dashboard
                </a>
            </div>

            <!-- Message Content -->
            <div class="message-content">
                <!-- Sender Info -->
                <div class="sender-info">
                    <div class="info-group">
                        <h3>Pošiljalac</h3>
                        <p>{{ $message->name }}</p>
                    </div>
                    <div class="info-group">
                        <h3>Email</h3>
                        <p>{{ $message->email }}</p>
                    </div>
                </div>

                <!-- Subject -->
                <div class="message-subject">
                    <h3>Naslov</h3>
                    <p>{{ $message->subject }}</p>
                </div>

                <!-- Message -->
                <div class="message-body">
                    <h3>Poruka</h3>
                    <div class="message-text">
                        <p>{{ $message->message }}</p>
                    </div>
                </div>

                <!-- Timestamp -->
                <div class="message-timestamp">
                    Poslato: {{ $message->created_at->format('d.m.Y. H:i') }}
                </div>
            </div>

            <!-- Actions -->
            <div class="message-actions">
                {{-- Dugme za otvaranje email klijenta --}}
                <a href="mailto:{{ $message->email }}?subject=Re: {{ $message->subject }}&body=Pozdrav,%0D%0A%0D%0A{{ $message->message }}"
                    class="reply-button">
                    <i class="fas fa-reply"></i> Odgovori na mejl
                </a>
                <form action="{{ route('contact_delete', $message->id) }}" method="POST" id="delete-form-{{ $message->id }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-button">
                        <i class="fas fa-trash"></i>
                        Obriši poruku
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-layout>
<script src="{{ asset('js/deleteButton.js') }}"></script>