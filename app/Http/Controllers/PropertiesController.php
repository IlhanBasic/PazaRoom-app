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

        // Validacija ulaznih podataka
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
            'ownership_proof' => 'required|file|mimes:png,jpg,jpeg,pdf|max:10240',
            'images' => 'nullable|array|max:10',
            'images.*' => 'nullable|file|mimes:png,jpg,jpeg',
        ], [
            'title.required' => 'Naziv je obavezan.',
            'title.string' => 'Naziv mora biti tekst.',
            'title.max' => 'Naziv ne može imati više od 255 karaktera.',
            'description.required' => 'Opis je obavezan.',
            'description.string' => 'Opis mora biti tekst.',
            'address.required' => 'Adresa je obavezna.',
            'address.string' => 'Adresa mora biti tekst.',
            'latitude.required' => 'Geografska širina je obavezna.',
            'latitude.numeric' => 'Geografska širina mora biti broj.',
            'longitude.required' => 'Geografska dužina je obavezna.',
            'longitude.numeric' => 'Geografska dužina mora biti broj.',
            'tags.array' => 'Tagovi moraju biti u obliku niza.',
            'tags.max' => 'Možete dodati najviše 5 tagova.',
            'tags.*.string' => 'Svaki tag mora biti tekst.',
            'tags.*.max' => 'Svaki tag ne može imati više od 255 karaktera.',
            'area.integer' => 'Površina mora biti broj.',
            'area.gt' => 'Površina mora biti veća od 0.',
            'floors.integer' => 'Spratnost mora biti broj.',
            'floors.gt' => 'Spratnost mora biti veća od 0.',
            'type.required' => 'Tip nekretnine je obavezan.',
            'type.in' => 'Tip nekretnine mora biti "Stan" ili "Soba".',
            'property_type.required' => 'Vrsta nekretnine je obavezna.',
            'property_type.in' => 'Vrsta nekretnine mora biti jedna od: Garsonjera, Jednosoban, Dvosoban, Trosoban, 4+ soba, Jednokrevetna, Dvokrevetna, Trokrevetna.',
            'current_floor.required' => 'Sprat je obavezan.',
            'current_floor.integer' => 'Sprat mora biti broj.',
            'current_floor.lte' => 'Sprat ne može biti veći od ukupnog broja spratova.',
            'current_floor.gt' => 'Sprat mora biti veći od 0.',
            'heating.in' => 'Grejanje mora biti jedan od sledećih: Centralno, Struja, Gas, Nema.',
            'rent_price.numeric' => 'Cena rentiranja mora biti broj.',
            'rent_price.gt' => 'Cena rentiranja mora biti veća od 0.',
            'monthly_utilities.numeric' => 'Mesecni troškovi mora biti broj.',
            'monthly_utilities.gt' => 'Mesecni troškovi mora biti veći od 0.',
            'status.in' => 'Status mora biti jedan od sledećih: Active, Inactive, Pending, Declined.',
            'ownership_proof.required' => 'Dokaz o vlasništvu je obavezan.',
            'ownership_proof.file' => 'Dokaz o vlasništvu mora biti fajl.',
            'ownership_proof.mimes' => 'Dokaz o vlasništvu mora biti jedan od sledećih formata: png, jpg, jpeg, pdf.',
            'ownership_proof.max' => 'Dokaz o vlasništvu ne može biti veći od 10MB.',
            'images.array' => 'Slike moraju biti u obliku niza.',
            'images.max' => 'Možete dodati najviše 10 slika.',
            'images.*.file' => 'Svaka slika mora biti fajl.',
            'images.*.mimes' => 'Svaka slika mora biti jedan od sledećih formata: png, jpg, jpeg.',
        ]);

        // Dodavanje `owner_id`
        $formData['owner_id'] = auth()->id();

        // Konverzija tagova u CSV format
        if (isset($formData['tags'])) {
            $formData['tags'] = implode(',', $formData['tags']);
        }

        // Procesiranje ownership_proof (ako postoji)
        if ($request->hasFile('ownership_proof')) {
            // Osigurajte da samo jedan fajl bude poslat
            if ($request->file('ownership_proof')->isValid()) {
                $formData['ownership_proof'] = $request->file('ownership_proof')->store('ownership_proofs', 'public');
            }
        } else {
            $formData['ownership_proof'] = null; // Ako fajl nije poslat
        }

        // Procesiranje slika (ako postoji)
        if ($request->hasFile('images')) {
            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                // Proveriti da li je broj slika manji ili jednak 10
                $imagePaths[] = $image->store('images', 'public');
            }
            $formData['images'] = implode(',', $imagePaths); // Slike se čuvaju u bazi kao CSV string
        } else {
            $formData['images'] = null;
        }

        // Kreiranje novog objekta
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
            'images' => 'nullable|array|max:10',
            'images.*' => 'nullable|file|mimes:png,jpg,jpeg',
            'delete_images' => 'nullable|array',
            'delete_images.*' => 'string',
        ], [
            'status.required' => 'Status je obavezan.',
            'status.in' => 'Status mora biti Active ili Inactive.',
            'title.required' => 'Naziv je obavezan.',
            'title.string' => 'Naziv mora biti tekst.',
            'title.max' => 'Naziv ne sme biti duži od 255 karaktera.',
            'description.required' => 'Opis je obavezan.',
            'description.string' => 'Opis mora biti tekst.',
            'address.required' => 'Adresa je obavezna.',
            'address.string' => 'Adresa mora biti tekst.',
            'latitude.required' => 'Širina je obavezna.',
            'latitude.numeric' => 'Širina mora biti broj.',
            'longitude.required' => 'Dužina je obavezna.',
            'longitude.numeric' => 'Dužina mora biti broj.',
            'tags.array' => 'Tagovi moraju biti niz.',
            'tags.max' => 'Broj tagova ne može biti veći od 5.',
            'tags.*.string' => 'Svaki tag mora biti tekst.',
            'tags.*.max' => 'Svaki tag ne sme biti duži od 255 karaktera.',
            'area.integer' => 'Površina mora biti broj.',
            'area.gt' => 'Površina mora biti veća od 0.',
            'floors.integer' => 'Broj spratova mora biti broj.',
            'floors.gt' => 'Broj spratova mora biti veći od 0.',
            'type.required' => 'Tip je obavezan.',
            'type.in' => 'Tip mora biti Stan ili Soba.',
            'property_type.required' => 'Vrsta nekretnine je obavezna.',
            'property_type.in' => 'Vrsta nekretnine mora biti jedan od ponuđenih tipova.',
            'current_floor.required' => 'Trenutni sprat je obavezan.',
            'current_floor.integer' => 'Trenutni sprat mora biti broj.',
            'current_floor.lte' => 'Trenutni sprat ne može biti veći od broja spratova.',
            'current_floor.gt' => 'Trenutni sprat mora biti veći od 0.',
            'heating.in' => 'Grejanje mora biti jedno od ponuđenih.',
            'rent_price.numeric' => 'Cena rentiranja mora biti broj.',
            'rent_price.gt' => 'Cena rentiranja mora biti veća od 0.',
            'monthly_utilities.numeric' => 'Mesečni troškovi mora biti broj.',
            'monthly_utilities.gt' => 'Mesečni troškovi moraju biti veći od 0.',
            'images.array' => 'Slike moraju biti niz.',
            'images.max' => 'Ne može biti više od 10 slika.',
            'images.*.file' => 'Svaka slika mora biti fajl.',
            'images.*.mimes' => 'Slike moraju biti u formatu png, jpg, ili jpeg.',
            'delete_images.array' => 'Obrisane slike moraju biti niz.',
            'delete_images.*.string' => 'Svaka obrisana slika mora biti string.',
        ]);

        // Provera autentifikacije
        if (!auth()->id()) {
            return redirect('/properties')->with('error', 'Morate biti ulogovani da biste izmenili smeštaj.');
        }

        $formData['owner_id'] = auth()->id();

        // Obrada tagova
        if (isset($formData['tags'])) {
            $formData['tags'] = implode(',', $formData['tags']);
        }

        // Dohvatanje nekretnine iz baze
        $property = Property::findOrFail($id);

        // Obrada brisanja označenih slika
        if ($request->has('delete_images')) {
            $existingImages = $property->images ? explode(',', $property->images) : [];
            $remainingImages = array_diff($existingImages, $request->delete_images);

            // Brisanje označenih slika sa diska
            foreach ($request->delete_images as $image) {
                if (in_array($image, $existingImages)) {
                    Storage::disk('public')->delete($image);
                }
            }

            $formData['images'] = implode(',', $remainingImages);
        } else {
            $formData['images'] = $property->images;
        }

        // Dodavanje novih slika
        if ($request->hasFile('images')) {
            $newImagePaths = [];
            foreach ($request->file('images') as $image) {
                $newImagePaths[] = $image->store('images', 'public');
            }

            // Kombinovanje preostalih i novih slika
            $currentImages = $formData['images'] ? explode(',', $formData['images']) : [];
            $formData['images'] = implode(',', array_merge($currentImages, $newImagePaths));
        }

        // Ažuriranje nekretnine
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

        // Opcionalno, obrišite slike sa servera pre brisanja zapisa iz baze
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
