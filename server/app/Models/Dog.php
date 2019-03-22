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
        'name', 'age', 'weight', 'breed'
    ];

    protected $casts = [
        'age' => 'integer',
        'weight' => 'integer',
    ];


    public function walks()
    {
        return $this->belongsToMany(Walk::class);
    }

    public function photo() {
        return $this->belongsTo(Photo::class);
    }

    public function addPhoto(Photo $photo)
    {
        return $this->photo()->attach($photo->id);
    }

    public function removePhoto(Photo $photo)
    {
        return $this->photo()->detach($photo->id);
    }

}
