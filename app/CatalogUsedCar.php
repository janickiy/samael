<?php

namespace App;

use App\BaseModel;

class CatalogUsedCar extends BaseModel
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];
    protected $dates = ['published_at'];

    protected $casts = [
        'image' => 'array',
    ];

    /**
     * @param $query
     * @return mixed
     */
    public function scopePublished($query)
    {
        return $query->where('published', 1);
    }
}