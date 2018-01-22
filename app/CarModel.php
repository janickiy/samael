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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function carGenerations()
    {
        return $this->hasMany(CarGeneration::class, 'id_car_model');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function carSeries()
    {
        return $this->hasMany(CarSerie::class, 'id_car_model');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function carType()
    {
        return $this->belongsTo(CarType::class, 'id_car_type');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function carModifications()
    {
        return $this->hasMany(CarModification::class, 'id_car_model');
    }

    public function searchableAs()
    {
        return 'id_car_model';
    }
}
