<?php

use Illuminate\Routing\Router;

/** @var Router $router */
$router->post('history/mark-read', ['as' => 'api.history.read', 'uses' => 'HistoriesApiController@markAsRead']);


$router->group(['prefix' =>'history/v1/histories'], function (Router $router) {
//Route create

    $router->post('/readAll', [
        'as' => 'api.history.history.read.all',
        'uses' => 'HistoriesApiController@marksAsRead',
        'middleware' => ['auth:api']
    ]);

    $router->post('/', [
        'as' => 'api.history.history.create',
        'uses' => 'HistoriesApiController@create',
        'middleware' => ['auth:api']
    ]);

    //Route index
    $router->get('/', [
        'as' => 'api.history.history.index',
        'uses' => 'HistoriesApiController@index',
        'middleware' => ['auth:api']
    ]);

    //Route show
    $router->get('/{criteria}', [
        'as' => 'api.history.history.show',
        'uses' => 'HistoriesApiController@show',
        'middleware' => ['auth:api']
    ]);

    //Route update
    $router->put('/{criteria}', [
        'as' => 'api.history.history.edit',
        'uses' => 'HistoriesApiController@update',
        'middleware' => ['auth:api']
    ]);

    //Route delete
    $router->delete('/{criteria}', [
        'as' => 'api.history.history.destroy',
        'uses' => 'HistoriesApiController@delete',
        'middleware' => ['auth:api']
    ]);
});
