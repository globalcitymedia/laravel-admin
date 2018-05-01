<?php

namespace App;


use App\Notifications\VerifyEmail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Notifications\Notifiable;

class Contact extends BaseModel
{

    use Notifiable;

    protected $fillable = ['first_name','last_name','email','status','email_verified','verification_key','renewal_date'];

    protected $dates = [
        'renewal_date',
        'deleted_at'
    ];
    /**
     * @return array
     */
    public function name()
    {
        return $this->first_name. ' ' . $this->last_name;
    }


    public function audit()
    {
        return $this->hasMany('App\ContactAudit');
    }

    //set<fieldname>Attribute mutator
    public function setRenewalDateAttribute($date)
    {
        $date = date_create($date);
        $this->attributes['renewal_date'] = $date;
        //$date = Carbon::create($date);
        //$this->attributes['published_at'] = Carbon::create('Y-m-d H:i',$date);
        //$this->attributes['published_at'] = Carbon::parse($date);
    }

    public function signup(Contact $contact)
    {
        $this->saveOrFail($contact->toArray());
        $this->createAudit($contact->id, "New contact registered ".$contact->email);

        $this->sendVerificationEmail($contact);
        //dd($contact);
        return $contact->id;
    }

    public function sendVerificationEmail(Contact $contact)
    {
        $contact->notify(new VerifyEmail($contact));
        $this->createAudit($contact->id, "Verification email sent to ".$contact->email);
    }

    public function verified()
    {
        return $this->verification_key === null && $this->email_verified === 'yes';
    }

    public function verifiedString()
    {
        return ($this->verified() === true)?"Verified":"Not verified";
    }


    public function contactLists()
    {
        return $this->belongsToMany('App\ContactList','contact_list_contact','contact_id')->withTimestamps();
    }


}
