<?php

namespace App\Http\Controllers;

use App\Models\Dog;
use Illuminate\Http\Request;

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
            'age' => ['string'],
            'weight' => ['integer'],
            'breed' => ['string'],
        ]);

        $dog = new Dog;
        $dog->name = $data['name'];
        $dog->age = $data['age'];
        $dog->weight = $data['weight'];
        $dog->breed = $data['breed'];
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
        ]);
        $dog = Dog::find($data['id']);
        foreach ($data as $key => $value) {
            if($key!='id'){
                $dog->$key = $value;
            }
        }
        $dog->save();
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
        
        Dog::destroy($dogId);
        return Dog::all();
    }
}
