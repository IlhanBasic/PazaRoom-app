@section('title', 'PazaRoom - Moj profil')
<x-layout>
    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold text-center mb-6 text-blue-600">Detalji Korisnika</h1>

        <div class="max-w-md mx-auto bg-white rounded-lg shadow-lg overflow-hidden transition-transform transform hover:scale-105">
            <div class="p-6">
                <h2 class="text-2xl font-semibold text-blue-600 mb-2">{{ $user->first_name }} {{ $user->last_name }}</h2>
                <p class="text-gray-800"><strong>Email:</strong> <span class="text-gray-600">{{ $user->email }}</span></p>
                <p class="text-gray-800"><strong>Telefon:</strong> <span class="text-gray-600">{{ $user->phone_number }}</span></p>
                <p class="text-gray-800"><strong>Vrsta korisnika:</strong> <span class="text-gray-600">{{ $user->role->name }}</span></p>
            </div>

            <div class="flex justify-center p-4 gap-4">
                <a href="{{ route('edit_user', $user->id) }}" class="bg-green-300 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 transform hover:scale-105">Uredi <i class="fas fa-edit"></i></a>
            </div>
        </div>
    </div>
</x-layout>
