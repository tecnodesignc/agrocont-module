<?php

namespace Modules\Agrocont\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Agrocont\Entities\Lands;
use Modules\Agrocont\Http\Requests\CreateLandsRequest;
use Modules\Agrocont\Http\Requests\UpdateLandsRequest;
use Modules\Agrocont\Repositories\LandsRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class LandsController extends AdminBaseController
{
    /**
     * @var LandsRepository
     */
    private $lands;

    public function __construct(LandsRepository $lands)
    {
        parent::__construct();

        $this->lands = $lands;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$lands = $this->lands->all();

        return view('agrocont::admin.lands.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('agrocont::admin.lands.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateLandsRequest $request
     * @return Response
     */
    public function store(CreateLandsRequest $request)
    {
        $this->lands->create($request->all());

        return redirect()->route('admin.agrocont.lands.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('agrocont::lands.title.lands')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Lands $lands
     * @return Response
     */
    public function edit(Lands $lands)
    {
        return view('agrocont::admin.lands.edit', compact('lands'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Lands $lands
     * @param  UpdateLandsRequest $request
     * @return Response
     */
    public function update(Lands $lands, UpdateLandsRequest $request)
    {
        $this->lands->update($lands, $request->all());

        return redirect()->route('admin.agrocont.lands.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('agrocont::lands.title.lands')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Lands $lands
     * @return Response
     */
    public function destroy(Lands $lands)
    {
        $this->lands->destroy($lands);

        return redirect()->route('admin.agrocont.lands.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('agrocont::lands.title.lands')]));
    }
}
