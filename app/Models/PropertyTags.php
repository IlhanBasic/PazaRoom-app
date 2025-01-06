<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PropertyTags extends Model
{
    use HasFactory;
    protected $fillable = [
        'tag'
    ];
    
}
