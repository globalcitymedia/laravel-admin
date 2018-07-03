<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SentItem extends BaseModel
{
    //protected $fillable = ['name','subject','email_body','from_address','display_name','status'];
    protected $guarded = [];

    protected $dates = [
        'deleted_at'
    ];

}