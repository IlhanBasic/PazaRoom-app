<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    // Definišite dozvoljena polja za masovno dodeljivanje
    protected $fillable = [
        'category',
        'title',
        'image',
        'excerpt',
        'read_time',
        'file_link',
    ];

    // Dodajte dobijanje vremena u minutama
    protected $casts = [
        'read_time' => 'integer',
    ];
}
