<?php

namespace App\Models;

use App\Models\Walk;
use App\Models\Photo;
use Illuminate\Database\Eloquent\Model;

class Dog extends Model
{
    public function walks()
    {
        return $this->belongsToMany(Walk::class);
    }

    public function photo() {
        return $this->belongsTo(Photo::class);
    }
}
