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
        return Walk::where('dog_id', $dogId)->get();
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
            'dog_id' => ['required', 'integer'],
            'pooped' => ['required', 'boolean'],
            'peed' => ['required', 'boolean'],
            'jumps' => ['required', 'integer'],
            'mouthings' => ['required', 'integer'],
            'dogs_seen_reacted' => ['required', 'integer'],
            'dogs_seen' => ['required', 'integer'],
        ]);


        // $data = $request->all();
        $dog = Dog::findOrFail($request->dog_id);
        $walk = new Walk;
        $walk->pooped = $request->pooped;
        $walk->peed = $request->peed;
        $walk->medical_concern = $request->medical_concern;
        $walk->jumps = $request->jumps;
        $walk->jump_handlage = $request->jump_handlage;
        $walk->mouthings = $request->mouthings;
        $walk->mouthings_handlage = $request->mouthings_handlage;
        $walk->dogs_seen_reacted = $request->dogs_seen_reacted;
        $walk->dogs_seen = $request->dogs_seen;
        $walk->seen_dog_reaction = $request->seen_dog_reaction;
        $walk->other_concerns = $request->other_concerns;


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
            'id' => ['required', 'integer'],
            'pooped' => ['boolean'],
            'peed' => ['boolean'],
            'medical_concern' => ['string'],
            'jumps' => ['integer'],
            'jump_handlage' => ['string'],
            'mouthings' => ['integer'],
            'mouthings_handlage' => ['string'],
            'dog_reactions' => ['boolean'],
            'dogs_seen_reacted' => ['integer'],
            'seen_dog_reaction' => ['integer'],
            'dogs_seen' => ['integer'],
            'other_concerns' => ['string'],
        ]);

        $walk = Walk::findOrFail($request->id);
        foreach ($data as $key => $value) {
            if ($key != 'id') {
                $walk->$key = $value;
            }
        }
        $walk->save();
        return Dog::with(['photo', 'walks'])->get();
    }
}
