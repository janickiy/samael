<?php

namespace App;

use App\BaseModel;

class CatalogParameterComplectation extends BaseModel
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];
    protected $table = 'catalog_parameter_complectation';

}