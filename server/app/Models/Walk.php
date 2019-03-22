<?php

namespace App\Models;

use App\User;
use App\Models\Dog;
use Illuminate\Database\Eloquent\Model;

class Walk extends Model
{
    public function walker()
    {
        return $this->hasOne(User::class);
    }

    public function dog()
    {
        return $this->hasOne(Dog::class);
    }
}
