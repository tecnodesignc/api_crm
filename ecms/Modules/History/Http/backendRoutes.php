<?php

use Illuminate\Routing\Router;

/** @var Router $router */
$router->group(['prefix' => '/history'], function (Router $router) {
    $router->get('histories', [
        'as' => 'admin.history.history.index',
        'uses' => 'HistoriesController@index',
        'middleware' => 'can:history.histories.index',
    ]);
    $router->get('histories/markAllAsRead', [
        'as' => 'admin.history.history.markAllAsRead',
        'uses' => 'HistoriesController@markAllAsRead',
        'middleware' => 'can:history.histories.markAllAsRead',
    ]);
    $router->delete('histories/destroyAll', [
        'as' => 'admin.history.history.destroyAll',
        'uses' => 'HistoriesController@destroyAll',
        'middleware' => 'can:history.histories.destroyAll',
    ]);
    $router->delete('histories/{history}', [
        'as' => 'admin.history.history.destroy',
        'uses' => 'HistoriesController@destroy',
        'middleware' => 'can:history.histories.destroy',
    ]);
});
