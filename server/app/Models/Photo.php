<?php

namespace App\Models;

use App\Models\Dog;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    public function dog()
    {
        return $this->hasOne(Dog::class);
    }
}
