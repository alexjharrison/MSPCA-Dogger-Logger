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
        'seen_dog_reaction', 'dogs_seen',
        'dogs_seen_reacted', 'other_concerns',
        'user_id', 'dog_id'
    ];

    protected $casts = [
        'pooped' => 'boolean',
        'peed' => 'boolean',
        'jumps' => 'integer',
        'mouthings' => 'integer',
        'dogs_seen_reacted' => 'integer',
        'dogs_seen' => 'integer',
        'user_id' => 'integer',
        'dog_id' => 'integer',
    ];
    
    public function walker()
    {
        return $this->belongsTo(User::class);
    }

    public function dog()
    {
        return $this->belongsTo(Dog::class);
    }
}
