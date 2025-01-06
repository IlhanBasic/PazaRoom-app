<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name'];  // Polje koje može biti masovno dodeljeno
    public function users()
    {
        return $this->hasMany(User::class, 'role_id');
    }
}
