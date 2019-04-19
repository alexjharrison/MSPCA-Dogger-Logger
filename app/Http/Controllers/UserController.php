<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use function GuzzleHttp\Psr7\parse_request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function adminify(Request $request)
    {
        $ids = $request->input('user_ids');
        if($request->user()->role != "admin"){
            return response('User Unauthorized',401);
        }
        foreach ($ids as $key => $id) {
            $user = User::findOrFail($id);
            $user->role = 'admin';
            $user->save();
        }
        return 'success';
    }

    public function fetchAll(Request $request) 
    {
        if($request->user()->role != "admin"){
            return response('User Unauthorized',401);
        }
        return User::all();
    }
}
