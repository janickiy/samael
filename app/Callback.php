<?php

namespace App;

use App\BaseModel;

class Callback extends BaseModel
{
    /**
     * The primary column associated with the table
     *
     * @var string
     */
    protected $guarded = ['id'];
    protected $dates = ['published_at'];

}