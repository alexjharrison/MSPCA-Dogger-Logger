<?php

namespace App\Http\Controllers;

use App\Models\Walk;
use Illuminate\Http\Request;

class WalkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fetchAll(Int $dogId)
    {
        return Walk::where('dog_id',$dogId);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'pooped' => ['required', 'boolean'],
            'peed' => ['required', 'boolean'],
            'medical_concern' => ['required','string'],
            'jumps' => ['required', 'integer'],
            'jump_handlage' => ['required','string'],
            'mouthings' => ['required', 'integer'],
            'mouthings_handlage' => ['required','string'],
            'dog_reactions' => ['required', 'boolean'],
            'dog_reaction' => ['required','string'],
            'times_seen_dog' => ['required', 'integer'],
            'seen_dogs_reaction' => ['required','string'],
            'other_concerns' => ['required','string'],
            'dog_id' => ['required', 'integer'],
        ]);

        $walk = new Walk;
        $walk->pooped = $data['pooped'];
        $walk->peed = $data['peed'];
        $walk->medical_concern = $data['medical_concern'];
        $walk->jumps = $data['jumps'];
        $walk->jump_handlage = $data['jump_handlage'];
        $walk->mouthings = $data['mouthings'];
        $walk->mouthings_handlage = $data['mouthings_handlage'];
        $walk->dog_reactions = $data['dog_reactions'];
        $walk->dog_reaction = $data['dog_reaction'];
        $walk->times_seen_dog = $data['times_seen_dog'];
        $walk->seen_dogs_reaction = $data['seen_dogs_reaction'];
        $walk->other_concerns = $data['other_concerns'];
        $walk->user_id = $request->user()->id;
        $walk->dog_id = $data['dog_id'];
        $walk->save();
        
        return $walk;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Walk  $walk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = $request->validate([
            'id' => ['required','integer'],
            'pooped' => [ 'boolean'],
            'peed' => [ 'boolean'],
            'medical_concern' => ['string'],
            'jumps' => [ 'integer'],
            'jump_handlage' => ['string'],
            'mouthings' => [ 'integer'],
            'mouthings_handlage' => ['string'],
            'dog_reactions' => [ 'boolean'],
            'dog_reaction' => ['string'],
            'times_seen_dog' => [ 'integer'],
            'seen_dogs_reaction' => ['string'],
            'other_concerns' => ['string'],
            'dog_id' => [ 'integer'],
        ]);

        $walk = Walk::findOrFail($request->id);
        foreach ($data as $key => $value) {
            if($key!='id'){
                $walk->$key = $value;
            }
        }
        $walk->save();
        return $walk;
    }
    
}
