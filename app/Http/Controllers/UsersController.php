<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Models\Role; // Import the Role model

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all(); // Fetch all roles from the database
        return view('user.create', compact('roles')); // Pass roles to the view
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validacija ostalih polja
        $formData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => [
                'required',
                'string',
                'min:8',
                Password::min(8)
                    ->mixedCase()  // Lozinka mora imati velika i mala slova
                    ->numbers()    // Lozinka mora imati brojeve
                    ->symbols(),  // Lozinka mora imati specijalne karaktere
            ],
            'phone_number' => ['nullable', 'string', 'max:15', 'regex:/^(06[0-9]{7,8}|\+3816[0-9]{7,8})$/'],
            'role_id' => 'required|exists:roles,id',
        ], [
            'first_name.required' => 'Ime je obavezno.',
            'last_name.required' => 'Prezime je obavezno.',
            'email.required' => 'Email je obavezan.',
            'email.email' => 'Unesite validan email.',
            'email.unique' => 'Email je već registrovan.',
            'password.required' => 'Lozinka je obavezna.',
            'password.min' => 'Lozinka mora imati najmanje 8 karaktera.',
            'password.mixed' => 'Lozinka mora sadržati i velika i mala slova.',
            'password.numbers' => 'Lozinka mora sadržati brojeve.',
            'password.symbols' => 'Lozinka mora sadržati specijalne karaktere.',
            'phone_number.regex' => 'Broj telefona mora biti validan srpski broj (format: 06xxxxxxxx ili +381xxxxxxxx).',
            'role_id.required' => 'Uloga je obavezna.',
            'role_id.exists' => 'Izabrana uloga ne postoji.',
        ]);

        // Šifrovanje lozinke
        $formData['password'] = bcrypt($formData['password']);

        // Kreiranje korisnika
        if (User::create($formData)) {
            return redirect('/users/login')->with('success', 'Korisnik je uspešno kreiran.');
        }

        return redirect('/users/register')->with('error', 'Korisnik nije uspešno kreiran.');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $user = User::find($id);
        if ($user == null) {
            return view('errors.404');
        }
        if (Auth::id() != $user->id) {
            return redirect('/')->with('error', 'Nemate pristup ovoj stranici.');
        }
        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        if ($user == null) {
            return view('errors.404');
        }
        if (Auth::id() != $user->id) {
            return redirect('/')->with('error', 'Nemate pristup ovoj stranici.');
        }
        $roles = Role::all(); // Fetch all roles for editing
        return view('user.edit', compact('user', 'roles')); // Pass user and roles to the view
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        if (Auth::id() !== $user->id) {
            return redirect()
                ->route('home')
                ->with('error', 'Nemate pristup ovoj stranici.');
        }

        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => [
                'nullable',
                'string',
                'max:15',
                'regex:/^(\+381|0)6[0-9]{7,8}$/' // Validates Serbian mobile numbers
            ],
        ];

        // Add password validation rules only if any password field is filled
        if ($request->filled('current_password') || $request->filled('new_password') || $request->filled('new_password_confirmation')) {
            $rules['current_password'] = 'required|string';
            $rules['new_password'] = [
                'required',
                'string',
                'confirmed', // Automatically checks new_password_confirmation
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols(),
                'different:current_password'
            ];
        }

        $validatedData = $request->validate($rules, [
            'first_name.required' => 'Ime je obavezno.',
            'first_name.string' => 'Ime mora biti tekst.',
            'first_name.max' => 'Ime ne može imati više od 255 karaktera.',
            'last_name.required' => 'Prezime je obavezno.',
            'last_name.string' => 'Prezime mora biti tekst.',
            'last_name.max' => 'Prezime ne može imati više od 255 karaktera.',
            'phone_number.regex' => 'Broj telefona mora biti validan srpski broj (format: 06xxxxxxxx ili +381xxxxxxxx).',
            'new_password.different' => 'Nova lozinka ne sme biti ista kao trenutna lozinka.',
            'new_password.confirmed' => 'Nova lozinka i potvrda lozinke se ne poklapaju.',
            'current_password.required' => 'Trenutna lozinka je obavezna.',
            'current_password.string' => 'Trenutna lozinka mora biti tekst.',
            'new_password.required' => 'Nova lozinka je obavezna.',
            'new_password.string' => 'Nova lozinka mora biti tekst.',
            'new_password.min' => 'Nova lozinka mora imati najmanje 8 karaktera.',
            'new_password.mixedCase' => 'Nova lozinka mora sadržati velika i mala slova.',
            'new_password.numbers' => 'Nova lozinka mora sadržati brojeve.',
            'new_password.symbols' => 'Nova lozinka mora sadržati specijalne karaktere.',
        ]);

        // Update basic info
        $user->first_name = $validatedData['first_name'];
        $user->last_name = $validatedData['last_name'];
        $user->phone_number = $validatedData['phone_number'];

        // Handle password update if requested
        if ($request->filled('current_password')) {
            if (!Hash::check($request->input('current_password'), $user->password)) {
                return redirect()
                    ->back()
                    ->withErrors(['current_password' => 'Trenutna lozinka nije ispravna.'])
                    ->withInput();
            }

            $user->password = Hash::make($validatedData['new_password']);
        }

        $user->save();

        return redirect()
            ->route('home')
            ->with('success', 'Profil je uspešno ažuriran.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $current_user = Auth::user();
        if ($user == null || $user->id == $current_user->id || $current_user->role_id != 3) {
            return redirect('/')->with('error', 'Nemate pristup ovoj stranici.');
        }

        // Pokušaj brisanja korisnika
        if (!User::destroy($id)) {

            return redirect('/admin')->with(['error' => 'Korisnik nije uspešno obrisan']);
        }

        return redirect('/admin')->with(['success' => 'Korisnik uspešno obrisan']);
    }

    public function login()
    {
        return view('user.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect('/')->with('success', 'Uspjesno ste se prijavili.');
        }

        return redirect('/users/login')->with('error', 'Pogresni podaci za prijavu.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/properties')->with('success', 'Uspjesno ste se odjavili.');
    }
}
