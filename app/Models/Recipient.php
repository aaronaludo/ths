<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipient extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function status(){
        return $this->belongsTo(Status::class);
    }
    public function role(){
        return $this->belongsTo(Role::class);
    }
    public function track_document(){
        return $this->belongsTo(TrackDocument::class);
    }
}
