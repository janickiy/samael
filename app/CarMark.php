<?php

namespace App;

use App\BaseModel;

class CarMark extends BaseModel
{
    /**
     * The primary column associated with the table
     *
     * @var string
     */
    protected $guarded = ['id'];
    protected $dates = ['published_at'];

}
