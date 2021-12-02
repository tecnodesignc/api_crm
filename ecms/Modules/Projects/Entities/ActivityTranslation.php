<?php

namespace Modules\Projects\Entities;

use Illuminate\Database\Eloquent\Model;

class ActivityTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [];
    protected $table = 'projects__activity_translations';
}
