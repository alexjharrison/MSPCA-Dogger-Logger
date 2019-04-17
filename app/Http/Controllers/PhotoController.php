<?php

namespace App\Http\Controllers;

use App\Models\Dog;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fetchOne(Int $photoId)
    {
        $photo = Photo::findOrFail($photoId);
        return Storage::download($photo->filepath);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'photo' => 'required|max:25000|file|mimes:jpg,jpeg,bmp,png,gif,',
            'dog_id' => 'integer',
        ]);

        //create photo folder if doesnt exist
        if(!is_dir(public_path("photos"))){
            mkdir(public_path("photos"), 0755);
        }
        
        //compress image and convert to png
        // $img = Image::make($request->file('photo'))->resize(null, 250, function($constrain){
        //     $constrain->aspectRatio();
        // })->encode('png');
        $img = Image::make($request->file('photo'))->fit(300)->encode('png');

        $hash = md5($img->__toString());
        $filepath = "photos/{$hash}.png";
        $img->save(public_path($filepath));
        $filepath = "photos/{$hash}.png";

        $dog = Dog::find($request->dog_id);
        if($dog){
            $dogPhoto = $dog->photo;
            if($dogPhoto){
                Storage::delete($dogPhoto->filepath);
            }
        }

        // $filepath = $request->photo->store('photos');
        $photo = new Photo;
        $photo->filepath = $filepath;
        $photo->save();
        if($dog){
            $photo->dog()->save($dog);
        }

        return ['photo' => $photo];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function destroy (Request $request)
    {
        return $this->remove($request->id);
    }
    public function remove(Int $photoId)
    {
        $photo = Photo::findOrFail($photoId);
        Storage::delete($photo->filepath);
        $photo->delete();
        return "true";
    }   
}
