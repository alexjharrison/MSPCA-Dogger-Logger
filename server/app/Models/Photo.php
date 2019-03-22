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
    // protected $fillable = [
    //     'filepath', 'dog_id'
    // ];

    protected $casts = [
        'dog_id' => 'integer',
    ];

    public function dog()
    {
        return $this->hasOne(Dog::class);
    }

    public function addDog(Dog $dog)
    {
        return $this->dog()->attach($dog->id);
    }

    public function removeDog(Dog $dog)
    {
        return $this->dog()->detach($dog->id);
    }
}
