<?php

namespace App\Models;

use App\Models\Dog;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'filepath'
    ];

    public function dog()
    {
        return $this->hasOne(Dog::class);
    }
}
