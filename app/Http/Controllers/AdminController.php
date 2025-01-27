<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Review;
use App\Models\Property;
use App\Models\PropertyTags;
use Illuminate\Http\Request;
use App\Models\Contact_Message;
use Illuminate\Validation\Rules\Password;

class AdminController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if ($user == null || $user->role_id !== 3) {
            return redirect('/')->with('error', 'Nemate pristup ovoj stranici.');
        }
        $users = User::all();
        $properties = Property::all();
        $propertyTags = PropertyTags::all();
        $reviews = Review::all();
        $roles = Role::all();
        $messages = Contact_Message::all();
        return view('admin.dashboard', ['users' => $users, 'properties' => $properties, 'propertyTags' => $propertyTags, 'reviews' => $reviews, 'roles' => $roles, 'messages' => $messages]);
    }
    public function create_user()
    {
        $user = auth()->user();
        if($user == null || $user->role_id !== 3) {
            return redirect('/')->with('error', 'Nemate pristup ovoj stranici.');
        }
        $roles = Role::all();
        return view('admin.create-user', ['roles' => $roles]);
    }
    public function store_user(Request $request)
    {
        // Validacija ostalih polja
        $formData = $request->validate([
            'first_name' => 'required|regex:/^[a-zA-ZšđžčćŠĐŽČĆ]+$/|max:255',
            'last_name' => 'required|regex:/^[a-zA-ZšđžčćŠĐŽČĆ]+$/|max:255',

            'email' => 'required|email|unique:users',
            'password' => [
                'required',
                'string',
                'min:8',
                Password::min(8)
                    ->mixedCase()  
                    ->numbers()    
                    ->symbols(),  
            ],
            'confirm-password' => 'required|string|min:8|same:password',
            'phone_number' => ['nullable', 'string', 'max:15', 'regex:/^(06[0-9]{7,8}|\+3816[0-9]{7,8})$/'],
            'role_id' => 'required|exists:roles,id',
        ], [
            'first_name.required' => 'Ime je obavezno.',
            'first_name.regex' => 'Ime mora biti sastavljeno od samo slova.',
            'last_name.required' => 'Prezime je obavezno.',
            'last_name.regex' => 'Prezime mora biti sastavljeno od samo slova.',
            'email.required' => 'Email je obavezan.',
            'email.email' => 'Unesite validan email.',
            'email.unique' => 'Email je već registrovan.',
            'password.required' => 'Lozinka je obavezna.',
            'password.min' => 'Lozinka mora imati najmanje 8 karaktera.',
            'password.mixed' => 'Lozinka mora sadržati i velika i mala slova.',
            'password.numbers' => 'Lozinka mora sadržati brojeve.',
            'password.symbols' => 'Lozinka mora sadržati specijalne karaktere.',
            'confirm-password.required' => 'Potvrda lozinke je obavezna.',
            'confirm-password.min' => 'Potvrđena lozinka mora imati najmanje 8 karaktera.',
            'confirm-password.same' => 'Lozinka i potvrđena lozinka se ne poklapaju.',
            'phone_number.regex' => 'Broj telefona mora biti validan srpski broj (format: 06xxxxxxxx ili +381xxxxxxxx).',
            'role_id.required' => 'Uloga je obavezna.',
            'role_id.exists' => 'Izabrana uloga ne postoji.',
        ]);

        // Šifrovanje lozinke
        $formData['password'] = bcrypt($formData['password']);

        // Kreiranje korisnika
        if (User::create($formData)) {
            return redirect('/admin')->with('success', 'Korisnik je uspešno kreiran.');
        }

        return redirect('/admin')->with('error', 'Korisnik nije uspešno kreiran.');
    }
}
