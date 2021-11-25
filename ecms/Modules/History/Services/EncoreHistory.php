<?php

namespace Modules\History\Services;

use Modules\History\Events\BroadcastAllHistory;
use Modules\History\Events\BroadcastCompanyHistory;
use Modules\History\Events\BroadcastHistory;
use Modules\History\Repositories\HistoryRepository;
use Modules\User\Contracts\Authentication;

final class EncoreHistory implements History
{
    /**
     * @var HistoryRepository
     */
    private $history;
    /**
     * @var Authentication
     */
    private $auth;
    /**
     * @var int
     */
    private int $user_id;

    /**
     * @var int
     */
    private int $account_id;


    public function __construct(HistoryRepository $history, Authentication $auth)
    {
        $this->history = $history;
        $this->auth = $auth;
    }

    /**
     * Push a history on the dashboard
     * @param string $title
     * @param string $message
     * @param string|null $lat
     * @param string|null $lng
     * @param string|null $type
     * @param string|null $ip
     */
    public function push(string $title, string $message, string $lat = null, string $lng = null, string $type = null, string $ip = null)
    {
        $history = $this->history->create([
            'user_id' => $this->user_id??null,
            'account_id' => $this->account_id ?? null,
            'lat' => $lat,
            'lng' => $lng,
            'type'=>$type,
            'ip'=>$ip,
            'title' => $title,
            'message' => $message,
        ]);

        if (true === config('encore.history.config.real-time', false)) {
            $this->triggerEventFor($history);
        }
    }

    /**
     * Trigger the broadcast event for the given history
     * @param \Modules\History\Entities\History $history
     */
    private function triggerEventFor(\Modules\History\Entities\History $history)
    {
        \Log::info('evento');
            event(new BroadcastCompanyHistory($history));
    }

    /**
     * Set a user id to set the history to
     * @param int $user_id
     * @return $this
     */
    public function to(int $user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * Set a user id to set the history to
     * @param int|null $account_id
     * @return $this
     */
    public function account(int $account_id=null)
    {
        $this->account_id = $account_id;

        return $this;
    }
}
