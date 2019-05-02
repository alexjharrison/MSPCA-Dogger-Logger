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
        'name', 'age', 'weight', 'breed', 'photo_id', 'status', 'slug'
    ];

    protected $casts = [
        'weight' => 'integer',
        'photo_id' => 'integer'
    ];


    public function walks()
    {
        return $this->hasMany(Walk::class);
    }

    public function photo() {
        return $this->belongsTo(Photo::class);
    }

}
