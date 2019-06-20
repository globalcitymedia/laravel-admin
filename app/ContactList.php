<?php

namespace App;

use App\BaseModel;

class ContactList extends BaseModel
{
    protected $fillable = ['name','display_name','status','description','type','website'];

    public function scopeLiveList($query)
    {
        $query->where([['website','!=', 'no_website'],['deleted_at','=', null],['status','=', 1]]);
    }

    public function scopeGlp($query)
    {
        $query->where([['website','=', 'globallegalpost']]);
    }

    public function contacts()
    {
        return $this->belongsToMany('App\Contact','contact_list_contact','contact_list_id')->select(array('contacts.id','contacts.first_name','contacts.last_name','contacts.email','contacts.verification_key','contacts.created_at'));
    }

}
