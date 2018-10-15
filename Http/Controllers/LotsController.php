<?php

namespace Modules\Agrocont\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Agrocont\Entities\Lots;
use Modules\Agrocont\Http\Requests\CreateLotsRequest;
use Modules\Agrocont\Http\Requests\UpdateLotsRequest;
use Modules\Agrocont\Repositories\LandsRepository;
use Modules\Agrocont\Repositories\LotsRepository;
use Modules\User\Contracts\Authentication;
use Modules\Core\Http\Controllers\BasePublicController;

class LotsController extends BasePublicController
{
    /**
     * @var LotsRepository
     */
    private $lots;
    public $auth;
    public $lands;

    public function __construct(LotsRepository $lots, Authentication $auth, LandsRepository $lands)
    {
        parent::__construct();

        $this->lots = $lots;
        $this->auth = $auth;
        $this->lands = $lands;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $lots = $this->lots->all();
        $tpl = 'agrocont::front.lots.index';
        $ttpl = 'lots.index';
        view()->exists($ttpl) ? $tpl = $ttpl : $tpl;
        return view($tpl, compact('lots'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $lands = $this->lands->wherebyUser($this->auth->user()->id);
        $lots =$this->lots->wherebyland($lands->id);
        $tpl = 'agrocont::front.lots.create';
        $ttpl = 'lots.create';
        view()->exists($ttpl) ? $tpl = $ttpl : $tpl;
        return view($tpl,compact('lands','lots'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateLotsRequest $request
     * @return Response
     */
    public function store(CreateLotsRequest $request)
    {
        $this->lots->create($request->all());

        return redirect()->route('admin.agrocont.lots.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('agrocont::lots.title.lots')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Lots $lots
     * @return Response
     */
    public function edit(Lots $lots)
    {
        return view('agrocont::admin.lots.edit', compact('lots'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Lots $lots
     * @param  UpdateLotsRequest $request
     * @return Response
     */
    public function update(Lots $lots, UpdateLotsRequest $request)
    {
        $this->lots->update($lots, $request->all());

        return redirect()->route('admin.agrocont.lots.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('agrocont::lots.title.lots')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Lots $lots
     * @return Response
     */
    public function destroy(Lots $lots)
    {
        $this->lots->destroy($lots);

        return redirect()->route('admin.agrocont.lots.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('agrocont::lots.title.lots')]));
    }
}
