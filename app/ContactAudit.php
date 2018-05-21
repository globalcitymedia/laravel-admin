<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactAudit extends Model

{
    protected $fillable = ['desc','contact_id'];

    public function contact()
    {
        return $this->belongsTo('App\Contact', 'contact_id');
    }

    public function createAudit($contact_id, $desc, $by=null)
    {
        //echo "Create Audit trail";
        $audit = new ContactAudit();
        $audit['contact_id'] = $contact_id;
        $audit['desc'] = $desc;
        $audit['ip_address']=$_SERVER['REMOTE_ADDR'];
        $audit['created_by']=$by;
        $audit->saveOrFail($audit->toArray());
    }

}
