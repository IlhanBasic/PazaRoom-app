<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Property;
use Illuminate\Http\Request;

class ReviewsController extends Controller
{
    public function create(Request $request, $id)
    {
        $user = auth()->user();
        if ($user==null || $user->role_id !== 2) {
            return redirect('/')->with('error', 'Nemate pristup ovoj stranici.');
        }
        $property = Property::with('reviews')->findOrFail($id);
        return view('review.create', ['property' => $property]);
    }    
    public function store(Request $request)
    {
        $user = auth()->user();
        if ($user==null || $user->role_id !== 2) {
            return redirect('/')->with('error', 'Nemate pristup ovoj stranici.');
        }
        $formData = $request->validate([
            'property_id' => 'required|exists:properties,id',
            'student_id' => 'required|exists:users,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);
        $property = Property::findOrFail($formData['property_id']);
        $property->reviews()->create($formData);
        return redirect('/properties')->with('success', 'Uspešno ste dodali recenziju.');
    }
    public function destroy(Request $request, $id)
    {
        $user = auth()->user();
        if ($user == null || ($user->role_id !== 2 && $user->role_id !== 3)) {
            return redirect('/')->with('error', 'Nemate pristup ovoj stranici.');
        }
        
        $review = Review::findOrFail($id);
        $review->delete();
        return redirect('/admin')->with('success', 'Recenzija je uspešno obrisana.');
    }
}
