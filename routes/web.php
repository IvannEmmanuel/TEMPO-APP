<?php

use Illuminate\Support\Facades\Route;

// Route for the root URL (/), returns the citySearch view
$router->get('/', function () use ($router) {
  return view('citySearch');
});


// Route for /weathersearch, returns the weatherSearch view
$router->get('/weathersearch', function () use ($router) {
  return view('weatherSearch');
});

// Route for /timesearch, returns the timeSearch view
$router->get('/timesearch', function () use ($router) {
  return view('timeSearch');
});

// Route for /currencysearch, returns the currencySearch view
$router->get('/currencysearch', function () use ($router) {
  return view('currencySearch');
});

// Grouping API routes under 'client.credentials' middleware for authentication
$router->group(['middleware' => 'client.credentials'], function() use ($router){

    //API ROUTES
    $router->get('/citysearch', 'CitySearchController@search'); // API Endpoint for city search, mapped to CitySearchController's search method
    $router->get('/weather', 'WeatherSearchController@searchWeather'); // API Endpoint for weather search, mapped to WeatherSearchController's searchWeather method
    $router->get('/time', 'TimeSearchController@getTime'); // API Endpoint for time search, mapped to TimeSearchController's getTime method
    $router->get('/currency', 'getCurrencyController@getCurrency'); // API Endpoint for currency conversion, mapped to getCurrencyController's getCurrency method

    //Tempo Application SignIn
    $router->get('/signinusers', 'SignInController@index'); //get all users
    $router->post('/signinusers', 'SignInController@add'); // create new user
    $router->get('/signinusers/{uid}', 'SignInController@show'); // get user by id
    $router->put('/signinusers/{uid}', 'SignInController@update'); // update user
    $router->patch('/signinusers/{uid}', 'SignInController@update'); // update user
    $router->delete('/signinusers/{uid}', 'SignInController@delete'); // delete user

    //Tempo Application Signup
    $router->get('/signupusers', 'SignUpController@index'); //get all users
    $router->get('/signupusers/{uid}', 'SignUpController@show'); // get users by id
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