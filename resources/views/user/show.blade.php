@section('title', 'PazaRoom - Moj profil')
<x-layout>
    <div class="profile-container">
        <h1 class="title">Detalji Korisnika</h1>

        <div class="profile-card">
            <div class="profile-details">
                <h2 class="profile-name">{{ $user->first_name }} {{ $user->last_name }}</h2>
                <p class="profile-info"><strong>Email:</strong> <span class="info-value">{{ $user->email }}</span></p>
                <p class="profile-info"><strong>Telefon:</strong> <span class="info-value">{{ $user->phone_number }}</span></p>
                <p class="profile-info"><strong>Vrsta korisnika:</strong> <span class="info-value">{{ $user->role->name }}</span></p>
            </div>

            <div class="edit-button-container">
                <a href="{{ route('edit_user', $user->id) }}" class="edit-button">Uredi <i class="fas fa-edit"></i></a>
            </div>
        </div>
    </div>
</x-layout>
<link rel="stylesheet" href="{{ asset('css/my-profile.css') }}">