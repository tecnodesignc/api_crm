<?php

namespace Modules\Crm\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Crm\Entities\Activity;
use Modules\Crm\Http\Requests\CreateActivityRequest;
use Modules\Crm\Http\Requests\UpdateActivityRequest;
use Modules\Crm\Repositories\ActivityRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class ActivityController extends AdminBaseController
{
    /**
     * @var ActivityRepository
     */
    private $activity;

    public function __construct(ActivityRepository $activity)
    {
        parent::__construct();

        $this->activity = $activity;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$activities = $this->activity->all();

        return view('crm::admin.activities.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('crm::admin.activities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateActivityRequest $request
     * @return Response
     */
    public function store(CreateActivityRequest $request)
    {
        $this->activity->create($request->all());

        return redirect()->route('admin.crm.activity.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('crm::activities.title.activities')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Activity $activity
     * @return Response
     */
    public function edit(Activity $activity)
    {
        return view('crm::admin.activities.edit', compact('activity'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Activity $activity
     * @param  UpdateActivityRequest $request
     * @return Response
     */
    public function update(Activity $activity, UpdateActivityRequest $request)
    {
        $this->activity->update($activity, $request->all());

        return redirect()->route('admin.crm.activity.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('crm::activities.title.activities')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Activity $activity
     * @return Response
     */
    public function destroy(Activity $activity)
    {
        $this->activity->destroy($activity);

        return redirect()->route('admin.crm.activity.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('crm::activities.title.activities')]));
    }
}
