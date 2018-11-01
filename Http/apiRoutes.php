<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/agrocont'], function (Router $router) {
    $router->group(['prefix' =>'/lands'], function (Router $router) {
        $router->bind('alands', function ($id) {
            return app('Modules\Agrocont\Repositories\LandsRepository')->find($id);
        });
        $router->get('/', [
            'as' => 'admin.agrocont.lands.index',
            'uses' => 'LandsController@index',

        ]);
        $router->get('{alands}', [
            'as' => 'admin.agrocont.lands.show',
            'uses' => 'LandsController@show',
            //'middleware' => 'auth:api'
        ]);
        $router->post('/', [
            'as' => 'admin.agrocont.lands.store',
            'uses' => 'LandsController@store',
            //'middleware' => ['auth:api', 'can:agrocont.lands.create']
        ]);

        $router->put('{alands}', [
            'as' => 'admin.agrocont.lands.update',
            'uses' => 'LandsController@update',
            'middleware' => ['auth:api']
        ]);
        $router->delete('{alands}', [
            'as' => 'admin.agrocont.lands.destroy',
            'uses' => 'LandsController@delete',
            //'middleware' => 'auth:api'
        ]);
    });
    $router->group(['prefix' =>'/lots'], function (Router $router) {
        $router->bind('alots', function ($id) {
            return app('Modules\Agrocont\Repositories\LotsRepository')->find($id);
        });
        $router->get('/', [
            'as' => 'admin.agrocont.lots.index',
            'uses' => 'LotsController@index',
            //'middleware' => 'can:agrocont.lots.index'
        ]);
        $router->get('{alots}', [
            'as' => 'admin.agrocont.lots.show',
            'uses' => 'LotsController@show',
           // 'middleware' => 'can:agrocont.lots.index'
        ]);
        $router->post('/', [
            'as' => 'admin.agrocont.lots.store',
            'uses' => 'LotsController@store',
            //'middleware' => 'can:agrocont.lots.create'
        ]);
        $router->put('{alots}', [
            'as' => 'admin.agrocont.lots.update',
            'uses' => 'LotsController@update',
           //'middleware' => 'can:agrocont.lots.edit'
        ]);
        $router->delete('{alots}', [
            'as' => 'admin.agrocont.lots.destroy',
            'uses' => 'LotsController@destroy',
            //'middleware' => 'can:agrocont.lots.destroy'
        ]);
    });
    $router->group(['prefix' =>'/crops'], function (Router $router) {
        $router->bind('acrops', function ($id) {
            return app('Modules\Agrocont\Repositories\CropsRepository')->find($id);
        });
        $router->get('/', [
            'as' => 'admin.agrocont.crops.index',
            'uses' => 'CropsController@index',
            'middleware' => 'can:agrocont.crops.index'
        ]);
        $router->get('create', [
            'as' => 'admin.agrocont.crops.create',
            'uses' => 'CropsController@create',
            'middleware' => 'can:agrocont.crops.create'
        ]);
        $router->post('/', [
            'as' => 'admin.agrocont.crops.store',
            'uses' => 'CropsController@store',
            'middleware' => 'can:agrocont.crops.create'
        ]);
        $router->get('{acrops}/edit', [
            'as' => 'admin.agrocont.crops.edit',
            'uses' => 'CropsController@edit',
            'middleware' => 'can:agrocont.crops.edit'
        ]);
        $router->put('{acrops}', [
            'as' => 'admin.agrocont.crops.update',
            'uses' => 'CropsController@update',
            'middleware' => 'can:agrocont.crops.edit'
        ]);
        $router->delete('{acrops}', [
            'as' => 'admin.agrocont.crops.destroy',
            'uses' => 'CropsController@destroy',
            'middleware' => 'can:agrocont.crops.destroy'
        ]);
    });
    $router->bind('activities', function ($id) {
        return app('Modules\Agrocont\Repositories\ActivitiesRepository')->find($id);
    });
    $router->get('activities', [
        'as' => 'admin.agrocont.activities.index',
        'uses' => 'ActivitiesController@index',
        'middleware' => 'can:agrocont.activities.index'
    ]);
    $router->get('activities/create', [
        'as' => 'admin.agrocont.activities.create',
        'uses' => 'ActivitiesController@create',
        'middleware' => 'can:agrocont.activities.create'
    ]);
    $router->post('activities', [
        'as' => 'admin.agrocont.activities.store',
        'uses' => 'ActivitiesController@store',
        'middleware' => 'can:agrocont.activities.create'
    ]);
    $router->get('activities/{activities}/edit', [
        'as' => 'admin.agrocont.activities.edit',
        'uses' => 'ActivitiesController@edit',
        'middleware' => 'can:agrocont.activities.edit'
    ]);
    $router->put('activities/{activities}', [
        'as' => 'admin.agrocont.activities.update',
        'uses' => 'ActivitiesController@update',
        'middleware' => 'can:agrocont.activities.edit'
    ]);
    $router->delete('activities/{activities}', [
        'as' => 'admin.agrocont.activities.destroy',
        'uses' => 'ActivitiesController@destroy',
        'middleware' => 'can:agrocont.activities.destroy'
    ]);

});
