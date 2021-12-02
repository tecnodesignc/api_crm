<?php

namespace Modules\Projects\Entities;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Object extends Model
{
    use Translatable;

    protected $table = 'projects__objects';
    public $translatedAttributes = [];
    protected $fillable = [];
}
