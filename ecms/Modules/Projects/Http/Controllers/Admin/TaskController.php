<?php

namespace Modules\Projects\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Projects\Entities\Task;
use Modules\Projects\Http\Requests\CreateTaskRequest;
use Modules\Projects\Http\Requests\UpdateTaskRequest;
use Modules\Projects\Repositories\TaskRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class TaskController extends AdminBaseController
{
    /**
     * @var TaskRepository
     */
    private $task;

    public function __construct(TaskRepository $task)
    {
        parent::__construct();

        $this->task = $task;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$tasks = $this->task->all();

        return view('projects::admin.tasks.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('projects::admin.tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateTaskRequest $request
     * @return Response
     */
    public function store(CreateTaskRequest $request)
    {
        $this->task->create($request->all());

        return redirect()->route('admin.projects.task.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('projects::tasks.title.tasks')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Task $task
     * @return Response
     */
    public function edit(Task $task)
    {
        return view('projects::admin.tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Task $task
     * @param  UpdateTaskRequest $request
     * @return Response
     */
    public function update(Task $task, UpdateTaskRequest $request)
    {
        $this->task->update($task, $request->all());

        return redirect()->route('admin.projects.task.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('projects::tasks.title.tasks')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Task $task
     * @return Response
     */
    public function destroy(Task $task)
    {
        $this->task->destroy($task);

        return redirect()->route('admin.projects.task.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('projects::tasks.title.tasks')]));
    }
}
