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

Route::get('/', 'WelcomeController@index');

// Laravels std auth routes
Auth::routes(); // plus a convenience get version for logout
Route::get('logout', 'Auth\LoginController@logout');

// User registration
Route::get('registered', 'Auth\RegisterController@registered')->name('registered');
Route::get('register/confirm/{token}', 'Auth\RegisterController@confirmEmail');

// App admin routes
Route::prefix('admin')->middleware(['auth', 'can:admin'])->group(function () {
    Route::get('dashboard', 'AdminController@index')->name('admin.dashboard');
    Route::get('settings', 'SettingsController@index')->name('admin.settings');
    Route::post('settings', 'SettingsController@update')->name('admin.settings.update');
    Route::get('clubs', 'ClubsController@index')->name('admin.clubs');
    Route::post('clubs', 'ClubsController@update')->name('admin.clubs.update');
    Route::get('applications', 'AdminController@applications')->name('admin.applications');
    Route::get('export/photos', 'ExportPhotosController@export')->name('admin.export.photos');
});

Route::middleware(['auth', 'can:enter'])->group(function () {
    // Display the first application form
    Route::get('/home', 'HomeController@index')->name('home');

// Show and Process the  application form
    Route::get('/application', 'ApplicationController@showRegistrationForm')->name('show_application_form');
    Route::post('/application', 'ApplicationController@processRegistrationForm')->name('process_application_form');

// Show image entry upload form - ajax uplaod handler
    Route::get('/entries', 'EntriesController@index')->name('entries_upload_form');
    Route::post('/process', 'EntriesController@process')->name('process');
    Route::post('/upload', 'EntriesController@uploader')->name('uploader');
    Route::post('/submit', 'EntriesController@submit');

// Checkout
    Route::get('/checkout', 'CheckoutController@index')->name('checkout');
    Route::get('/checkout/using/{method}', 'CheckoutController@using')->name('checkout.using');
// Payment request
    Route::get('/checkout/final/{method}', 'CheckoutController@final')->name('checkout.final');

});

Route::prefix('paypal')->group(function () {
    Route::post('ipn', 'PaypalController@ipn'); // needs CSRF middleware disabled

    Route::get('success', 'PaypalController@success');
    Route::get('cancel', 'PaypalController@cancel');
});
