<?php

namespace App;

use App\BaseModel;

class CarModel extends BaseModel
{
    /**
     * The primary column associated with the table
     *
     * @var string
     */
    protected $guarded = ['id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function carMark()
    {
        return $this->belongsTo(CarMark::class, 'id_car_mark');
    }

    public function searchableAs()
    {
        return 'id_car_model';
    }
}
