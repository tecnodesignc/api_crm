<?php

namespace Modules\Crm\Entities;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use Translatable;

    protected $table = 'crm__activities';
    public $translatedAttributes = [];
    protected $fillable = [];
}
