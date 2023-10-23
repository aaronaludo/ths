<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackDocument extends Model
{
    use HasFactory;
    
    public function recipients(){
        return $this->hasMany(Recipient::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
