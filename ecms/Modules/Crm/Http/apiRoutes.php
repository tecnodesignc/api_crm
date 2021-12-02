<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/crm'], function (Router $router) {

require ('ApiRoutes/accountApiRoutes.php');

});
