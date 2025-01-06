@props(['first_name', 'last_name', 'email', 'phone_number', 'role', 'rating', 'id'])
<script src="{{asset('js/deleteButton.js')}}"></script>
<div class="max-w-sm rounded overflow-hidden shadow-lg bg-white transition-transform transform hover:scale-105">
    <div class="px-6 py-4">
        <div class="font-bold text-xl mb-2 text-blue-600">{{ $first_name }} {{ $last_name }}</div>
        <p class="text-gray-700 text-base">
            <strong>Email:</strong> {{ $email }}<br>
            <strong>Telefon:</strong> {{ $phone_number }}<br>
            <strong>Uloga:</strong> {{ $role }}<br>
        </p>
    </div>
    <div class="flex justify-between px-6 pt-4 pb-2">
        <a href="{{ route('show_user', $id) }}"
            class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Detalji</a>

        <form action="{{ route('delete_user', $id) }}" method="POST" class="inline" id="delete-form-{{ $id }}">
            @csrf
            @method('DELETE')
            <button type="submit"
                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Obrisi</button>
        </form>
    </div>
</div>
