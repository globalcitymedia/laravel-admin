<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScheduleTask extends BaseModel
{
    protected $fillable = ['email_template_id','scheduled_at','sent_at','status'];

    protected $dates = [
        'deleted_at','scheduled_at','sent_at'
    ];

    public function template()
    {
        //return "---hello";
        return $this->belongsTo('App\EmailTemplate', 'email_template_id');
    }

    public function getContactLists(){
        return '---getContactLists';
    }

    //set<fieldname>Attribute mutator
    public function setScheduledAtAttribute($date)
    {
        $date = date_create($date);
        $this->attributes['scheduled_at'] = $date;
        //$date = Carbon::create($date);
        //$this->attributes['published_at'] = Carbon::create('Y-m-d H:i',$date);
        //$this->attributes['published_at'] = Carbon::parse($date);
    }


    //set<fieldname>Attribute mutator
    public function setSentAtAttribute($date)
    {
        $date = date_create($date);
        $this->attributes['sent_at'] = $date;
        //$date = Carbon::create($date);
        //$this->attributes['published_at'] = Carbon::create('Y-m-d H:i',$date);
        //$this->attributes['published_at'] = Carbon::parse($date);
    }

    public function formSentAtAttribute($date)
    {
        return Carbon::parse($date)->format('Y-m-d H:i');
    }

    public function formScheduledAtAttribute($date)
    {
        return Carbon::parse($date)->format('Y-m-d H:i');
    }

    public function getSentAt(){
        return '--sent at';
    }

    public function getStatus()
    {
        return config('variables.scheduled_task_status')[(is_null($this->status))?0:$this->status];
    }
}
