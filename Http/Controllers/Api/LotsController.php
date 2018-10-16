<?php

namespace Modules\Agrocont\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Agrocont\Entities\Lot;
use Modules\Agrocont\Http\Requests\CreateLotsRequest;
use Modules\Agrocont\Http\Requests\UpdateLotsRequest;
use Modules\Agrocont\Repositories\LotsRepository;
use Modules\Agrocont\Transformers\LotsTransformer;
use Modules\Agrocont\Http\Controllers\Api\BaseApiController;

class LotsController extends BaseApiController
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

    public function index(Request $request)
    {
        try {
            //Get Parameters from URL.
            $p = $this->parametersUrl(false, false, ["status" => [1]], []);
            //Request to Repository
            $lots = $this->lots->whereFilter($p->page, $p->take, $p->filter, $p->include);
            //Response
            $response = ["data" => LotsTransformer::collection($lots)];
            //If request pagination add meta-page
            $p->page ? $response["meta"] = ["page" => $this->pageTransformer($lots)] : false;
        } catch (\Exception $e) {
            \Log::error($e);
            $status = 500;
            $response = ['errors' => [
                "code" => "501",
                "source" => [
                    "pointer" => url($request->path()),
                ],
                "title" => "Error Query Lot",
                "detail" => $e->getMessage()
            ]
            ];
        }
        return response()->json($response, $status ?? 200);
    }

    public function show(Lot $lot)
    {
        try {

            $response = ["data" => new LotsTransformer($lot)];

            $response["permisison"] = $this->auth->user();

        } catch (\Exception $e) {
            $status = 500;
            $response = ["error" => $e->getMessage()];
        }

        //Return Response
        return response()->json($response, $status ?? 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateLotsRequest $request
     * @return Response
     */
    public function store(CreateLotsRequest $request)
    {
        try {
            $lot = $this->lots->create($request->all());
            $status = 200;
            $response = [
                'susses' => [
                    'code' => '201',
                    "source" => [
                        "pointer" => url($request->path())
                    ],
                    "title" => trans('core::core.messages.resource created', ['name' => trans('agrocont::lots.singular')]),
                    "detail" => [
                        'id' => $lot->id
                    ]
                ]
            ];
        } catch (\Exception $e) {
            \Log::error($e);
            $status = 500;
            $response = ['errors' => [
                "code" => "501",
                "source" => [
                    "pointer" => url($request->path()),
                ],
                "title" => "Error Query Lotss",
                "detail" => $e->getMessage()
            ]
            ];
        }
        return response()->json($response, $status ?? 200);
    }

    public function update(Lot $lot, UpdateLotsRequest $request)
    {
        try {
            if (isset($lot->id) && !empty($lot->id)) {
                $options = (array)$request->options ?? array();
                isset($request->mainimage) ? $options["mainimage"] = saveImage($request['mainimage'], "assets/agrocont/lot/" . $lot->id . ".jpg") : false;
                $request['options'] = json_encode($options);
                $lot = $this->lots->update($lot, $request->all());
                $status = 200;
                $response = [
                    'susses' => [
                        'code' => '201',
                        "source" => [
                            "pointer" => url($request->path())
                        ],
                        "title" => trans('core::core.messages.resource updated', ['name' => trans('agrocont::lots.singular')]),
                        "detail" => [
                            'id' => $lot->id
                        ]
                    ]
                ];
            } else {
                $status = 404;
                $response = ['errors' => [
                    "code" => "404",
                    "source" => [
                        "pointer" => url($request->path()),
                    ],
                    "title" => "Not Found",
                    "detail" => 'Query empty'
                ]
                ];
            }
        } catch (\Exception $e) {
            Log::error($e);
            $status = 500;
            $response = ['errors' => [
                "code" => "501",
                "source" => [
                    "pointer" => url($request->path()),
                ],
                "title" => "Error Query Lot",
                "detail" => $e->getMessage()
            ]
            ];
        }
        return response()->json($response, $status ?? 200);
    }

    public function delete(Lot $lot, Request $request)
    {
        try {
            $this->lots->destroy($lot);
            $status = 200;
            $response = [
                'susses' => [
                    'code' => '201',
                    "title" => trans('core::core.messages.resource deleted', ['name' => trans('agrocont::lots.singular')]),
                    "detail" => [
                        'id' => $lot->id
                    ]
                ]
            ];
        } catch (\Exception $e) {
            Log::error($e);
            $status = 500;
            $response = ['errors' => [
                "code" => "501",
                "source" => [
                    "pointer" => url($request->path()),
                ],
                "title" => "Error Query Lot",
                "detail" => $e->getMessage()
            ]
            ];
        }
        return response()->json($response, $status ?? 200);
    }
}
