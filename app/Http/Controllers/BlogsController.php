<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
    public function edit($id)
    {
        $blog = Blog::find($id);
        return view('blog.edit', compact('blog'));
    }
    
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'category' => 'required|in:smestaj,stednja novca,studentski zivot',
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'read_time' => 'required|integer',
            'file_link' => 'nullable|file|mimes:html',
        ]);
    
        $blog = Blog::find($id);
        if(!$blog){
            return redirect()->route('blogs')->with('error', 'Blog nije pronađen!');
        }
        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($blog->image) {
                Storage::disk('public')->delete($blog->image);
            }
            $imagePath = $request->file('image')->store('blog_images', 'public');
            $blog->image = $imagePath;
        }
        if ($request->hasFile('file_link')) {
            // Delete old file if it exists
            if ($blog->file_link) {
                Storage::disk('public')->delete($blog->file_link);
            }
            $filePath = $request->file('file_link')->store('blog_posts', 'public');
            $blog->file_link = $filePath;
        }
        $blog->update([
            'category' => $request->category,
            'title' => $request->title,
            'excerpt' => $request->excerpt,
            'read_time' => $request->read_time
        ]);
    
        return redirect()->route('blogs')->with('success', 'Blog izmenjen!');
    }
    public function destroy($id)
    {
        $blog = Blog::find($id);
        $blog->delete();    
        if ($blog->file_link) {
            Storage::disk('public')->delete($blog->file_link);
        }
        if ($blog->image) {
            Storage::disk('public')->delete($blog->image);
        }
        return redirect()->route('blogs')->with('success', 'Blog obrisan!');
    }
}
