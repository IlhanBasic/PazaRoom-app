@section('title', 'PazaRoom - Kreiraj blog')
<x-layout>
    <link rel="stylesheet" href="{{ asset('css/create-blog.css') }}">
    <h1 class="page-title">Kreiraj blog</h1>
    <form action="{{ route('blog_store') }}" method="POST" enctype="multipart/form-data" class="create-blog-form">
        @csrf
        <label for="category" class="form-label">Kategorija:</label>
        <select name="category" id="category" class="form-select" value="{{ old('category') }}">
            <option value="smeštaj">Smeštaj</option>
            <option value="štednja novca">Štednja novca</option>
            <option value="studentski život">Studentski život</option>
        </select>
        @error('category')
            <p class="error-message">{{ $message }}</p>
        @enderror
        <br>
        <label for="title" class="form-label">Naslov:</label>
        <input type="text" name="title" id="title" class="form-input" required value="{{ old('title') }}">
        @error('title')
            <p class="error-message">{{ $message }}</p>
        @enderror
        <br>
        <label for="image" class="form-label">Slika:</label>
        <input type="file" name="image" id="image" class="form-input" required value="{{ old('image') }}">
        @error('image')
            <p class="error-message">{{ $message }}</p>
        @enderror
        <br>
        <label for="excerpt" class="form-label">Uvod:</label>
        <textarea name="excerpt" id="excerpt" class="form-textarea" required>{{ old('excerpt') }}</textarea>
        @error('excerpt')
            <p class="error-message">{{ $message }}</p>
        @enderror
        <br>
        <label for="read_time" class="form-label">Vreme čitanja (u minutima):</label>
        <input type="number" name="read_time" id="read_time" class="form-input" required
            value="{{ old('read_time') }}">
        @error('read_time')
            <p class="error-message">{{ $message }}</p>
        @enderror
        <br>
        <label for="file_link" class="form-label">Fajl:</label>
        <input type="file" name="file_link" id="file_link" class="form-input" required
            value="{{ old('file_link') }}">
        @error('file_link')
            <p class="error-message">{{ $message }}</p>
        @enderror
        <br>
        <button type="submit" class="submit-button">Kreiraj blog</button>
    </form>
</x-layout>
