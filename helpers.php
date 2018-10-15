<?php


use Modules\Agrocont\Entities\Crops;
use Modules\Agrocont\Entities\Land;
use Modules\Agrocont\Entities\Lot;
use Modules\Agrocont\Entities\Products;
use Illuminate\Support\Facades\Cache;


function countProdutcs(){
    $product= new Products() ;

    return $product->count();
}

function countLots(){
    $lost= new Lot();
    return $lost->count();
}

function countLands(){
    $expiresAt = now()->addMinutes(10);

    $value = Cache::remember('lands', $expiresAt, function () {
        $lands= new Land();
        return  $lands->take(1)->count();
    });

    return $value;

}
function countCrops(){
    $crops= new Crops();
    return  $crops->count();
}