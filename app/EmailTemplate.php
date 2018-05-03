<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends BaseModel
{
    protected $fillable = ['name','subject','email_body','from_address','display_name','status'];

    protected $dates = [
        'deleted_at'
    ];

    public function name(){
        return $this->name;
    }
}
