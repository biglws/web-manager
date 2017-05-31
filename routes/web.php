<?php

/** @var \Illuminate\Routing\Router $router */

$router->get('/', function () {
    return view('index');
});

$router->get('/beacons', function () {
    return view('beacons');
})->name('beacons');

$router->get('/locations', function () {
    return view('locations');
})->name('locations');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
