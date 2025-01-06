<?php
// app/Http/Middleware/AdminRoleMiddleware.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Role; // Ako koristite model za Role tabelu

class AdminRoleMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Proveriti da li je korisnik ulogovan i da li ima admin rolu
        $user = auth()->user();
        
        // Proverite da li je korisnik admin, pretpostavljam da je admin roleId = 1
        if ($user && $user->roleId === 1) {
            return $next($request); // Dozvoljava pristup
        }

        // Ako korisnik nije admin, preusmerite ga na početnu stranicu ili dajte grešku
        return redirect('/')->with('error', 'Nemate pristup ovoj stranici.');
    }
}
