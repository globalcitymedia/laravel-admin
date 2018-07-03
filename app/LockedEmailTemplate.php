<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LockedEmailTemplate extends EmailTemplate
{
    protected $fillable = ['name','subject','email_body','from_address','display_name','status','email_templates_id'];
}
