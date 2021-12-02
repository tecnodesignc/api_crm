<?php

namespace Modules\Projects\Entities;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use Translatable;

    protected $table = 'projects__projects';
    public $translatedAttributes = [];
    protected $fillable = [];
}
