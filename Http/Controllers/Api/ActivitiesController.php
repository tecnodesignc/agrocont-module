<?php

namespace Modules\Agrocont\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Agrocont\Entities\Activities;
use Modules\Agrocont\Http\Requests\CreateActivitiesRequest;
use Modules\Agrocont\Http\Requests\UpdateActivitiesRequest;
use Modules\Agrocont\Repositories\ActivitiesRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class ActivitiesController extends AdminBaseController
{
    /**
     * @var ActivitiesRepository
     */
    private $activities;

    public function __construct(ActivitiesRepository $activities)
    {
        parent::__construct();

        $this->activities = $activities;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$activities = $this->activities->all();

        return view('agrocont::admin.activities.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('agrocont::admin.activities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateActivitiesRequest $request
     * @return Response
     */
    public function store(CreateActivitiesRequest $request)
    {
        $this->activities->create($request->all());

        return redirect()->route('admin.agrocont.activities.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('agrocont::activities.title.activities')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Activities $activities
     * @return Response
     */
    public function edit(Activities $activities)
    {
        return view('agrocont::admin.activities.edit', compact('activities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Activities $activities
     * @param  UpdateActivitiesRequest $request
     * @return Response
     */
    public function update(Activities $activities, UpdateActivitiesRequest $request)
    {
        $this->activities->update($activities, $request->all());

        return redirect()->route('admin.agrocont.activities.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('agrocont::activities.title.activities')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Activities $activities
     * @return Response
     */
    public function destroy(Activities $activities)
    {
        $this->activities->destroy($activities);

        return redirect()->route('admin.agrocont.activities.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('agrocont::activities.title.activities')]));
    }
}
