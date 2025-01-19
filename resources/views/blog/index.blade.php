<x-layout>
    <link rel="stylesheet" href="{{ asset('css/blog.css') }}">

    <body>
        <header>
            <div class="container">
                <h1>Saveti za studente Blog</h1>
                <p>Trikovi i saveti za studentski život, stanovanje, upravljanje novcem i još mnogo toga.</p><br>
                @if (Auth::check() && Auth::user()->role_id == 3)
                    <a href="{{ route('blog_create') }}" class="create-button">Kreiraj blog</a>
                @endif
            </div>
        </header>
        <main class="container">
            <div class="blog-grid">
                @if($blogs->isEmpty())
                    <p class="empty-message">Nema blogova za prikaz.</p>
                @endif
                @foreach ($blogs as $blog)
                
                    <article class="blog-card"
                        onclick="window.location.href = '{{ asset('storage/' . $blog['file_link']) }}'">
                        <img src="{{ asset('storage/' . $blog['image']) }}" alt="{{ $blog['title'] }}" class="card-image">
                        <div class="card-content">
                            <span class="card-category">{{ $blog['category'] }}</span>
                            <h2 class="card-title">{{ $blog['title'] }}</h2>
                            <p class="card-excerpt">{{ $blog['excerpt'] }}</p>
                            <div class="card-meta">
                                <span>{{ date('M d, Y', strtotime($blog['created_at'])) }}</span>
                                <span>{{ $blog['readTime'] }}</span>
                            </div>
                        </div>
                        @if (Auth::check() && Auth::user()->role_id == 3)
                        <div class="action-buttons">
                            <a href="{{ route('blog_edit', $blog->id) }}" class="details-button">
                                <span>Izmeni</span>
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>
                            {{-- dugme za brisanje i za izmenu  --}}
                            <form action="{{ route('blog_delete', $blog->id) }}" method="POST"
                                class="delete-property-form" data-blog-id="{{ $blog->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-button">
                                    <span>Obriši</span>
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                        @endif
                    </article>
                @endforeach
            </div>
        </main>
    </body>
</x-layout>
