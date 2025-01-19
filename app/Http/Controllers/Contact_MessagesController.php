<?php

namespace App\Http\Controllers;

use App\Models\Contact_Message;
use App\Models\Message;
use Illuminate\Http\Request;

class Contact_MessagesController extends Controller
{
    public function contact()
    {
        return view('contact.contact');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $formData = $request->validate([
            'user_id' => 'nullable',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:50',
            'message' => 'required|string|max:1000',
        ]);

        if (Contact_Message::create($formData)) {
            return redirect()->route('contact')->with([
                'success' => 'Poruka je uspešno poslata. Očekujte odgovor.',
            ]);
        }
        return redirect()->route('contact')->with([
            'error' => 'Poruka nije poslata, proverite da li ste popunili sva polja.',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (auth()->check() && auth()->user()->role_id == 3) {
            $message = Contact_Message::find($id);
            return view('contact.show', compact('message'));
        }
        return redirect('/')->with('error', 'Nemate pristup ovoj stranici.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(!auth()->check() || auth()->user()->role_id != 3) {
            return redirect('/')->with('error', 'Nemate pristup ovoj stranici.');
        }
        $message = Contact_Message::find($id);
        $message->delete();
        return redirect()->route('admin')->with([
            'success' => 'Poruka je uspešno obrisana.',
        ]);
    }
}
