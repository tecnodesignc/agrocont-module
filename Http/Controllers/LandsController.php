<?php

namespace Modules\Agrocont\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Agrocont\Entities\Lands;
use Modules\Agrocont\Http\Requests\CreateLandsRequest;
use Modules\Agrocont\Http\Requests\UpdateLandsRequest;
use Modules\Agrocont\Repositories\LandsRepository;
use Modules\Core\Http\Controllers\BasePublicController;

class LandsController extends BasePublicController
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
        $lands = $this->lands->all();
        $tpl = 'agrocont::front.lands.index';
        $ttpl='lands.index';
        view()->exists($ttpl)?$tpl=$ttpl:$tpl;
        return view($tpl, compact('lands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $tpl = 'agrocont::front.lands.create';
        $ttpl='lands.create';
        view()->exists($ttpl)?$tpl=$ttpl:$tpl;
        return view($tpl);
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

        return redirect()->route('agrocont.lands.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('agrocont::lands.title.lands')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Lands $land
     * @return Response
     */
    public function edit(Lands $land)
    {
        $tpl = 'agrocont::front.lands.edit';
        $ttpl='lands.edit';
        view()->exists($ttpl)?$tpl=$ttpl:$tpl;
        return view($tpl, compact('land'));
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

        return redirect()->route('agrocont.lands.index')
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

        return redirect()->route('agrocont.lands.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('agrocont::lands.title.lands')]));
    }
}
