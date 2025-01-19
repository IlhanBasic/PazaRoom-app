<?php

namespace App\Http\Controllers;

use App\Models\Contact_Message;
use App\Models\Role;
use App\Models\User;
use App\Models\Review;
use App\Models\Property;
use App\Models\PropertyTags;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if ($user==null || $user->role_id !== 3) {
            return redirect('/')->with('error', 'Nemate pristup ovoj stranici.');
        }
        $users = User::all();
        $properties = Property::all();
        $propertyTags = PropertyTags::all();
        $reviews = Review::all();
        $roles = Role::all();
        $messages = Contact_Message::all();
        return view('admin.dashboard',['users' => $users, 'properties' => $properties, 'propertyTags' => $propertyTags, 'reviews' => $reviews,'roles' => $roles,'messages' => $messages]);
    }
}
