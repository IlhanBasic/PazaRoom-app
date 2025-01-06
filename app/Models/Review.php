<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'property_id',
        'student_id',
        'rating',
        'comment',
    ];

    /**
     * Get the property that this review belongs to.
     */
    public function property()
    {
        return $this->belongsTo(Property::class,'property_id');
    }

    /**
     * Get the student (user) who created this review.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
