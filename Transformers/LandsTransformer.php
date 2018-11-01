<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 15/10/2018
 * Time: 3:40 PM
 */

namespace Modules\Agrocont\Transformers;

use Illuminate\Http\Resources\Json\Resource;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Modules\User\Transformers\UserTransformer;


class LandsTransformer extends Resource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->name,
            'status' => $this->status,
            'address' => $this->address,
            'type' => $this->type,
            'created_at' => $this->created_at,
            "users"=>UserTransformer::collection($this->users)
        ];
    }
}