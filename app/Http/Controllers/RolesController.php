<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RolesController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();
        if ($user==null || $user->role_id !== 3) {
            return redirect('/')->with('error', 'Nemate pristup ovoj stranici.');
        }
        return view('role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        if ($user==null || $user->role_id !== 3) {
            return redirect('/')->with('error', 'Nemate pristup ovoj stranici.');
        }
        $formData = $request->validate([
            'name' => 'required',
        ]);
        $role = new Role();
        $role->name = $formData['name'];
        $role->save();
        return redirect('/admin')->with('success', 'Uloga je uspešno kreirana.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = auth()->user();
        if ($user==null || $user->role_id !== 3) {
            return redirect('/')->with('error', 'Nemate pristup ovoj stranici.');
        }
        $role = Role::findOrFail($id);
        return view('role.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = auth()->user();
        if ($user==null || $user->role_id !== 3) {
            return redirect('/')->with('error', 'Nemate pristup ovoj stranici.');
        }
        $formData = $request->validate([
            'name' => 'required',
        ]);

        $role = Role::findOrFail($id);
        $role->name = $formData['name'];
        $role->save();

        return redirect('/admin')->with('success', 'Uloga je uspešno izmenjena.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = auth()->user();
        if ($user==null || $user->role_id !== 3) {
            return redirect('/')->with('error', 'Nemate pristup ovoj stranici.');
        }
        $role = Role::findOrFail($id);
        $role->delete();
        return redirect('/admin')->with('success', 'Uloga je uspešno obrisana.');
    }
}
