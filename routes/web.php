<?php

use Illuminate\Support\Facades\Route;

$router->get('/', function () use ($router) {
  return view('citySearch');
});

/*
$router->group(['middleware' => 'client.credentials'], function() use ($router){

    $router->get('/citysearch', 'GatewayController@citySearch');
    $router->get('/weather', 'GatewayController@getWeather');
    $router->get('/time', 'GatewayController@getTime');
    $router->get('/currency', 'GatewayController@getCurrency');

});*/

$router->group([], function() use ($router){
    $router->get('/citysearch', 'GatewayController@citySearch');
    $router->get('/weather', 'GatewayController@getWeather');
    $router->get('/time', 'GatewayController@getTime');
    $router->get('/currency', 'GatewayController@getCurrency');
});