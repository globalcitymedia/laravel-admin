<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactAudit extends BaseModel
{
    protected $fillable = ['desc','contact_id'];

    public function contact()
    {
        return $this->belongsTo('App\Contact', 'contact_id');
    }

}
