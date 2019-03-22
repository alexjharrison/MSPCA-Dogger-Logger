<?php

namespace App\Models;

use App\Models\Dog;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Walk extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pooped', 'peed', 'medica_concern',
        'jumps', 'jump_handlage', 'mouthings',
        'mouthing_handlage', 'dog_reactions',
        'dog_reaction', 'times_seen_dog',
        'seen_dogs_reaction', 'other_concerns',
        'user_id', 'dog_id'
    ];

    protected $casts = [
        'pooped' => 'boolean',
        'peed' => 'boolean',
        'jumps' => 'integer',
        'mouthings' => 'integer',
        'dog_reactions' => 'integer',
        'times_seen_dog' => 'integer',
        'user_id' => 'integer',
        'dog_id' => 'integer',
    ];
    
    public function walker()
    {
        return $this->hasOne(User::class);
    }

    public function dog()
    {
        return $this->hasOne(Dog::class);
    }
}
