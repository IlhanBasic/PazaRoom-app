<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'student_id',
        'property_id',
        'start_date',
        'end_date',
        'status'
    ];
    public function property()
    {
        return $this->belongsTo(Property::class,'property_id');
    }
    public function user(){
        return $this->belongsTo(User::class, 'student_id');
    }
}
