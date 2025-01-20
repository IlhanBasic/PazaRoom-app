<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Property;
use App\Models\PropertyTags;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PropertiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $validated = $request->validate([
            'tag' => 'nullable|string',
            'search' => 'nullable|string',
            'type' => 'nullable|string',
            'rent_price_min' => 'nullable|numeric',
            'rent_price_max' => 'nullable|numeric',
            'area_min' => 'nullable|numeric',
            'area_max' => 'nullable|numeric',
            'sort' => 'nullable|string|in:newest,oldest,price_low_to_high,price_high_to_low,area_low_to_high,area_high_to_low,type_asc,type_desc,worst_to_best,best_to_worst',
        ]);

        return view('property.index', [
            "properties" => Property::where('status', 'Active')
                ->filter($validated)
                ->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();
        if ($user == null || $user->role_id !== 1) {
            return redirect('/')->with('error', 'Nemate pristup ovoj stranici.');
        }
        $tags = PropertyTags::all();
        return view('property.create', ['tags' => $tags]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        if ($user == null || $user->role_id !== 1) {
            return redirect('/')->with('error', 'Nemate pristup ovoj stranici.');
        }
    
        $formData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'tags' => 'nullable|array|max:5',
            'tags.*' => 'string|max:255',
            'area' => 'nullable|integer|gt:0',
            'floors' => 'nullable|integer|gt:0',
            'type' => 'required|in:Stan,Soba',
            'property_type' => 'required|in:Garsonjera,Jednosoban,Dvosoban,Trosoban,4+ soba,Jednokrevetna,Dvokrevetna,Trokrevetna',
            'current_floor' => 'required|integer|lte:floors|gt:0',
            'heating' => 'nullable|in:Centralno,Struja,Gas,Nema',
            'rent_price' => 'nullable|numeric|gt:0',
            'monthly_utilities' => 'nullable|numeric|gt:0',
            'status' => 'nullable|in:Active,Inactive,Pending,Declined',
            'ownership_proof' => 'required|file|mimes:png,jpg,jpeg,pdf',
            'images' => 'nullable|array',
            'images.*' => 'nullable|file|mimes:png,jpg,jpeg',
        ]);
    
        $formData['owner_id'] = auth()->id();
    
        if (isset($formData['tags'])) {
            $formData['tags'] = implode(',', $formData['tags']);
        }
    
        if ($request->hasFile('ownership_proof')) {
            if ($request->file('ownership_proof')->isValid()) {
                $ownershipProofPath = 'ownership_proofs/' . uniqid('proof_', true) . '.' . $request->file('ownership_proof')->extension();
                $proofPath = $request->file('ownership_proof')->storeAs('', $ownershipProofPath, [
                    'disk' => 's3',
                    'visibility' => 'public',
                ]);
                $formData['ownership_proof'] = Storage::disk('s3')->url($proofPath);
            }
        } else {
            $formData['ownership_proof'] = null;
        }
    
        if ($request->hasFile('images')) {
            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $imagePath = 'images/' . uniqid('image_', true) . '.' . $image->extension();
                $storedPath = $image->storeAs('', $imagePath, [
                    'disk' => 's3',
                    'visibility' => 'public',  
                ]);
                $imagePaths[] = Storage::disk('s3')->url($storedPath);
            }
            $formData['images'] = implode(',', $imagePaths);
        } else {
            $formData['images'] = null;
        }
        Property::create($formData);
    
        return redirect('/properties')->with('success', 'Smeštaj je uspešno kreiran.');
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $property = Property::findOrFail($id);
        $owner = User::findOrFail($property->owner_id);
        return view('property.show', ['property' => $property, 'owner' => $owner]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = auth()->user();
        if ($user == null || ($user->role_id !== 1 && $user->role_id !== 3)) {
            return redirect('/')->with('error', 'Nemate pristup ovoj stranici.');
        }
        $property = Property::findOrFail($id);
        $tags = PropertyTags::all();
        if (auth()->id() != $property->owner_id) {
            return redirect('/properties')->with('error', 'Nemate pravo da uređujete ovu nekretninu.');
        }
        return view('property.edit', ['property' => $property, 'tags' => $tags]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = auth()->user();
        if ($user == null || ($user->role_id !== 1 && $user->role_id !== 3)) {
            return redirect('/')->with('error', 'Nemate pristup ovoj stranici.');
        }
    
        $formData = $request->validate([
            'status' => 'required|in:Active,Inactive',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'tags' => 'nullable|array|max:5',
            'tags.*' => 'string|max:255',
            'area' => 'nullable|integer|gt:0',
            'floors' => 'nullable|integer|gt:0',
            'type' => 'required|in:Stan,Soba',
            'property_type' => 'required|in:Garsonjera,Jednosoban,Dvosoban,Trosoban,4+ soba,Jednokrevetna,Dvokrevetna,Trokrevetna',
            'current_floor' => 'required|integer|lte:floors|gt:0',
            'heating' => 'nullable|in:Centralno,Struja,Gas,Nema',
            'rent_price' => 'nullable|numeric|gt:0',
            'monthly_utilities' => 'nullable|numeric|gt:0',
            'status' => 'nullable|in:Active,Inactive',
            'images' => 'nullable|array',
            'images.*' => 'nullable|file|mimes:png,jpg,jpeg',
            'delete_images' => 'nullable|array',
            'delete_images.*' => 'string',
        ]);
    
        if (!auth()->id()) {
            return redirect('/properties')->with('error', 'Morate biti ulogovani da biste izmenili smeštaj.');
        }
    
        $formData['owner_id'] = auth()->id();
        if (isset($formData['tags'])) {
            $formData['tags'] = implode(',', $formData['tags']);
        }

        $property = Property::findOrFail($id);

        if ($request->has('delete_images')) {
            $existingImages = $property->images ? explode(',', $property->images) : [];
            $remainingImages = array_diff($existingImages, $request->delete_images);
    
            foreach ($request->delete_images as $image) {
                if (in_array($image, $existingImages)) {
                    Storage::disk('s3')->delete($image);
                }
            }
    
            $formData['images'] = implode(',', $remainingImages);
        } else {
            $formData['images'] = $property->images;
        }
    
        if ($request->hasFile('images')) {
            $newImagePaths = [];
            foreach ($request->file('images') as $image) {
                $newImagePath = 'images/' . uniqid('image_', true) . '.' . $image->extension();
                $storedPath = $image->storeAs('', $newImagePath, [
                    'disk' => 's3',
                    'visibility' => 'public', 
                ]);
                $newImagePaths[] = Storage::disk('s3')->url($storedPath);
            }
    
            $currentImages = $formData['images'] ? explode(',', $formData['images']) : [];
            $formData['images'] = implode(',', array_merge($currentImages, $newImagePaths));
        }
        $property->fill($formData);
        $property->save();
    
        return redirect('/properties')->with('success', 'Smeštaj je uspešno izmenjen.');
    }
    public function accept(Request $request, string $id)
    {
        $user = auth()->user();
        if ($user == null || $user->role_id !== 3) {
            return redirect('/')->with('error', 'Nemate pristup ovoj stranici.');
        }
        $property = Property::findOrFail($id);
        $property->status = 'Active';
        $property->save();
        return redirect('/admin')->with('success', 'Smeštaj je uspešno aktiviran.');
    }
    public function decline(Request $request, string $id)
    {
        $user = auth()->user();
        if ($user == null || $user->role_id !== 3) {
            return redirect('/')->with('error', 'Nemate pristup ovoj stranici.');
        }
        $property = Property::findOrFail($id);
        $property->status = 'Declined';
        $property->save();
        return redirect('/admin')->with('success', 'Smeštaj je uspešno deaktiviran.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = auth()->user();
        if ($user == null || ($user->role_id !== 3 && $user->role_id !== 1)) {
            return redirect('/')->with('error', 'Nemate pristup ovoj stranici.');
        }
        $property = Property::findOrFail($id);
        if ($property->images) {
            $paths = explode(',', $property->images);
            foreach ($paths as $path) {
                Storage::disk('public')->delete($path);
            }
        }
        $property->delete();

        return redirect('/properties')->with('success', 'Smeštaj uspešno obrisan.');
    }
    public function ownerProperties(Request $request)
    {
        $user = auth()->user();
        if ($user == null || $user->role_id !== 1) {
            return redirect('/')->with('error', 'Nemate pristup ovoj stranici.');
        }
        $ownerId = auth()->id();
        $properties = Property::where('owner_id', $ownerId)->paginate(5);
        return view('property.ownerProperties', ['properties' => $properties]);
    }
}
