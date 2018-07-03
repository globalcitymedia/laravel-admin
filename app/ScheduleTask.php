<?php

namespace App;
use Carbon\Carbon;
use DateTime;

class ScheduleTask extends BaseModel
{
    protected $fillable = ['email_template_id', 'scheduled_at', 'sent_at', 'status','locked_email_template_id'];

    protected $dates = [
        'deleted_at', 'scheduled_at', 'sent_at'
    ];

    public function contactLists()
    {
        return $this->belongsToMany('App\ContactList', 'contact_list_schdule_task', 'schedule_task_id')->withTimestamps();
    }

    public function template()
    {
        //return "---hello";
        return $this->belongsTo('App\LockedEmailTemplate', 'locked_email_template_id');
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

    public function getSentAt()
    {
        return ($this->sent_at != null) ? Carbon::parse($this->sent_at)->format('Y-m-d H:i') : null;
    }

    public function getStatus()
    {
        return config('variables.scheduled_task_status')[(is_null($this->status)) ? 0 : $this->status];
    }

    public function routeNotificationForMail($notification)
    {
        return 'elansiva@hotmail.com';
    }

    public function scopeDispatchable($query)
    {
        //scheduled_at
        //sent_at
        //status
        $date = new DateTime(null, new \DateTimeZone('Europe/London'));
        $current_datetime = date_format($date, 'Y-m-d H:i:00');
        $query->where([['scheduled_at','<', $current_datetime],['sent_at','=', null],['status','=', 1]]);
        //$query->where([['sent_at', '=', null], ['status', '=', 1]]);
    }

}
