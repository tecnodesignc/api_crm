<?php

namespace Modules\Projects\Entities;

use Illuminate\Database\Eloquent\Model;

class ObjectTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [];
    protected $table = 'projects__object_translations';
}
