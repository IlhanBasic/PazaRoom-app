@section('title', 'PazaRoom - Izmeni blog')
<x-layout>
    <link rel="stylesheet" href="{{ asset('css/create-blog.css') }}">
    <h1 class="page-title">Izmeni blog ID: {{$blog->id}}</h1>
    <form action="{{ route('blog_update', $blog->id) }}" method="POST" enctype="multipart/form-data"
        class="create-blog-form">
        @csrf
        @method('PATCH')
        <label for="category" class="form-label">Kategorija:</label>
        <select name="category" id="category" class="form-select" value="{{ $blog->category }}">
            <option value="smestaj">Smestaj</option>
            <option value="stednja novca">Štednja novca</option>
            <option value="studentski zivot">Studentski život</option>
        </select>
        @error('category')
            <p class="error-message">{{ $message }}</p>
        @enderror
        <br>
        <label for="title" class="form-label">Naslov:</label>
        <input type="text" name="title" id="title" class="form-input" required value="{{ $blog->title }}">
        @error('title')
            <p class="error-message">{{ $message }}</p>
        @enderror
        <br>
        <label for="image" class="form-label">Slika: </label>
        <input type="file" name="image" id="image" class="form-input">
        <div class="blog-image-preview">
            @if ($blog->image)
                <p>Trenutna slika: </p>
                <img src="{{ asset($blog->image) }}" alt="Blog Image">
            @endif
        </div>
        @error('image')
            <p class="error-message">{{ $message }}</p>
        @enderror
        <br>
        <label for="excerpt" class="form-label">Uvod:</label>
        <textarea name="excerpt" id="excerpt" class="form-textarea" required>{{ $blog->excerpt }}</textarea>
        @error('excerpt')
            <p class="error-message">{{ $message }}</p>
        @enderror
        <br>
        <label for="read_time" class="form-label">Vreme čitanja (u minutima):</label>
        <input type="number" name="read_time" id="read_time" class="form-input" required
            value="{{ $blog->read_time }}">
        @error('read_time')
            <p class="error-message">{{ $message }}</p>
        @enderror
        <br>
        <label for="file_link" class="form-label">Fajl:</label>
        <input type="file" name="file_link" id="file_link" class="form-input">
        <div class="blog-file-preview">
            @if ($blog->file_link)
            <p>Trenutni fajl: </p>
                <a href="{{ asset('storage/' . $blog->file_link) }}" target="_blank">{{ $blog->file_link }}</a>
            @endif
        </div>
        @error('file_link')
            <p class="error-message">{{ $message }}</p>
        @enderror
        <br>
        <button type="submit" class="submit-button">Izmeni blog</button>
    </form>
</x-layout>
