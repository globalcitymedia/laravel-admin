<?php

namespace App;

use App\BaseModel;

class ContactList extends BaseModel
{
    protected $fillable = ['name','status'];


    public function contacts()
    {
        return $this->belongsToMany('App\Contact','contact_list_contact','contact_id','contact_list_id');
    }
}
