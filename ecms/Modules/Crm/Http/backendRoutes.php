<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/crm'], function (Router $router) {
    $router->bind('account', function ($id) {
        return app('Modules\Crm\Repositories\AccountRepository')->find($id);
    });
    $router->get('accounts', [
        'as' => 'admin.crm.account.index',
        'uses' => 'AccountController@index',
        'middleware' => 'can:crm.accounts.index'
    ]);
    $router->get('accounts/create', [
        'as' => 'admin.crm.account.create',
        'uses' => 'AccountController@create',
        'middleware' => 'can:crm.accounts.create'
    ]);
    $router->post('accounts', [
        'as' => 'admin.crm.account.store',
        'uses' => 'AccountController@store',
        'middleware' => 'can:crm.accounts.create'
    ]);
    $router->get('accounts/{account}/edit', [
        'as' => 'admin.crm.account.edit',
        'uses' => 'AccountController@edit',
        'middleware' => 'can:crm.accounts.edit'
    ]);
    $router->put('accounts/{account}', [
        'as' => 'admin.crm.account.update',
        'uses' => 'AccountController@update',
        'middleware' => 'can:crm.accounts.edit'
    ]);
    $router->delete('accounts/{account}', [
        'as' => 'admin.crm.account.destroy',
        'uses' => 'AccountController@destroy',
        'middleware' => 'can:crm.accounts.destroy'
    ]);
    $router->bind('contact', function ($id) {
        return app('Modules\Crm\Repositories\ContactRepository')->find($id);
    });
    $router->get('contacts', [
        'as' => 'admin.crm.contact.index',
        'uses' => 'ContactController@index',
        'middleware' => 'can:crm.contacts.index'
    ]);
    $router->get('contacts/create', [
        'as' => 'admin.crm.contact.create',
        'uses' => 'ContactController@create',
        'middleware' => 'can:crm.contacts.create'
    ]);
    $router->post('contacts', [
        'as' => 'admin.crm.contact.store',
        'uses' => 'ContactController@store',
        'middleware' => 'can:crm.contacts.create'
    ]);
    $router->get('contacts/{contact}/edit', [
        'as' => 'admin.crm.contact.edit',
        'uses' => 'ContactController@edit',
        'middleware' => 'can:crm.contacts.edit'
    ]);
    $router->put('contacts/{contact}', [
        'as' => 'admin.crm.contact.update',
        'uses' => 'ContactController@update',
        'middleware' => 'can:crm.contacts.edit'
    ]);
    $router->delete('contacts/{contact}', [
        'as' => 'admin.crm.contact.destroy',
        'uses' => 'ContactController@destroy',
        'middleware' => 'can:crm.contacts.destroy'
    ]);
    $router->bind('lead', function ($id) {
        return app('Modules\Crm\Repositories\LeadRepository')->find($id);
    });
    $router->get('leads', [
        'as' => 'admin.crm.lead.index',
        'uses' => 'LeadController@index',
        'middleware' => 'can:crm.leads.index'
    ]);
    $router->get('leads/create', [
        'as' => 'admin.crm.lead.create',
        'uses' => 'LeadController@create',
        'middleware' => 'can:crm.leads.create'
    ]);
    $router->post('leads', [
        'as' => 'admin.crm.lead.store',
        'uses' => 'LeadController@store',
        'middleware' => 'can:crm.leads.create'
    ]);
    $router->get('leads/{lead}/edit', [
        'as' => 'admin.crm.lead.edit',
        'uses' => 'LeadController@edit',
        'middleware' => 'can:crm.leads.edit'
    ]);
    $router->put('leads/{lead}', [
        'as' => 'admin.crm.lead.update',
        'uses' => 'LeadController@update',
        'middleware' => 'can:crm.leads.edit'
    ]);
    $router->delete('leads/{lead}', [
        'as' => 'admin.crm.lead.destroy',
        'uses' => 'LeadController@destroy',
        'middleware' => 'can:crm.leads.destroy'
    ]);
    $router->bind('activity', function ($id) {
        return app('Modules\Crm\Repositories\ActivityRepository')->find($id);
    });
    $router->get('activities', [
        'as' => 'admin.crm.activity.index',
        'uses' => 'ActivityController@index',
        'middleware' => 'can:crm.activities.index'
    ]);
    $router->get('activities/create', [
        'as' => 'admin.crm.activity.create',
        'uses' => 'ActivityController@create',
        'middleware' => 'can:crm.activities.create'
    ]);
    $router->post('activities', [
        'as' => 'admin.crm.activity.store',
        'uses' => 'ActivityController@store',
        'middleware' => 'can:crm.activities.create'
    ]);
    $router->get('activities/{activity}/edit', [
        'as' => 'admin.crm.activity.edit',
        'uses' => 'ActivityController@edit',
        'middleware' => 'can:crm.activities.edit'
    ]);
    $router->put('activities/{activity}', [
        'as' => 'admin.crm.activity.update',
        'uses' => 'ActivityController@update',
        'middleware' => 'can:crm.activities.edit'
    ]);
    $router->delete('activities/{activity}', [
        'as' => 'admin.crm.activity.destroy',
        'uses' => 'ActivityController@destroy',
        'middleware' => 'can:crm.activities.destroy'
    ]);
// append




});
