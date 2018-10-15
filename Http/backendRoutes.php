<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/agrocont'], function (Router $router) {
    $router->bind('lands', function ($id) {
        return app('Modules\Agrocont\Repositories\LandsRepository')->find($id);
    });
    $router->get('lands', [
        'as' => 'admin.agrocont.lands.index',
        'uses' => 'LandsController@index',
        'middleware' => 'can:agrocont.lands.index'
    ]);
    $router->get('lands/create', [
        'as' => 'admin.agrocont.lands.create',
        'uses' => 'LandsController@create',
        'middleware' => 'can:agrocont.lands.create'
    ]);
    $router->post('lands', [
        'as' => 'admin.agrocont.lands.store',
        'uses' => 'LandsController@store',
        'middleware' => 'can:agrocont.lands.create'
    ]);
    $router->get('lands/{lands}/edit', [
        'as' => 'admin.agrocont.lands.edit',
        'uses' => 'LandsController@edit',
        'middleware' => 'can:agrocont.lands.edit'
    ]);
    $router->put('lands/{lands}', [
        'as' => 'admin.agrocont.lands.update',
        'uses' => 'LandsController@update',
        'middleware' => 'can:agrocont.lands.edit'
    ]);
    $router->delete('lands/{lands}', [
        'as' => 'admin.agrocont.lands.destroy',
        'uses' => 'LandsController@destroy',
        'middleware' => 'can:agrocont.lands.destroy'
    ]);
    $router->bind('lots', function ($id) {
        return app('Modules\Agrocont\Repositories\LotsRepository')->find($id);
    });
    $router->get('lots', [
        'as' => 'admin.agrocont.lots.index',
        'uses' => 'LotsController@index',
        'middleware' => 'can:agrocont.lots.index'
    ]);
    $router->get('lots/create', [
        'as' => 'admin.agrocont.lots.create',
        'uses' => 'LotsController@create',
        'middleware' => 'can:agrocont.lots.create'
    ]);
    $router->post('lots', [
        'as' => 'admin.agrocont.lots.store',
        'uses' => 'LotsController@store',
        'middleware' => 'can:agrocont.lots.create'
    ]);
    $router->get('lots/{lots}/edit', [
        'as' => 'admin.agrocont.lots.edit',
        'uses' => 'LotsController@edit',
        'middleware' => 'can:agrocont.lots.edit'
    ]);
    $router->put('lots/{lots}', [
        'as' => 'admin.agrocont.lots.update',
        'uses' => 'LotsController@update',
        'middleware' => 'can:agrocont.lots.edit'
    ]);
    $router->delete('lots/{lots}', [
        'as' => 'admin.agrocont.lots.destroy',
        'uses' => 'LotsController@destroy',
        'middleware' => 'can:agrocont.lots.destroy'
    ]);
    $router->bind('crops', function ($id) {
        return app('Modules\Agrocont\Repositories\CropsRepository')->find($id);
    });
    $router->get('crops', [
        'as' => 'admin.agrocont.crops.index',
        'uses' => 'CropsController@index',
        'middleware' => 'can:agrocont.crops.index'
    ]);
    $router->get('crops/create', [
        'as' => 'admin.agrocont.crops.create',
        'uses' => 'CropsController@create',
        'middleware' => 'can:agrocont.crops.create'
    ]);
    $router->post('crops', [
        'as' => 'admin.agrocont.crops.store',
        'uses' => 'CropsController@store',
        'middleware' => 'can:agrocont.crops.create'
    ]);
    $router->get('crops/{crops}/edit', [
        'as' => 'admin.agrocont.crops.edit',
        'uses' => 'CropsController@edit',
        'middleware' => 'can:agrocont.crops.edit'
    ]);
    $router->put('crops/{crops}', [
        'as' => 'admin.agrocont.crops.update',
        'uses' => 'CropsController@update',
        'middleware' => 'can:agrocont.crops.edit'
    ]);
    $router->delete('crops/{crops}', [
        'as' => 'admin.agrocont.crops.destroy',
        'uses' => 'CropsController@destroy',
        'middleware' => 'can:agrocont.crops.destroy'
    ]);
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
