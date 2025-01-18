<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogsController extends Controller
{
    // Prikaz svih blogova
    public function index()
    {
        $blogs = Blog::all();
        return view('blog.index', compact('blogs'));
    }

    // Prikaz forme za kreiranje novog bloga
    public function create()
    {
        return view('blog.create');
    }

    // Spremanje novog bloga u bazu
    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|in:smestaj,stednja novca,studentski zivot',
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string|max:500',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'read_time' => 'required|integer',
            'file_link' => 'required|file|mimes:html|max:10000',
        ]);

        // Spremanje slike u storage
        $imagePath = $request->file('image')->store('blog_images', 'public');

        // Spremanje fajla u storage
        $filePath = $request->file('file_link')->store('blog_posts', 'public');

        // Kreiranje novog bloga
        Blog::create([
            'category' => $request->category,
            'title' => $request->title,
            'image' => $imagePath,
            'excerpt' => $request->excerpt,
            'read_time' => $request->read_time,
            'file_link' => $filePath,
        ]);

        return redirect()->route('blogs')->with('success', 'Blog kreiran!');
    }
    public function edit(Blog $blog)
    {
        return view('blog.edit', compact('blog'));
    }
    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'category' => 'required|in:smestaj,stednja novca,studentski zivot',
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string|max:500',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'read_time' => 'required|integer',
            'file_link' => 'file|mimes:html|max:10000',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('blog_images', 'public');
            $blog->image = $imagePath;
        }

        if ($request->hasFile('file_link')) {
            $filePath = $request->file('file_link')->store('blog_posts', 'public');
            $blog->file_link = $filePath;
        }

        $blog->category = $request->category;
        $blog->title = $request->title;
        $blog->excerpt = $request->excerpt;
        $blog->read_time = $request->read_time;
        $blog->save();

        return redirect()->route('blogs')->with('success', 'Blog izmenjen!');
    }
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route('blogs')->with('success', 'Blog obrisan!');
    }
}
