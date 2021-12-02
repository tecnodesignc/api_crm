<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/contacts'], function (Router $router) {

    //Route create
    $router->post('/', [
        'as' => 'api.crm.contact.create',
        'uses' => 'ContactApiController@create',
        'middleware' => ['auth:api']
    ]);

    //Route index
    $router->get('/', [
        'as' => 'api.crm.contact.get.items.by',
        'uses' => 'ContactApiController@index',
        'middleware' => ['auth:api']
    ]);

    //Route show
    $router->get('/{criteria}', [
        'as' => 'api.crm.contact.get.item',
        'uses' => 'ContactApiController@show',
        'middleware' => ['auth:api']
    ]);

    //Route update
    $router->put('/{criteria}', [
        'as' => 'api.crm.contact.update',
        'uses' => 'ContactApiController@update',
        'middleware' => ['auth:api']
    ]);

    //Route delete
    $router->delete('/{criteria}', [
        'as' => 'api.crm.contact.delete',
        'uses' => 'ContactApiController@delete',
        'middleware' => ['auth:api']
    ]);

});
