<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('/users/register', 'UserController@register');

$router->post('/users/login', 'UserController@login');

$router->post('/users/logout', 'UserController@logout');

$router->get('/users/user/{id}', [
    'uses' => 'UserController@getUser',
    'middleware' => 'client'
]);

$router->group([
    'prefix' => 'universe',
    'middleware' => 'client'
], function () use ($router) {
    $router->post('create', 'UniverseController@createUniverse');

    $router->post('edit', 'UniverseController@editUniverse');

    $router->post('get-all', 'UniverseController@getUniverses');

    $router->post('delete', 'UniverseController@deleteUniverse');
});

$router->group([
    'prefix' => 'series',
    'middleware' => 'client'
], function () use ($router) {
    $router->post('create', 'SeriesController@createSeries');

    $router->post('edit', 'SeriesController@editSeries');

    $router->post('get-all', 'SeriesController@getSeries');

    $router->post('delete', 'SeriesController@deleteSeries');
});
