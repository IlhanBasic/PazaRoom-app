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
                ->paginate(5)
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
            'images' => 'nullable|array|max:5',
            'images.*' => 'nullable|file|mimes:png,jpg,jpeg',
        ], [
            'title.required' => 'Polje za naslov je obavezno i ne sme biti duže od 255 karaktera.',
            'description.required' => 'Polje za opis je obavezno.',
            'address.required' => 'Polje za adresu je obavezno.',
            'latitude.required' => 'Polje za geografske koordinate je obavezno i mora biti broj.',
            'longitude.required' => 'Polje za geografsku dužinu je obavezno i mora biti broj.',
            'tags.max' => 'Polje za tagove može sadržati najviše 5 stavki.',
            'tags.*.string' => 'Svaki tag mora biti tekstualni string.',
            'tags.*.max' => 'Tagovi ne mogu biti duži od 255 karaktera.',
            'area.gt' => 'Polje za površinu mora biti broj veći od nule.',
            'floors.gt' => 'Polje za spratnost mora biti broj veći od nule.',
            'type.required' => 'Polje za tip smeštaja je obavezno.',
            'property_type.required' => 'Polje za tip svojine je obavezno.',
            'current_floor.lte' => 'Polje za trenutni sprat mora biti manji ili jednak ukupnom broju spratova.',
            'current_floor.gt' => 'Polje za trenutni sprat mora biti veće od nule.',
            'heating.in' => 'Polje za grejanje mora biti jedno od ponuđenih: Centralno, Struja, Gas, Nema.',
            'rent_price.gt' => 'Polje za cenu kirije mora biti broj veći od nule.',
            'monthly_utilities.gt' => 'Polje za mesečne režije mora biti broj veći od nule.',
            'status.in' => 'Polje za status mora biti jedan od ponuđenih: Active, Inactive, Pending, Declined.',
            'ownership_proof.required' => 'Polje za dokaz o vlasništvu mora postojati.',
            'ownership_proof.mimes' => 'Polje za dokaz o vlasništvu mora biti fajl tipa PNG, JPG, JPEG ili PDF.',
            'images.array' => 'Polje za slike mora biti niz.',
            'images.max' => 'Polje za slike može sadržati najviše 5 stavki.',     
            'images.*.file' => 'Svaka slika mora biti fajl.',
            'images.*.mimes' => 'Svaka slika mora biti fajl tipa PNG, JPG, ili JPEG.',
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
        if($property->status == 'Declined') {
            return redirect('/properties')->with('error', 'Nekretnina je odbijena.');
        }
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
        if($property->status == 'Declined') {
            return redirect('/properties')->with('error', 'Nekretnina je odbijena.');
        }
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
            'status' => ['required', 'in:Active,Inactive'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'address' => ['required', 'string'],
            'latitude' => ['required', 'numeric'],
            'longitude' => ['required', 'numeric'],
            'tags' => ['nullable', 'array', 'max:5'],
            'tags.*' => ['string', 'max:255'],
            'area' => ['nullable', 'integer', 'gt:0'],
            'floors' => ['nullable', 'integer', 'gt:0'],
            'type' => ['required', 'in:Stan,Soba'],
            'property_type' => ['required', 'in:Garsonjera,Jednosoban,Dvosoban,Trosoban,4+ soba,Jednokrevetna,Dvokrevetna,Trokrevetna'],
            'current_floor' => ['required', 'integer', 'lte:floors', 'gt:0'],
            'heating' => ['nullable', 'in:Centralno,Struja,Gas,Nema'],
            'rent_price' => ['nullable', 'numeric', 'gt:0'],
            'monthly_utilities' => ['nullable', 'numeric', 'gt:0'],
            'images' => ['nullable', 'array'],
            'images.*' => ['nullable', 'file', 'mimes:png,jpg,jpeg'],
            'delete_images' => ['nullable', 'array'],
            'delete_images.*' => ['string'],
        ], [
            'status.required' => 'Status je obavezan.',
            'status.in' => 'Status može biti samo Active ili Inactive.',
            'title.required' => 'Naslov je obavezan.',
            'title.string' => 'Naslov mora biti tekst.',
            'title.max' => 'Naslov može imati najviše 255 karaktera.',
            'description.required' => 'Opis je obavezan.',
            'address.required' => 'Adresa je obavezna.',
            'latitude.required' => 'Latitude je obavezan.',
            'latitude.numeric' => 'Latitude mora biti broj.',
            'longitude.required' => 'Longitude je obavezna.',
            'longitude.numeric' => 'Longitude mora biti broj.',
            'tags.array' => 'Tagovi moraju biti niz.',
            'tags.max' => 'Maksimalno 5 tagova je dozvoljeno.',
            'tags.*.string' => 'Tag mora biti tekst.',
            'tags.*.max' => 'Svaki tag može imati najviše 255 karaktera.',
            'area.integer' => 'Površina mora biti broj.',
            'area.gt' => 'Površina mora biti veća od 0.',
            'floors.integer' => 'Broj spratova mora biti broj.',
            'floors.gt' => 'Broj spratova mora biti veći od 0.',
            'type.required' => 'Tip smeštaja je obavezan.',
            'type.in' => 'Tip može biti samo Stan ili Soba.',
            'property_type.required' => 'Vrsta nekretnine je obavezna.',
            'property_type.in' => 'Neispravan tip nekretnine.',
            'current_floor.required' => 'Trenutni sprat je obavezan.',
            'current_floor.integer' => 'Trenutni sprat mora biti broj.',
            'current_floor.lte' => 'Trenutni sprat ne može biti veći od ukupnog broja spratova.',
            'current_floor.gt' => 'Trenutni sprat mora biti veći od 0.',
            'heating.in' => 'Neispravan tip grejanja.',
            'rent_price.numeric' => 'Cena rentiranja mora biti broj.',
            'rent_price.gt' => 'Cena rentiranja mora biti veća od 0.',
            'monthly_utilities.numeric' => 'Mesečni troškovi moraju biti broj.',
            'monthly_utilities.gt' => 'Mesečni troškovi moraju biti veći od 0.',
            'images.array' => 'Slike moraju biti niz.',
            'images.*.file' => 'Svaka slika mora biti fajl.',
            'images.*.mimes' => 'Slika mora biti u png, jpg ili jpeg formatu.',
            'delete_images.array' => 'Brisane slike moraju biti niz.',
            'delete_images.*.string' => 'Svaka vrednost u brisanim slikama mora biti string.',
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
        if($user->role_id == 1) {
            return redirect('/properties')->with('success', 'Smeštaj uspešno obrisan.');
        }
        return redirect('/admin')->with('success', 'Smeštaj uspešno obrisan.');
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
