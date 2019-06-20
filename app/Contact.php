<?php

namespace App;

use App\Notifications\ManagePreference;
use App\Notifications\VerifyEmail;
use Illuminate\Notifications\Notifiable;
use Laravel\Scout\Searchable;

class Contact extends BaseModel
{

    use Notifiable, Searchable;

    protected $fillable = ['first_name', 'last_name', 'email', 'company','work_type', 'job_title', 'country', 'status', 'email_verified', 'verification_key', 'renewal_date'];

    protected $dates = [
        'renewal_date',
        'deleted_at'
    ];


    /**
     * @return array
     */
    public function name()
    {
        return $this->first_name . ' ' . $this->last_name;
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

    public function signupOnImport(Contact $contact)
    {
        //dd($contact);
        $this->saveOrFail($contact->toArray());
        $this->createAudit($contact->id, "New contact registered " . $contact->email);
        //dd($contact);
        //$this->sendVerificationEmail($contact);

        return $contact->id;
    }

    public function signup(Contact $contact)
    {
        //dd($contact);
        $this->saveOrFail($contact->toArray());
        $this->createAudit($contact->id, "New contact registered " . $contact->email);
        //dd($contact);
        $this->sendVerificationEmail($contact);

        return $contact->id;
    }

    public function sendVerificationEmail(Contact $contact)
    {
        $contact->notify(new VerifyEmail($contact));
        $this->email_verified = 'email sent';
        $this->save();
        $this->createAudit($contact->id, "Verification email sent to " . $contact->email);
    }

    public function sendManagePreferenceEmail(Contact $contact)
    {
        $contact->notify(new ManagePreference($contact));
        $this->createAudit($contact->id, "We would like to stay in touch - email sent to " . $contact->email);
    }

    public function verified()
    {
        return $this->email_verified === 'verified';
    }

    public function verifiedString()
    {
        return ($this->verified() === true) ? "Verified" : "Not verified";
    }


    public function contactLists()
    {
        return $this->belongsToMany('App\ContactList', 'contact_list_contact', 'contact_id')->withTimestamps();
    }

    public function routeNotificationForMail($notification)
    {
        //return 'elansiva@hotmail.com';
        //$email_to = 'elansiva@hotmail.com';
        if (env('APP_ENV') == 'local'):
            return env('TEST_EMAIL');
        endif;
        return $this->email;
    }


}
