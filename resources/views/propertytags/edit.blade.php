<x-layout>
    <div class="container">
        <h1 class="heading">Izmeni tag</h1>
        <form action="{{ route('property_tag_update', $tag) }}" method="POST" enctype="multipart/form-data" id="form"
            class="form-container">
            @csrf
            {{-- Tag --}}
            <div class="form-group">
                <label for="title" class="label">Naziv taga</label>
                <div class="input-container">
                    <input type="text" name="tag" id="tag" required class="input"
                        value="{{ $tag->tag }}" />
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
<link rel="stylesheet" href="{{ asset('css/edit-tag.css') }}">
