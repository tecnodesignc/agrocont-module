<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'lands'], function (Router $router) {
    $router->bind('lands', function ($id) {
        return app('Modules\Agrocont\Repositories\LandsRepository')->find($id);
    });
    $router->get('/', [
        'as' => 'agrocont.lands.index',
        'uses' => 'LandsController@index',
        'middleware' => 'can:agrocont.lands.index'
    ]);
    $router->get('create', [
        'as' => 'agrocont.lands.create',
        'uses' => 'LandsController@create',
        'middleware' => 'can:agrocont.lands.create'
    ]);
    $router->post('lands', [
        'as' => 'agrocont.lands.store',
        'uses' => 'LandsController@store',
        'middleware' => 'can:agrocont.lands.create'
    ]);
    $router->get('{lands}/edit', [
        'as' => 'agrocont.lands.edit',
        'uses' => 'LandsController@edit',
        'middleware' => 'can:agrocont.lands.edit'
    ]);
    $router->put('{lands}', [
        'as' => 'agrocont.lands.update',
        'uses' => 'LandsController@update',
        'middleware' => 'can:agrocont.lands.edit'
    ]);
    $router->delete('{lands}', [
        'as' => 'agrocont.lands.destroy',
        'uses' => 'LandsController@destroy',
        'middleware' => 'can:agrocont.lands.destroy'
    ]);
    $router->get('select', [
        'as' => 'agrocont.lands.select',
        'uses' => 'LandsController@view',
        'middleware' => 'can:agrocont.lands.index'
    ]);
    $router->post('select', [
        'as' => 'agrocont.lands.userLand',
        'uses' => 'LandsController@select',
        'middleware' => 'can:agrocont.lands.index'
    ]);
});
$router->group(['prefix' =>'lots'], function (Router $router) {
    $router->bind('lots', function ($id) {
        return app('Modules\Agrocont\Repositories\LotsRepository')->find($id);
    });
    $router->get('/', [
        'as' => 'agrocont.lots.index',
        'uses' => 'LotsController@index',
        'middleware' => 'can:agrocont.lots.index'
    ]);
    $router->get('create', [
        'as' => 'agrocont.lots.create',
        'uses' => 'LotsController@create',
        'middleware' => 'can:agrocont.lots.create'
    ]);
    $router->post('lots', [
        'as' => 'agrocont.lots.store',
        'uses' => 'LotsController@store',
        'middleware' => 'can:agrocont.lots.create'
    ]);
    $router->get('{lots}/edit', [
        'as' => 'agrocont.lots.edit',
        'uses' => 'LotsController@edit',
        'middleware' => 'can:agrocont.lots.edit'
    ]);
    $router->put('{lots}', [
        'as' => 'agrocont.lots.update',
        'uses' => 'LotsController@update',
        'middleware' => 'can:agrocont.lots.edit'
    ]);
    $router->delete('{lots}', [
        'as' => 'agrocont.lots.destroy',
        'uses' => 'LotsController@destroy',
        'middleware' => 'can:agrocont.lots.destroy'
    ]);
});
$router->group(['prefix' =>'/crops'], function (Router $router) {
    $router->bind('crops', function ($id) {
        return app('Modules\Agrocont\Repositories\CropsRepository')->find($id);
    });
    $router->get('/', [
        'as' => 'agrocont.crops.index',
        'uses' => 'CropsController@index',
        'middleware' => 'can:agrocont.crops.index'
    ]);
    $router->get('create', [
        'as' => 'agrocont.crops.create',
        'uses' => 'CropsController@create',
        'middleware' => 'can:agrocont.crops.create'
    ]);
    $router->post('crops', [
        'as' => 'agrocont.crops.store',
        'uses' => 'CropsController@store',
        'middleware' => 'can:agrocont.crops.create'
    ]);
    $router->get('{crops}/edit', [
        'as' => 'agrocont.crops.edit',
        'uses' => 'CropsController@edit',
        'middleware' => 'can:agrocont.crops.edit'
    ]);
    $router->put('{crops}', [
        'as' => 'agrocont.crops.update',
        'uses' => 'CropsController@update',
        'middleware' => 'can:agrocont.crops.edit'
    ]);
    $router->delete('{crops}', [
        'as' => 'agrocont.crops.destroy',
        'uses' => 'CropsController@destroy',
        'middleware' => 'can:agrocont.crops.destroy'
    ]);
});
$router->group(['prefix' =>'/activities'], function (Router $router) {
    $router->bind('activities', function ($id) {
        return app('Modules\Agrocont\Repositories\ActivitiesRepository')->find($id);
    });
    $router->get('/', [
        'as' => 'agrocont.activities.index',
        'uses' => 'ActivitiesController@index',
        'middleware' => 'can:agrocont.activities.index'
    ]);
    $router->get('create', [
        'as' => 'agrocont.activities.create',
        'uses' => 'ActivitiesController@create',
        'middleware' => 'can:agrocont.activities.create'
    ]);
    $router->post('activities', [
        'as' => 'agrocont.activities.store',
        'uses' => 'ActivitiesController@store',
        'middleware' => 'can:agrocont.activities.create'
    ]);
    $router->get('{activities}/edit', [
        'as' => 'agrocont.activities.edit',
        'uses' => 'ActivitiesController@edit',
        'middleware' => 'can:agrocont.activities.edit'
    ]);
    $router->put('activities/{activities}', [
        'as' => 'agrocont.activities.update',
        'uses' => 'ActivitiesController@update',
        'middleware' => 'can:agrocont.activities.edit'
    ]);
    $router->delete('{activities}', [
        'as' => 'agrocont.activities.destroy',
        'uses' => 'ActivitiesController@destroy',
        'middleware' => 'can:agrocont.activities.destroy'
    ]);
});

$router->group(['prefix' =>'/products'], function (Router $router) {
    $router->bind('products', function ($id) {
        return app('Modules\Agrocont\Repositories\ProductsRepository')->find($id);
    });
    $router->get('/', [
        'as' => 'agrocont.products.index',
        'uses' => 'ProductsController@index',
        'middleware' => 'can:agrocont.products.index'
    ]);
    $router->get('create', [
        'as' => 'agrocont.products.create',
        'uses' => 'ProductsController@create',
        'middleware' => 'can:agrocont.products.create'
    ]);
    $router->post('products', [
        'as' => 'agrocont.products.store',
        'uses' => 'ProductsController@store',
        'middleware' => 'can:agrocont.products.create'
    ]);
    $router->get('{products}/edit', [
        'as' => 'agrocont.products.edit',
        'uses' => 'ProductsController@edit',
        'middleware' => 'can:agrocont.products.edit'
    ]);
    $router->put('{products}', [
        'as' => 'agrocont.products.update',
        'uses' => 'ProductsController@update',
        'middleware' => 'can:agrocont.products.edit'
    ]);
    $router->delete('{products}', [
        'as' => 'agrocont.products.destroy',
        'uses' => 'ProductsController@destroy',
        'middleware' => 'can:agrocont.products.destroy'
    ]);
});
// append

