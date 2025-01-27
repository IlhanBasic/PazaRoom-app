<?php

namespace App\Http\Controllers;

use App\Models\Contact_Message;
use App\Models\Message;
use Illuminate\Http\Request;

class Contact_MessagesController extends Controller
{
    public function contact()
    {
        $user = auth()->user();
        if ($user && $user->role_id === 3) {
            return redirect('/')->with('error', 'Nemate pristup ovoj stranici.');
        }
        return view('contact.contact');
    }
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

    public function show(string $id)
    {
        if (auth()->check() && auth()->user()->role_id == 3) {
            $message = Contact_Message::find($id);
            if($message == null) {
                return view('errors.404');
            }
            return view('contact.show', compact('message'));
        }
        return redirect('/')->with('error', 'Nemate pristup ovoj stranici.');
    }
    public function destroy(string $id)
    {
        if(!auth()->check() || auth()->user()->role_id != 3) {
            return redirect('/')->with('error', 'Nemate pristup ovoj stranici.');
        }
        $message = Contact_Message::find($id);
        if($message == null) {
            return view('errors.404');
        }
        $message->delete();
        return redirect()->route('admin')->with([
            'success' => 'Poruka je uspešno obrisana.',
        ]);
    }
}
