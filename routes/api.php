<?php

/** @var \Illuminate\Routing\Router $router */

//use Illuminate\Http\Request;
//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

$router->get('beacons', 'BeaconController@index')->name('beacon.all');
$router->post('beacon', 'BeaconController@store')->name('beacon.store');
$router->get('beacon/{id}', 'BeaconController@show')->name('beacon.show');
$router->put('beacon/{id}', 'BeaconController@update')->name('beacon.update');
$router->delete('beacon/{id}', 'BeaconController@destroy')->name('beacon.destroy');

$router->get('locations', 'LocationController@index')->name('location.all');
$router->post('location', 'LocationController@store')->name('location.store');
$router->get('location/{id}', 'LocationController@show')->name('location.show');
$router->put('location/{id}', 'LocationController@update')->name('location.update');
$router->delete('location/{id}', 'LocationController@destroy')->name('location.destroy');

$router->get('boundary_points', 'BoundaryPointController@index')->name('boundary_point.all');
$router->post('boundary_point', 'BoundaryPointController@store')->name('boundary_point.store');
$router->get('boundary_point/{id}', 'BoundaryPointController@show')->name('boundary_point.show');
$router->put('boundary_point/{id}', 'BoundaryPointController@update')->name('boundary_point.update');
$router->delete('boundary_point/{id}', 'BoundaryPointController@destroy')->name('boundary_point.destroy');

$router->get('boundary_segments', 'BoundarySegmentController@index')->name('boundary_segment.all');
$router->post('boundary_segment', 'BoundarySegmentController@store')->name('boundary_segment.store');
$router->get('boundary_segment/{id}', 'BoundarySegmentController@show')->name('boundary_segment.show');
$router->put('boundary_segment/{id}', 'BoundarySegmentController@update')->name('boundary_segment.update');
$router->delete('boundary_segment/{id}', 'BoundarySegmentController@destroy')->name('boundary_segment.destroy');
