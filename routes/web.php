<?php

/** @var \Illuminate\Routing\Router $router */
$router->get('/', function () {
    return redirect('beacons');
});

$router->group(['middleware' => 'guest'], function () use ($router) {
    $router->get('/beacons', function () {
        return view('beacons');
    })->name('beacons');

    $router->get('/locations', function () {
        return view('locations');
    })->name('locations');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
