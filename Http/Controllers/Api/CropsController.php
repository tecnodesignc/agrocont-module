<?php

namespace Modules\Agrocont\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Agrocont\Entities\Crops;
use Modules\Agrocont\Http\Requests\CreateCropsRequest;
use Modules\Agrocont\Http\Requests\UpdateCropsRequest;
use Modules\Agrocont\Repositories\CropsRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class CropsController extends AdminBaseController
{
    /**
     * @var CropsRepository
     */
    private $crops;

    public function __construct(CropsRepository $crops)
    {
        parent::__construct();

        $this->crops = $crops;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$crops = $this->crops->all();

        return view('agrocont::admin.crops.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('agrocont::admin.crops.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateCropsRequest $request
     * @return Response
     */
    public function store(CreateCropsRequest $request)
    {
        $this->crops->create($request->all());

        return redirect()->route('admin.agrocont.crops.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('agrocont::crops.title.crops')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Crops $crops
     * @return Response
     */
    public function edit(Crops $crops)
    {
        return view('agrocont::admin.crops.edit', compact('crops'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Crops $crops
     * @param  UpdateCropsRequest $request
     * @return Response
     */
    public function update(Crops $crops, UpdateCropsRequest $request)
    {
        $this->crops->update($crops, $request->all());

        return redirect()->route('admin.agrocont.crops.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('agrocont::crops.title.crops')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Crops $crops
     * @return Response
     */
    public function destroy(Crops $crops)
    {
        $this->crops->destroy($crops);

        return redirect()->route('admin.agrocont.crops.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('agrocont::crops.title.crops')]));
    }
}
