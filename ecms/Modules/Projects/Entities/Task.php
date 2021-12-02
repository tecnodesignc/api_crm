<?php

namespace Modules\Projects\Entities;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use Translatable;

    protected $table = 'projects__tasks';
    public $translatedAttributes = [];
    protected $fillable = [];
}
