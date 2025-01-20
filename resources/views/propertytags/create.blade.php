@section('title', 'PazaRoom - Kreiraj tag')
<x-layout>
    <div class="container">
        <h1 class="form-title">Kreiraj tag</h1>
        <form action="{{ route('property_tags_store') }}" method="POST" enctype="multipart/form-data" id="form" class="form-wrapper">
            @csrf
            <!-- Tag -->
            <div class="form-group">
                <label for="title" class="form-label">Naziv taga</label>
                <div class="form-input-wrapper">
                    <input type="text" name="tag" id="tag" required class="form-input" value="{{ old('tag')}}" />
                    @error('tag')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <button id="submit-button" class="submit-button">Sačuvajte</button>
        </form>
        @include('partials._loader')
    </div>
    <script src="{{ asset('js/loading.js') }}"></script>
</x-layout>
<link rel="stylesheet" href="{{ asset('css/create-tag.css') }}">