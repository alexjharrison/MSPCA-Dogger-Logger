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
    public function fetchOne(Int $dogId)
    {
        $dog = Dog::findOrFail($dogId);
        $photo = Photo::findOrFail($dog->photo_id);
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

        $dog = Dog::find('dog_id');
        if($dog){
            $this->destroy($dog->photo_id);
        }

        $filepath = $request->photo->store('photos');
        $photo = new Photo;
        $photo->filepath = $filepath;
        $photo->save();

        //resize image
        // return $filepath;
        // $image = Image::make($filepath)->resize(null, 250, function($constrain){
        //     $constrain->aspectRatio();
        // });
        // $image->save($filepath);

        return ['photo_id' => $photo->id];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Int $photoId)
    {
        $photo = Photo::findOrFail($photoId);
        Storage::delete($photo->filepath);
        $photo->delete();
        return "true";
    }   
}
