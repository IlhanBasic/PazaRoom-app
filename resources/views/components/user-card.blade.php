@props(['first_name', 'last_name', 'email', 'phone_number', 'role', 'rating', 'id'])
<script src="{{ asset('js/deleteButton.js') }}"></script>

<div class="user-card">
    <div class="user-card-content">
        <div class="user-name">{{ $first_name }} {{ $last_name }}</div>
        <p class="user-details">
            <strong>Email:</strong> {{ $email }}<br>
            <strong>Telefon:</strong> {{ $phone_number }}<br>
            <strong>Uloga:</strong> {{ $role }}<br>
        </p>
    </div>
    <div class="user-card-actions">
        <a href="{{ route('show_user', $id) }}" class="details-button">Detalji</a>

        <form action="{{ route('delete_user', $id) }}" method="POST" class="delete-form" id="delete-form-{{ $id }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="delete-button">Obrisi</button>
        </form>
    </div>
</div>
<link rel="stylesheet" href="{{ asset('css/user-card.css') }}">