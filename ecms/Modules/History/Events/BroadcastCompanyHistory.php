<?php

namespace Modules\History\Events;

use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Modules\History\Entities\History;

class BroadcastCompanyHistory implements ShouldBroadcast, ShouldQueue
{
    use SerializesModels;

    /**
     * @var History
     */
    public $history;

    public function __construct(History $history)
    {
        $this->history = $history;
    }

    public function broadcastAs()
    {
        return 'histories.account.'.$this->history->account_id.'.user.'.$this->history->user_id;
    }

    /**
     * Get the channels the event should broadcast on.
     * @return array
     */
    public function broadcastOn()
    {
        return ['histories'];
    }
}
