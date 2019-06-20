<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //    protected $fillable = [
    //        'first_name','last_name', 'email', 'password',
    //    ];
    // TODO::Uncomment $fillable
        protected $fillable = [
            'first_name', 'last_name', 'email', 'password', 'role', 'status'
        ];
    //TODO::Remove $guarded
//    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //
    protected $dates = ['deleted_at'];


    //scope function
    public function scopeAdminUsers($query)
    {
        $query->where('role', 'admin');
    }

    //scope function
    public function scopeUser($query)
    {
        $query->where('role', 'user');
    }

    //scope function
    public function scopeSubscribers($query)
    {
        $query->where('role', 'subscriber');
    }

    public function isAdmin()
    {
        // The system will not generate activation_code for admin users.
        // Thus it has been included in authorisation code for admin panel
        return ($this->role=='admin')?true:false;
    }

    public function isUser()
    {
        // The system will not generate activation_code for admin users.
        // Thus it has been included in authorisation code for admin panel
        return ($this->role=='user')?true:false;
    }

    public function isSubscriber()
    {
        // The system will not generate activation_code for admin users.
        // Thus it has been included in authorisation code for admin panel
        return ($this->role=='subscriber')?true:false;
    }


    public function name()
    {
        return $this->first_name. ' ' . $this->last_name;
    }


    /**
     * @return array
     */
    public function getUserStatus()
    {
        return config('variables.userstatus')[(is_null($this->status))?0:$this->status];
    }


    //set<fieldname>Attribute mutator
    public function setCreated_ByAttribute()
    {
        //demo($this->attributes['created_by']);
        //$this->attributes['published_at'] = Carbon::createFormFromat('Y-m-d',$date);
        $this->attributes['created_by'] = Auth::user()->id;

    }


    public function tracker(){
        return $this->hasMany('App\Tracker');
    }
}
