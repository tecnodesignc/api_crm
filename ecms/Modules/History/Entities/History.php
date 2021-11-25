<?php

namespace Modules\History\Entities;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Modules\History\Presenters\HistoryPresenter;

/**
 * @property string type
 * @property string message
 * @property string ip
 * @property string title
 * @property string log
 * @property string lat
 * @property \Carbon\Carbon created_at
 * @property \Carbon\Carbon updated_at
 * @property int user_id
 * @property int account_id
 */
class History extends Model
{
    use PresentableTrait;

    protected $table = 'history__histories';
    protected $fillable = ['user_id', 'type', 'message', 'ip', 'lng', 'lat', 'title','account_id'];
    protected $appends = ['time_ago'];
    protected $casts = [];



    protected $presenter = HistoryPresenter::class;


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        $driver = config('encore.user.config.driver');

        return $this->belongsTo("Modules\\User\\Entities\\{$driver}\\User");
    }

    /**
     * Return the created time in difference for humans (2 min ago)
     * @return string
     */
    public function getTimeAgoAttribute()
    {
        return $this->created_at->diffForHumans();
    }
}
