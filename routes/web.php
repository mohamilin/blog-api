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

//generate application key 
// mendapatkan key untuk env
/*
$router->get('/key', function() {
    return \Illuminate\Support\Str::random(32);
});
*/

// route for user : signup and signin
$router->post('/signup', 'AuthController@signup');
$router->post('/signin', 'AuthController@signin');

// route for user with middleware
$router->get('/user/{id}', 'UserController@showUser' );

// route for topic
$router->get('/topic/list', 'TopicController@showTopic');
$router->post('/topic/create', 'TopicController@createTopic');

// route for article
$router->get('/topic/list', 'TopicController@showTopic');
$router->post('/article/create', 'TopicController@createTopic');