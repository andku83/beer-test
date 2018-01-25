<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('pages.home');
});

Route::resources([
    'beer' => 'BeerController',
    'beer_type' => 'BeerTypeController',
    'brand' => 'BrandController'
]);
Route::get('/beer/{id}/toggle', 'BeerController@toggle');
Route::get('/brand/{id}/toggle', 'BrandController@toggle');
