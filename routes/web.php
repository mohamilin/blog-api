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
    return 'Selamat Datang di blog api by moh amilin';
});

//generate application key 
// mendapatkan key untuk env

$router->get('/key', function() {
    return \Illuminate\Support\Str::random(32);
});

// route for user : signup and signin
$router->post('/signup', 'AuthController@signup');
$router->post('/signin', 'AuthController@signin');

// route for user with middleware
$router->get('/user/{id}', 'UserController@showUser' );

// route for topic
$router->get('/topic/list', 'TopicController@showTopic');
$router->get('/topic/{topic_id}', 'TopicController@showTopicById');
$router->post('/topic/create', 'TopicController@createTopic');
$router->patch('/topic/update/{topic_id}', 'TopicController@updateTopic');
$router->delete('/topic/delete/{topic_id}', 'TopicController@deleteTopic');

// route for article
$router->get('/article/list', 'ArticleController@showArticle');
$router->get('/article/{article_id}', 'ArticleController@showArticleById');
$router->get('/article-topic/{topic_id}', 'ArticleController@indexArticleByTopic');
$router->post('/article/create', 'ArticleController@createArticle');
$router->patch('/article/update/{article_id}', 'ArticleController@updateArticle');
$router->delete('/article/delete/{article_id}', 'ArticleController@deleteArticle');