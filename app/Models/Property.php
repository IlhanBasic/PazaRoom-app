<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'address',
        'description',
        'latitude',
        'longitude',
        'owner_id',
        'images',
        'ownership_proof',
        'tags',
        'type',
        'property_type',
        'area',
        'floors',
        'current_floor',
        'heating',
        'rent_price',
        'monthly_utilities',
        'status'
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['tag'] ?? false, function ($query, $tag) {
            return $query->whereRaw("FIND_IN_SET(?, tags)", [$tag]);
        });

        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%')
                ->orWhere('tags', 'like', '%' . $search . '%')
                ->orWhere('address', 'like', '%' . $search . '%');
        });

        $query->when($filters['type'] ?? false, function ($query, $type) {
            return $query->where('type', $type);
        });

        $query->when($filters['rent_price_min'] ?? false, function ($query, $price) {
            return $query->where('rent_price', '>=', $price);
        });

        $query->when($filters['rent_price_max'] ?? false, function ($query, $price) {
            return $query->where('rent_price', '<=', $price);
        });

        $query->when($filters['area_min'] ?? false, function ($query, $area) {
            return $query->where('area', '>=', $area);
        });

        $query->when($filters['area_max'] ?? false, function ($query, $area) {
            return $query->where('area', '<=', $area);
        });

        $query->when($filters['sort'] ?? false, function ($query, $sort) {
            switch ($sort) {
                case 'worst_to_best':
                    return $query->withAvg('reviews', 'rating')->orderBy('reviews_avg_rating', 'asc');
                case 'best_to_worst':
                    return $query->withAvg('reviews', 'rating')->orderBy('reviews_avg_rating', 'desc');
                case 'newest':
                    return $query->orderBy('created_at', 'desc');
                case 'oldest':
                    return $query->orderBy('created_at', 'asc');
                case 'price_low_to_high':
                    return $query->orderBy('rent_price', 'asc');
                case 'price_high_to_low':
                    return $query->orderBy('rent_price', 'desc');
                case 'area_low_to_high':
                    return $query->orderBy('area', 'asc');
                case 'area_high_to_low':
                    return $query->orderBy('area', 'desc');
                case 'type_asc':
                    return $query->orderBy('type', 'asc');
                case 'type_desc':
                    return $query->orderBy('type', 'desc');
                default:
                    return $query;
            }
        });
    }


    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
    // public function reservations()
    // {
    //     return $this->hasMany(Reservation::class);
    // }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function averageRating()
    {
        return $this->reviews()->avg('rating');
    }
    public function reviewsCount()
    {
        return $this->reviews()->count();
    }
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
    public function is_favorite()
    {
        $user = auth()->user();
        if (!$user) {
            return false;
        }
        return $this->favorites()->where('user_id', $user->id)->exists();
    }
}
