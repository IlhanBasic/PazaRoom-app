@section('title', 'PazaRoom - Izmeni ulogu')
<x-layout>
    <div class="container">
        <h1 class="form-title">Izmeni ulogu</h1>
        <form action="{{ route('role_update', $role) }}" method="POST" enctype="multipart/form-data" id="form" class="form-container">
            @csrf
            @method('PATCH')
            {{-- Tag --}}
            <div class="form-group">
                <label for="name" class="form-label">Naziv uloge</label>
                <div class="form-input-container">
                    <input type="text" name="name" id="name" required class="form-input" value="{{ $role->name }}" />
                    @error('name')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <button id="submit-button" class="form-button">Sačuvajte</button>
        </form>
        @include('partials._loader')
    </div>
    <script src="{{ asset('js/loading.js') }}"></script>
</x-layout>
<link rel="stylesheet" href="{{ asset('css/create-role.css') }}">