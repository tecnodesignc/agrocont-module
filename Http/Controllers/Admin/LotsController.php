<?php

namespace Modules\Agrocont\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Agrocont\Entities\Lots;
use Modules\Agrocont\Http\Requests\CreateLotsRequest;
use Modules\Agrocont\Http\Requests\UpdateLotsRequest;
use Modules\Agrocont\Repositories\LotsRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class LotsController extends AdminBaseController
{
    /**
     * @var LotsRepository
     */
    private $lots;

    public function __construct(LotsRepository $lots)
    {
        parent::__construct();

        $this->lots = $lots;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$lots = $this->lots->all();

        return view('agrocont::admin.lots.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('agrocont::admin.lots.create');
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
