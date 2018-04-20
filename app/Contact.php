<?php

namespace App;


class Contact extends BaseModel
{

    /**
     * @return array
     */
    public function name()
    {
        return $this->first_name. ' ' . $this->last_name;
    }
}
