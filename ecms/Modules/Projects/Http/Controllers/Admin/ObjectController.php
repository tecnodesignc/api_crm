<?php

namespace Modules\Projects\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Projects\Entities\Object;
use Modules\Projects\Http\Requests\CreateObjectRequest;
use Modules\Projects\Http\Requests\UpdateObjectRequest;
use Modules\Projects\Repositories\ObjectRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class ObjectController extends AdminBaseController
{
    /**
     * @var ObjectRepository
     */
    private $object;

    public function __construct(ObjectRepository $object)
    {
        parent::__construct();

        $this->object = $object;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$objects = $this->object->all();

        return view('projects::admin.objects.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('projects::admin.objects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateObjectRequest $request
     * @return Response
     */
    public function store(CreateObjectRequest $request)
    {
        $this->object->create($request->all());

        return redirect()->route('admin.projects.object.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('projects::objects.title.objects')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Object $object
     * @return Response
     */
    public function edit(Object $object)
    {
        return view('projects::admin.objects.edit', compact('object'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Object $object
     * @param  UpdateObjectRequest $request
     * @return Response
     */
    public function update(Object $object, UpdateObjectRequest $request)
    {
        $this->object->update($object, $request->all());

        return redirect()->route('admin.projects.object.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('projects::objects.title.objects')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Object $object
     * @return Response
     */
    public function destroy(Object $object)
    {
        $this->object->destroy($object);

        return redirect()->route('admin.projects.object.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('projects::objects.title.objects')]));
    }
}
