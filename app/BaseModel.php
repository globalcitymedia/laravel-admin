<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BaseModel extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $dates = ['deleted_at'];

    /**
     * @return array
     */
    public function getStatus()
    {
        return config('variables.status')[(is_null($this->status))?0:$this->status];
    }
}
