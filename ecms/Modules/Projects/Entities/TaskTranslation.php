<?php

namespace Modules\Projects\Entities;

use Illuminate\Database\Eloquent\Model;

class TaskTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [];
    protected $table = 'projects__task_translations';
}
