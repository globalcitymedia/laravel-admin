<?php

namespace App;

use App\ContactAudit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BaseModel extends Model
{
    use SoftDeletes;

    //protected $guarded = [];

    protected $dates = ['deleted_at'];

    /**
     * @return array
     */
    public function getStatus()
    {
        return config('variables.status')[(is_null($this->status))?0:$this->status];
    }

    public function createAudit($contact_id, $desc)
    {
        echo "Create Audit trail";
        $audit = new ContactAudit();
        $audit['contact_id'] = $contact_id;
        $audit['desc'] = $desc;
        $audit['ip_address']=$_SERVER['REMOTE_ADDR'];
        $audit->saveOrFail($audit->toArray());
    }
}
