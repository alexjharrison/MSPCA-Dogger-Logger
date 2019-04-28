<?php

namespace App\Http\Controllers;

use App\Models\Dog;
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
        return Walk::where('dog_id',$dogId)->get();
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
            'dog_id' => ['required','integer'],
            'pooped' => ['required', 'boolean'],
            'peed' => ['required', 'boolean'],
            'medical_concern' => ['required','string'],
            'jumps' => ['required', 'integer'],
            'jump_handlage' => ['required','string'],
            'mouthings' => [ 'required','integer'],
            'mouthings_handlage' => ['required','string'],
            'dogs_seen_reacted' => ['required','integer'],
            'seen_dog_reaction' => [ 'required','string'],
            'dogs_seen' => ['required','integer'],
            'other_concerns' => ['required','string'],
        ]);


        // $data = $request->all();
        $dog = Dog::findOrFail($request->dog_id);
        $walk = new Walk;
        $walk->pooped = $data['pooped'];
        $walk->peed = $data['peed'];
        $walk->medical_concern = $data['medical_concern'];
        $walk->jumps = $data['jumps'];
        $walk->jump_handlage = $data['jump_handlage'];
        $walk->mouthings = $data['mouthings'];
        $walk->mouthings_handlage = $data['mouthings_handlage'];
        $walk->dogs_seen_reacted = $data['dogs_seen_reacted'];
        $walk->dogs_seen = $data['dogs_seen'];
        $walk->seen_dog_reaction = $data['seen_dog_reaction'];
        $walk->other_concerns = $data['other_concerns'];
        
        $walk->save();

        $user = $request->user();
        $user->walks()->save($walk);
        
        $dog->walks()->save($walk);
        
        return Dog::with(['photo', 'walks'])->get();
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
            'dogs_seen_reacted' => ['integer'],
            'seen_dog_reaction' => [ 'integer'],
            'dogs_seen' => ['integer'],
            'other_concerns' => ['string'],
        ]);

        $walk = Walk::findOrFail($request->id);
        foreach ($data as $key => $value) {
            if($key!='id'){
                $walk->$key = $value;
            }
        }
        $walk->save();
        return Dog::with(['photo', 'walks'])->get();
    }
    
}
