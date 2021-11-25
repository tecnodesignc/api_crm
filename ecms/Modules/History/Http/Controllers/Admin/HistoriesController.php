<?php

namespace Modules\History\Http\Controllers\Admin;

use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\History\Entities\History;
use Modules\History\Repositories\HistoryRepository;
use Modules\User\Contracts\Authentication;

class HistoriesController extends AdminBaseController
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
        parent::__construct();

        $this->history = $history;
        $this->auth = $auth;
    }

    public function index()
    {
        $histories = $this->history->allForUser($this->auth->id());

        return view('history::admin.histories.index', compact('histories'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  History $history
     * @return Response
     */
    public function destroy(History $history)
    {
        $this->history->destroy($history);

        return redirect()->route('admin.history.history.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => 'History']));
    }

    public function destroyAll()
    {
        $this->history->deleteAllForUser($this->auth->id());

        return redirect()->route('admin.history.history.index')
            ->withSuccess(trans('history::messages.all histories deleted'));
    }

    public function markAllAsRead()
    {
        $this->history->markAllAsReadForUser($this->auth->id());

        return redirect()->route('admin.history.history.index')
            ->withSuccess(trans('history::messages.all histories marked as read'));
    }
}
