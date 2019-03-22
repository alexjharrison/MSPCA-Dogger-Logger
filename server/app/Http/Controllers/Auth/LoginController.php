<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Validate request data.
     *
     * @return void
     */
    protected function validator(Request $request)
    {
        return $validatedData = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string', 'min:8'],
        ]);
    }

    /**
     * Login Function.
     *
     * @return void
     */
    public function login(Request $request)
    {
        $token = $this->tokenFromCredentials($request);
        return ['token' => $token];
    }


    private function tokenFromCredentials(Request $request)
    {
        $auth = Auth::guard();

        // get some credentials
        $credentials = $request->only(['email', 'password']);

        if ($auth->attempt($credentials)) {
        return $token = $auth->issue();
        }

        return ['Invalid Credentials'];
    }
}
