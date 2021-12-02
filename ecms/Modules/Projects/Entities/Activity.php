<?php

namespace Modules\Projects\Entities;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use Translatable;

    protected $table = 'projects__activities';
    public $translatedAttributes = [];
    protected $fillable = [];
}
