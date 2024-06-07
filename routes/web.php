<?php

use Illuminate\Support\Facades\Route;

$router->get('/', function () use ($router) {
  return view('citySearch');
});

$router->get('/weathersearch', function () use ($router) {
  return view('weatherSearch');
});

$router->get('/timesearch', function () use ($router) {
  return view('timeSearch');
});

$router->get('/currencysearch', function () use ($router) {
  return view('currencySearch');
});

$router->group(['middleware' => 'client.credentials'], function() use ($router){

    //API ROUTES
    $router->get('/citysearch', 'CitySearchController@search');
    $router->get('/weather', 'WeatherSearchController@searchWeather');
    $router->get('/time', 'TimeSearchController@getTime');
    $router->get('/currency', 'getCurrencyController@getCurrency');

    //Tempo Application SignIn
    $router->get('/signinusers', 'SignInController@index');
    $router->post('/signinusers', 'SignInController@add'); // create new user
    $router->get('/signinusers/{uid}', 'SignInController@show'); // get user by id
    $router->put('/signinusers/{uid}', 'SignInController@update'); // update user
    $router->patch('/signinusers/{uid}', 'SignInController@update'); // update user
    $router->delete('/signinusers/{uid}', 'SignInController@delete'); // delete user

    //Tempo Application Signup
    $router->get('/signupusers', 'SignUpController@index');
    $router->get('/signupusers/{uid}', 'SignUpController@show');
    $router->post('/signupusers', 'SignUpController@add'); // create new user
    $router->get('/signupusers/{uid}', 'SignUpController@show'); // get user by id
    $router->put('/signupusers/{uid}', 'SignUpController@update'); // update user
    $router->patch('/signupusers/{uid}', 'SignUpController@update'); // update user
    $router->delete('/signupusers/{uid}', 'SignUpController@delete'); // delete user

    //History Log
    $router->get('/historylogs', 'HistoryLogController@index');
    $router->get('/historylogs/{id}', 'HistoryLogController@show');
});

/*
$router->group([], function() use ($router){
    //API ROUTES
    $router->get('/citysearch', 'CitySearchController@search');
    $router->get('/weather', 'WeatherSearchController@searchWeather');
    $router->get('/time', 'TimeSearchController@getTime');
    $router->get('/currency', 'getCurrencyController@getCurrency');

    //Tempo Application SignIn
    $router->get('/signinusers', 'SignInController@index');
    $router->get('/signinusers/{uid}', 'SignInController@show');

    //Tempo Application Signup
    $router->get('/signupusers', 'SignUpController@index');
    $router->get('/signupusers/{uid}', 'SignUpController@show');
});*/