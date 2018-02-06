<?php

namespace App;

use App\BaseModel;

class ImageGallery extends BaseModel
{
    protected $table = 'image_gallery';
    protected $fillable = ['title','image'];
}