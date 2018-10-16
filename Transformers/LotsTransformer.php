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


class LotsTransformer extends Resource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'status'=>$this->status,
            'area'=>$this->area,
            'slope'=>$this->slope,
            'texture'=>$this->texture,
            'thickness'=>$this->thickness,
            'land_id'=>$this->land->name,
            'created_at' => $this->created_at
        ];
    }
}