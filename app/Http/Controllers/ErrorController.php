<?php

namespace App\Http\Controllers;

use App\Error;
use Illuminate\Http\Request;

class ErrorController extends Controller
{
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Error::create([
            'message' => $request->error,
            'email' => $request->user()->email,
        ]);
    }
    
}
