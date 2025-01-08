@props(['tagsCsv'])
@php
    $tags = explode(',', $tagsCsv);
@endphp
<ul class="tag-list">
    @foreach ($tags as $tag)
        <li class="tag-item">
            <a href="?tag={{ $tag }}">{{ $tag }}</a>
        </li>
    @endforeach
</ul>
<link rel="stylesheet" href="{{ asset('css/tags.css') }}">