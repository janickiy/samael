<?php

namespace App;

use App\BaseModel;

class Menu extends BaseModel
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @return string
     */
    public function getStatusAttribute()
    {
        return $this->attributes['status'] ? 'active' : 'inactive';
    }
}
