<?php

namespace App\Http\Controllers;

use App\Models\Dog;
use App\Models\Photo;
use App\Models\Walk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fetchAll()
    {
        return Dog::all();
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
            'name' => ['required', 'string'],
            'photo_id' => ['integer'],
            'age' => ['string'],
            'weight' => ['integer'],
            'breed' => ['string'],
            'status' => ['string'],
        ]);

        $dog = new Dog;
        foreach ($data as $traitName => $traitValue) {
            $dog->$traitName = $traitValue;
        }
        if($request->photo_id){
            $photo = Photo::find($request->photo_id);
            if($photo){
                $photo->dog()->save($dog);
            }
        }
        $dog->save();
        
        return $dog;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dog  $dog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = $request->validate([
            'id' => ['required', 'integer'],
            'name' => ['string'],
            'age' => ['string'],
            'weight' => ['integer'],
            'breed' => ['string'],
            'photo_id' => ['integer'],
            'status' => ['string']
        ]);
        $dog = Dog::findOrFail($data['id']);
        foreach ($data as $key => $value) {
            if($key!='id'){
                $dog->$key = $value;
            }
        }
        $dog->save();
        if($request->photo_id){
            Photo::find($data['photo_id'])->dog()->save($dog);
        }
        
        return $dog;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dog  $dog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Int $dogId)
    {
        $dog = Dog::findOrFail($dogId);
        $dogPhoto = Photo::find($dog->photo_id);
        if($dogPhoto){
            Storage::delete($dogPhoto->filepath);
        }
        
        Walk::where('dog_id',$dogId)->delete();


        $dogPhoto->delete();
        $dog->delete();
        return Dog::all();
    }
}
