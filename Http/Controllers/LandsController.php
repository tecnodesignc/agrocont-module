<?php

namespace Modules\Agrocont\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Agrocont\Entities\Land;
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
        $user = $this->auth->user();
        $lands = $this->lands->wherebyUser($user->id);
        $tpl = 'agrocont::frontend.lands.index';
        $ttpl = 'lands.index';

        view()->exists($ttpl) ? $tpl = $ttpl : $tpl;
        return view($tpl, compact('lands'));
    }

    public function select(Request $request)
    {
        $user = $this->auth->user();
        $land = $this->lands->find($request->land);
        $usersid=$land->users->pluck('id')->toArray();
        if (3) {
            $request->session()->put('land', $land->id);
        }

        return redirect()->route('homepage');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        $tpl = 'agrocont::frontend.lands.create';
        $ttpl = 'agrocont.frontend.lands.create';
        view()->exists($ttpl) ? $tpl = $ttpl : $tpl;

        $user = $this->auth->user();
        if (session()->has('land')) {
            $value = session()->get('land');
            $land = $this->land->find($value);
            if ($land->user_id == $user->id) {
                return view($tpl);
            } else {
                return view('agrocont::frontend.lands.logcreate');
            }
        } else {
            return view('agrocont::frontend.lands.logcreate');
        }


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateLandsRequest $request
     * @return Response
     */
    public function store(CreateLandsRequest $request)
    {
        $user = $this->auth->user();
        $request['users']=[$user->id];
        $request['status']=1;
        $land = $this->lands->create($request->all());
        if (session()->has('land')) {
            return redirect()->route('agrocont.lands.index')
                ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('agrocont::lands.title.lands')]));
        } else {
            $request->session()->put('land', $land->id);
            return redirect()->route('homepage')
                ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('agrocont::lands.title.lands')]));

        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Land $land
     * @return Response
     */
    public function edit(Land $land)
    {
        $tpl = 'agrocont::front.lands.edit';
        $ttpl = 'lands.edit';
        view()->exists($ttpl) ? $tpl = $ttpl : $tpl;
        return view($tpl, compact('land'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Land $lands
     * @param  UpdateLandsRequest $request
     * @return Response
     */
    public function update(Land $lands, UpdateLandsRequest $request)
    {
        $this->lands->update($lands, $request->all());

        return redirect()->route('agrocont.lands.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('agrocont::lands.title.lands')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Land $lands
     * @return Response
     */
    public function destroy(Land $lands)
    {
        $this->lands->destroy($lands);

        return redirect()->route('agrocont.lands.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('agrocont::lands.title.lands')]));
    }

    public function view()
    {
        $user = $this->auth->user();
        $lands = $this->lands->wherebyUser($user->id);
        $tpl = 'agrocont::frontend.lands.select';
        $ttpl = 'agrocont.frontend.lands.select';
        view()->exists($ttpl) ? $tpl = $ttpl : $tpl;
        return view($tpl, compact('lands'));
    }

}
