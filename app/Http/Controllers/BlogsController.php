<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogsController extends Controller
{
    public function index()
    {
        $blogs = Blog::orderBy('created_at', 'desc')->paginate(5);
        return view('blog.index', compact('blogs'));
    }

    public function create()
    {
        return view('blog.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|in:smestaj,stednja novca,studentski zivot',
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string|max:500',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'read_time' => 'required|integer|min:1',
            'file_link' => 'required|file|mimes:html|max:10000',
        ], [
            'category.required' => 'Kategorija je obavezna.',
            'category.in' => 'Kategorija mora biti jedna od sledećih: smeštaj, štednja novca, studentski život.',
            'title.required' => 'Naslov je obavezan.',
            'title.string' => 'Naslov mora biti tekst.',
            'title.max' => 'Naslov ne sme biti duži od 255 karaktera.',
            'excerpt.required' => 'Kratak opis je obavezan.',
            'excerpt.string' => 'Kratak opis mora biti tekst.',
            'excerpt.max' => 'Kratak opis ne sme biti duži od 500 karaktera.',
            'image.required' => 'Slika je obavezna.',
            'image.image' => 'Fajl mora biti slika.',
            'image.mimes' => 'Slika mora biti u jednom od sledećih formata: jpeg, png, jpg, gif.',
            'image.max' => 'Maksimalna veličina slike je 2MB.',
            'read_time.required' => 'Vreme čitanja je obavezno.',
            'read_time.integer' => 'Vreme čitanja mora biti ceo broj.',
            'read_time.min' => 'Minimalno vreme čitanja je 1 minut.',
            'file_link.required' => 'Fajl je obavezan.',
            'file_link.file' => 'Fajl mora biti validan fajl.',
            'file_link.mimes' => 'Fajl mora biti u HTML formatu.',
            'file_link.max' => 'Maksimalna veličina fajla je 10MB.',
        ]);
    
        // Generisanje unikatnih naziva fajlova
        $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
        $fileName = time() . '_' . $request->file('file_link')->getClientOriginalName();
    
        // Spremanje slike na S3 sa storeAs i public visibility
        $imagePath = $request->file('image')->storeAs('blog_images', $imageName, ['disk' => 's3', 'visibility' => 'public']);
        $imageUrl = Storage::disk('s3')->url($imagePath);
    
        // Spremanje fajla na S3 sa storeAs i public visibility
        $filePath = $request->file('file_link')->storeAs('blog_posts', $fileName, ['disk' => 's3', 'visibility' => 'public']);
        $fileUrl = Storage::disk('s3')->url($filePath);
    
        // Kreiranje novog bloga
        Blog::create([
            'category' => $request->category,
            'title' => $request->title,
            'image' => $imageUrl,
            'excerpt' => $request->excerpt,
            'read_time' => $request->read_time,
            'file_link' => $fileUrl,
        ]);
    
        return redirect()->route('blogs')->with('success', 'Blog je uspešno kreiran!');
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
        ], [
            'category.required' => 'Kategorija je obavezna.',
            'category.in' => 'Odabrana kategorija nije validna.',
            'title.required' => 'Naslov je obavezan.',
            'title.string' => 'Naslov mora biti tekst.',
            'title.max' => 'Naslov ne sme biti duži od 255 karaktera.',
            'excerpt.required' => 'Uvod je obavezan.',
            'excerpt.string' => 'Uvod mora biti tekst.',
            'excerpt.max' => 'Uvod ne sme biti duži od 500 karaktera.',
            'image.image' => 'Slika mora biti u formatu: jpeg, png, jpg ili gif.',
            'image.mimes' => 'Dozvoljeni formati slike su: jpeg, png, jpg, gif.',
            'read_time.required' => 'Vreme čitanja je obavezno.',
            'read_time.integer' => 'Vreme čitanja mora biti broj.',
            'file_link.file' => 'Fajl mora biti validan.',
            'file_link.mimes' => 'Dozvoljeni format fajla je: .html.',
        ]);
    
        $blog = Blog::find($id);
        if (!$blog) {
            return redirect()->route('blogs')->with('error', 'Blog nije pronađen!');
        }
    
        // **Čuvanje slike na S3 sa javnom vidljivošću**
        if ($request->hasFile('image')) {
            if ($blog->image) {
                Storage::disk('s3')->delete($blog->image);
            }
            $imagePath = $request->file('image')->store('blog_images', 's3');
            Storage::disk('s3')->setVisibility($imagePath, 'public');
            $blog->image = Storage::disk('s3')->url($imagePath);
        }
        if ($request->hasFile('file_link')) {
            if ($blog->file_link) {
                Storage::disk('s3')->delete($blog->file_link);
            }
            $filePath = $request->file('file_link')->store('blog_posts', 's3');
            Storage::disk('s3')->setVisibility($filePath, 'public');
            $blog->file_link = Storage::disk('s3')->url($filePath);
        }
    
        $blog->update([
            'category' => $request->category,
            'title' => $request->title,
            'excerpt' => $request->excerpt,
            'read_time' => $request->read_time
        ]);
    
        return redirect()->route('blogs')->with('success', 'Blog je uspešno izmenjen!');
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
