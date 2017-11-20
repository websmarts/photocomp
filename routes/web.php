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

Route::get('logout', 'Auth\LoginController@logout');

Route::get('/', function () {
    return view('welcome');
});

// Temp admin controller
Route::get('/admin', function () {
    return view('admin.index');
})->middleware('auth');

Auth::routes();

// Display the first application form
Route::get('/home', 'HomeController@index')->name('home');

// Show and Process the  application form
Route::get('/registration', 'RegistrationController@showRegistrationForm')->name('show_application_form');
Route::post('/registration', 'RegistrationController@processRegistrationForm')->name('process_application_form');

// Show image entry upload form - ajax uplaod handler
Route::get('/entries', 'EntriesController@index')->name('entries_upload_form');
Route::post('/process', 'EntriesController@process')->name('process');
Route::post('/upload', 'EntriesController@uploader')->name('uploader');

Route::get('/test', 'EntriesController@process');

// User registration
Route::get('registered', 'Auth\RegisterController@registered')->name('registered');
Route::get('register/confirm/{token}', 'Auth\RegisterController@confirmEmail');
Route::get('step1', 'ApplicationController@index')->name('step1');
