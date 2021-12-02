<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/projects'], function (Router $router) {
    $router->bind('project', function ($id) {
        return app('Modules\Projects\Repositories\ProjectRepository')->find($id);
    });
    $router->get('projects', [
        'as' => 'admin.projects.project.index',
        'uses' => 'ProjectController@index',
        'middleware' => 'can:projects.projects.index'
    ]);
    $router->get('projects/create', [
        'as' => 'admin.projects.project.create',
        'uses' => 'ProjectController@create',
        'middleware' => 'can:projects.projects.create'
    ]);
    $router->post('projects', [
        'as' => 'admin.projects.project.store',
        'uses' => 'ProjectController@store',
        'middleware' => 'can:projects.projects.create'
    ]);
    $router->get('projects/{project}/edit', [
        'as' => 'admin.projects.project.edit',
        'uses' => 'ProjectController@edit',
        'middleware' => 'can:projects.projects.edit'
    ]);
    $router->put('projects/{project}', [
        'as' => 'admin.projects.project.update',
        'uses' => 'ProjectController@update',
        'middleware' => 'can:projects.projects.edit'
    ]);
    $router->delete('projects/{project}', [
        'as' => 'admin.projects.project.destroy',
        'uses' => 'ProjectController@destroy',
        'middleware' => 'can:projects.projects.destroy'
    ]);
    $router->bind('object', function ($id) {
        return app('Modules\Projects\Repositories\ObjectRepository')->find($id);
    });
    $router->get('objects', [
        'as' => 'admin.projects.object.index',
        'uses' => 'ObjectController@index',
        'middleware' => 'can:projects.objects.index'
    ]);
    $router->get('objects/create', [
        'as' => 'admin.projects.object.create',
        'uses' => 'ObjectController@create',
        'middleware' => 'can:projects.objects.create'
    ]);
    $router->post('objects', [
        'as' => 'admin.projects.object.store',
        'uses' => 'ObjectController@store',
        'middleware' => 'can:projects.objects.create'
    ]);
    $router->get('objects/{object}/edit', [
        'as' => 'admin.projects.object.edit',
        'uses' => 'ObjectController@edit',
        'middleware' => 'can:projects.objects.edit'
    ]);
    $router->put('objects/{object}', [
        'as' => 'admin.projects.object.update',
        'uses' => 'ObjectController@update',
        'middleware' => 'can:projects.objects.edit'
    ]);
    $router->delete('objects/{object}', [
        'as' => 'admin.projects.object.destroy',
        'uses' => 'ObjectController@destroy',
        'middleware' => 'can:projects.objects.destroy'
    ]);
    $router->bind('activity', function ($id) {
        return app('Modules\Projects\Repositories\ActivityRepository')->find($id);
    });
    $router->get('activities', [
        'as' => 'admin.projects.activity.index',
        'uses' => 'ActivityController@index',
        'middleware' => 'can:projects.activities.index'
    ]);
    $router->get('activities/create', [
        'as' => 'admin.projects.activity.create',
        'uses' => 'ActivityController@create',
        'middleware' => 'can:projects.activities.create'
    ]);
    $router->post('activities', [
        'as' => 'admin.projects.activity.store',
        'uses' => 'ActivityController@store',
        'middleware' => 'can:projects.activities.create'
    ]);
    $router->get('activities/{activity}/edit', [
        'as' => 'admin.projects.activity.edit',
        'uses' => 'ActivityController@edit',
        'middleware' => 'can:projects.activities.edit'
    ]);
    $router->put('activities/{activity}', [
        'as' => 'admin.projects.activity.update',
        'uses' => 'ActivityController@update',
        'middleware' => 'can:projects.activities.edit'
    ]);
    $router->delete('activities/{activity}', [
        'as' => 'admin.projects.activity.destroy',
        'uses' => 'ActivityController@destroy',
        'middleware' => 'can:projects.activities.destroy'
    ]);
    $router->bind('task', function ($id) {
        return app('Modules\Projects\Repositories\TaskRepository')->find($id);
    });
    $router->get('tasks', [
        'as' => 'admin.projects.task.index',
        'uses' => 'TaskController@index',
        'middleware' => 'can:projects.tasks.index'
    ]);
    $router->get('tasks/create', [
        'as' => 'admin.projects.task.create',
        'uses' => 'TaskController@create',
        'middleware' => 'can:projects.tasks.create'
    ]);
    $router->post('tasks', [
        'as' => 'admin.projects.task.store',
        'uses' => 'TaskController@store',
        'middleware' => 'can:projects.tasks.create'
    ]);
    $router->get('tasks/{task}/edit', [
        'as' => 'admin.projects.task.edit',
        'uses' => 'TaskController@edit',
        'middleware' => 'can:projects.tasks.edit'
    ]);
    $router->put('tasks/{task}', [
        'as' => 'admin.projects.task.update',
        'uses' => 'TaskController@update',
        'middleware' => 'can:projects.tasks.edit'
    ]);
    $router->delete('tasks/{task}', [
        'as' => 'admin.projects.task.destroy',
        'uses' => 'TaskController@destroy',
        'middleware' => 'can:projects.tasks.destroy'
    ]);
// append




});
