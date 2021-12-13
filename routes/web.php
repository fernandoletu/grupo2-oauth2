<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->group(['middleware' => 'auth'], function ($router) {
    $router->group(['prefix' => 'course'], function () use ($router) {
        $router->get('getAll', 'CourseController@getAll');
        $router->get('getData', 'CourseController@getData');
        $router->post('create', 'CourseController@postCreate');
        $router->put('update', 'CourseController@putUpdate');
        $router->delete('delete', 'CourseController@deleteDelete');
    });
});
