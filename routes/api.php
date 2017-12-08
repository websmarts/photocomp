<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();

// });

// These routes return a JSend response
Route::post('/process', 'EntriesController@process')->name('process');
Route::post('/upload', 'EntriesController@uploader')->name('uploader');
Route::post('/submit', 'EntriesController@submit');
