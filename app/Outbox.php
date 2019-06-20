<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Outbox extends BaseModel
{
    //protected $fillable = ['name','subject','email_body','from_address','display_name','status'];
    protected $guarded = [];

    protected $dates = [
    'deleted_at'
    ];

    protected $table = 'outbox';

    public function name()
    {
        return trim($this->first_name.' '.$this->last_name);
    }

    public function greeting(){
       return (empty($this->name())? 'Sir/Madam':$this->name());
    }

    public function scopeDeleted($query)
    {
        $query->where('deleted_at !=', null);
    }


}


