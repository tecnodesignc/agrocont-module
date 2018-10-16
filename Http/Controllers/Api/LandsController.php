<?php

namespace Modules\Agrocont\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Agrocont\Entities\Land;
use Modules\Agrocont\Http\Requests\CreateLandsRequest;
use Modules\Agrocont\Http\Requests\UpdateLandsRequest;
use Modules\Agrocont\Repositories\LandsRepository;
use Modules\Agrocont\Transformers\LandsTransformer;
use Modules\Agrocont\Http\Controllers\Api\BaseApiController;
use Log;

class LandsController extends BaseApiController
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

    public function index(Request $request)
    {
        try {
            //Get Parameters from URL.
            $p = $this->parametersUrl(false, false, ["status" => [1]], []);
            //Request to Repository
            $lands = $this->lands->whereFilter($p->page, $p->take, $p->filter, $p->include);
            //Response
            $response = ["data" => LandsTransformer::collection($lands)];
            //If request pagination add meta-page
            $p->page ? $response["meta"] = ["page" => $this->pageTransformer($lands)] : false;
        } catch (\Exception $e) {
            \Log::error($e);
            $status = 500;
            $response = ['errors' => [
                "code" => "501",
                "source" => [
                    "pointer" => url($request->path()),
                ],
                "title" => "Error Query Land",
                "detail" => $e->getMessage()
            ]
            ];
        }
        return response()->json($response, $status ?? 200);
    }

    public function show(Land $land)
    {
        try {

            $response = ["data" => new LandsTransformer($land)];

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
     * @param  CreateLandsRequest $request
     * @return Response
     */
    public function store(CreateLandsRequest $request)
    {
        try {
            $land = $this->lands->create($request->all());
            $status = 200;
            $response = [
                'susses' => [
                    'code' => '201',
                    "source" => [
                        "pointer" => url($request->path())
                    ],
                    "title" => trans('core::core.messages.resource created', ['name' => trans('agrocont::lands.singular')]),
                    "detail" => [
                        'id' => $land->id
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
                "title" => "Error Query Landss",
                "detail" => $e->getMessage()
            ]
            ];
        }
        return response()->json($response, $status ?? 200);
    }

    public function update(Land $land, UpdateLandsRequest $request)
    {
        try {
            if (isset($land->id) && !empty($land->id)) {
                $options = (array)$request->options ?? array();
                isset($request->mainimage) ? $options["mainimage"] = saveImage($request['mainimage'], "assets/iblog/land/" . $land->id . ".jpg") : false;
                $request['options'] = json_encode($options);
                $land = $this->lands->update($land, $request->all());
                $status = 200;
                $response = [
                    'susses' => [
                        'code' => '201',
                        "source" => [
                            "pointer" => url($request->path())
                        ],
                        "title" => trans('core::core.messages.resource updated', ['name' => trans('iblog::lands.singular')]),
                        "detail" => [
                            'id' => $land->id
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
                "title" => "Error Query Land",
                "detail" => $e->getMessage()
            ]
            ];
        }
        return response()->json($response, $status ?? 200);
    }

    public function delete(Land $land, Request $request)
    {
        try {
            $this->lands->destroy($land);
            $status = 200;
            $response = [
                'susses' => [
                    'code' => '201',
                    "title" => trans('core::core.messages.resource deleted', ['name' => trans('iblog::lands.singular')]),
                    "detail" => [
                        'id' => $land->id
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
                "title" => "Error Query Land",
                "detail" => $e->getMessage()
            ]
            ];
        }
        return response()->json($response, $status ?? 200);
    }
}
