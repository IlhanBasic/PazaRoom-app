<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations = Reservation::paginate(10);
        return view('reservation.index', ['reservations' => $reservations]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $formData = $request->validate([
            'property_id' => 'required|exists:properties,id'
        ]);
        if (!auth()->check()) {
            return redirect()->back()->with('error', 'Morate biti prijavljeni da biste kreirali rezervaciju.');
        }
        // Kreiranje rezervacije
        $reservation = new Reservation([
            'student_id' => auth()->id(), // ID trenutno prijavljenog korisnika
            'property_id' => $request->property_id, // ID nekretnine
            'start_date' => now(),
            'end_date' => null,
            'status' => 'Pending', // Podrazumevano stanje
        ]);

        // Čuvanje rezervacije
        if ($reservation->save()) {
            return redirect()->route('reservations')->with('success', 'Rezervacija je uspešno kreirana.');
        }

        return redirect()->back()->with('error', 'Došlo je do greške prilikom kreiranja rezervacije.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // Validacija ulaznih podataka
        $validated = $request->validate([
            'property_id' => 'required|exists:properties,id',
            'status' => ['required', 'in:Confirmed,Cancelled,Pending'],
        ]);
    
        // Pronalaženje i ažuriranje rezervacije
        $reservation = Reservation::findOrFail($validated['property_id']);
        $reservation->status = $validated['status'];
        $reservation->save();
    
        // Redirekcija sa porukom o uspehu
        return redirect()->route('reservations')
            ->with('success', 'Status rezervacije je uspešno ažuriran.');
    }
    


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reservation = Reservation::findOrFail($id);
        if ($reservation->property->user_id !== auth()->id()) {
            abort(403);
        }
        $reservation->delete();
        return redirect()->route('reservations.index')
            ->with('success', 'Rezervacija uspešno obrisana.');
    }
}
