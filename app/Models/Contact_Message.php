<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact_Message extends Model
{
    use HasFactory;
    protected $table = 'contact_messages';
    protected $fillable = ['name','user_id','email', 'subject', 'message'];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault();  
    }   
}
