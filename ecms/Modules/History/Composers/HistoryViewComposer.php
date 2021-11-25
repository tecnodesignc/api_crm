<?php

namespace Modules\History\Composers;

use Illuminate\Contracts\View\View;
use Modules\History\Repositories\HistoryRepository;
use Modules\User\Contracts\Authentication;

class HistoryViewComposer
{
    /**
     * @var HistoryRepository
     */
    private $history;
    /**
     * @var Authentication
     */
    private $auth;

    public function __construct(HistoryRepository $history, Authentication $auth)
    {
        $this->history = $history;
        $this->auth = $auth;
    }

    public function compose(View $view)
    {
        $histories = $this->history->latestForUser($this->auth->id());
        $view->with('histories', $histories);
    }
}
