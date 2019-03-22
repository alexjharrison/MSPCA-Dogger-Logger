<?php

namespace App\Models;

use App\Models\Photo;
use App\Models\Walk;
use Illuminate\Database\Eloquent\Model;

class Dog extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'age', 'weight', 'breed', 'photo_id'
    ];

    protected $casts = [
        'age' => 'integer',
        'weight' => 'integer',
        'photo_id' => 'integer'
    ];


    public function walks()
    {
        return $this->belongsToMany(Walk::class);
    }

    public function photo() {
        return $this->hasOne(Photo::class);
    }

}
