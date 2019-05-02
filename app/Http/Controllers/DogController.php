<?php

namespace App\Http\Controllers;

use App\Models\Dog;
use App\Models\Photo;
use App\Models\Walk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fetchAll()
    {
        //return Dog::with('photo')->with('walks')->get();
	return Dog::with(['photo', 'walks'])->get();
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
            'gender' => ['string'],
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
        
        $dog->slug = $this->generateSlug($data['name']);

        $dog->save();
        
        return Dog::with(['photo', 'walks'])->get();
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
            'status' => ['string'],
            'gender' => ['string'],
        ]);
        $dog = Dog::findOrFail($data['id']);
        if($request->name != $dog->name) $dog->slug = $this->generateSlug($request->name);
        foreach ($data as $key => $value) {
            if($key!='id'){
                $dog->$key = $value;
            }
        }

        $dog->save();
        if($request->photo_id){
            Photo::find($data['photo_id'])->dog()->save($dog);
        }
        
        return Dog::with(['photo', 'walks'])->get();
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
        return Dog::with(['photo', 'walks'])->get();
    }

    private function generateSlug($name)
    {
        $slugs = Dog::all()->map->slug;
        $incrementer = 1;
        $slug = null;
        if (!$slugs->contains(Str::slug($name))) return Str::slug($name);
        while(!$slug){
            if(!$slugs->contains($name.'-'.$incrementer)){
                $slug = Str::slug($name).'-'.$incrementer;
            }
            $incrementer++;
        }
        return $slug;
    }
}
