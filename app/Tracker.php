<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class Tracker extends Model
{
    protected $guarded = ['id'];

    public function track($desc=null)
    {
        $ip_add = $_SERVER['REMOTE_ADDR'];

        $track = new Tracker();

        if (Auth::check()):
            $user = Auth::user();
            $track['user'] = $user->email;
            $track['user_type']= $user->role;
        endif;

        $track['ip_address']= $ip_add;
        $track['desc']= $desc;

        $track->saveOrFail($track->toArray());

        //dd($track);
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
