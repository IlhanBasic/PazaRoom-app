<?php

namespace App\Http\Controllers;

use App\Models\PropertyTags;
use Illuminate\Http\Request;

class PropertyTagsController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();
        if ($user == null || $user->role_id !== 3) {
            return redirect('/')->with('error', 'Nemate pristup ovoj stranici.');
        }
        return view('propertytags.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        if ($user == null || $user->role_id !== 3) {
            return redirect('/')->with('error', 'Nemate pristup ovoj stranici.');
        }
        $formData = $request->validate([
            'tag' => 'required|string|max:255',
        ]);

        if (PropertyTags::create($formData)) {
            return redirect('/admin')->with('success', 'Tag je uspešno kreiran.');
        }

        return redirect('/admin')->with('error', 'Tag nije uspešno kreiran.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = auth()->user();
        if ($user == null || $user->role_id !== 3) {
            return redirect('/')->with('error', 'Nemate pristup ovoj stranici.');
        }
        $tag = PropertyTags::findOrFail($id);
        return view('propertytags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = auth()->user();
        if ($user == null || $user->role_id !== 3) {
            return redirect('/')->with('error', 'Nemate pristup ovoj stranici.');
        }
        $formData = $request->validate([
            'tag' => 'required|string|max:255',
        ]);

        $propertyTag = PropertyTags::findOrFail($id);

        if ($propertyTag->update($formData)) {
            return redirect('/admin')->with('success', 'Tag je uspešno ažuriran.');
        }

        return redirect('/admin')->with('error', 'Tag nije uspešno ažuriran.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = auth()->user();
        if ($user == null || $user->role_id !== 3) {
            return redirect('/')->with('error', 'Nemate pristup ovoj stranici.');
        }
        if (PropertyTags::destroy($id)) {
            return redirect('/admin')->with('success', 'Tag je uspešno obrisan.');
        }

        return redirect('/admin')->with('error', 'Tag nije uspešno obrisan.');
    }
}
