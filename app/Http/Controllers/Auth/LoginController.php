<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
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
    protected function redirectTo()
    {
        $user = Auth::user();
        if (!is_null($user)):
            //dd($user->role);
            //$tracker = new Tracker();
            $ip_add = $_SERVER['REMOTE_ADDR'];

            //dd($ip_add);

            //$tracker->track($ip_add);


            switch ($user->role):
                case 'admin':
                    $redirectTo = '/admin';
                    break;
                case 'member':
                    $redirectTo = '/member';
                    break;
                default:
                    $redirectTo = '/admin';
            endswitch;

        endif;

        return $redirectTo;

    }
}
