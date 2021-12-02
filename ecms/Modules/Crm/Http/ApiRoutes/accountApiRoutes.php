<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/accounts'], function (Router $router) {

    //Route create
    $router->post('/', [
        'as' => 'api.crm.account.create',
        'uses' => 'AccountApiController@create',
        'middleware' => ['auth:api']
    ]);

    //Route index
    $router->get('/', [
        'as' => 'api.crm.account.get.items.by',
        'uses' => 'AccountApiController@index',
        'middleware' => ['auth:api']
    ]);

    //Route show
    $router->get('/{criteria}', [
        'as' => 'api.crm.account.get.item',
        'uses' => 'AccountApiController@show',
        'middleware' => ['auth:api']
    ]);

    //Route update
    $router->put('/{criteria}', [
        'as' => 'api.crm.account.update',
        'uses' => 'AccountApiController@update',
        'middleware' => ['auth:api']
    ]);

    //Route delete
    $router->delete('/{criteria}', [
        'as' => 'api.crm.account.delete',
        'uses' => 'AccountApiController@delete',
        'middleware' => ['auth:api']
    ]);

});
