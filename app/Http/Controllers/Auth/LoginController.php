<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Tracker;

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
//    protected $redirectTo = '/home';
//
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
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        $credentials =  $request->only($this->username(), 'password');

        $credentials['status'] = 1;
        $credentials['role'] = 'admin';

        return $credentials;
    }

    protected function redirectTo()
    {
        $user = Auth::user();
        if (!is_null($user)):
            //dd($user->role);



            //dd($ip_add);
            $tracker = new Tracker();
            $tracker->track('Signed in');


            switch ($user->role):
                case 'admin':
                    $redirectTo = '/admin';
                    break;
                default:
                    $redirectTo = '/admin';
            endswitch;

        endif;

        return $redirectTo;

    }
}
