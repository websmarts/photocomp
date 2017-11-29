<?php

use Illuminate\Support\Facades\Artisan;

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

// Remove orphan files
Route::get('ro', function () {
    $result = Artisan::call('ro');
});

Route::post('paypal/ipn', 'PaypalController@ipn');

Route::get('export', 'EntriesController@exportPhotos');

Route::get('logout', 'Auth\LoginController@logout');

Route::get('/', function () {
    return view('welcome');
});

// Laravels std auth routes
Auth::routes();

// App admin routes
Route::get('/admin', 'AdminController@index')->name('admin')->middleware('auth');

// Display the first application form
Route::get('/home', 'HomeController@index')->name('home')->middleware(['auth', 'can:enter']);

// Show and Process the  application form
Route::get('/registration', 'RegistrationController@showRegistrationForm')->name('show_application_form');
Route::post('/registration', 'RegistrationController@processRegistrationForm')->name('process_application_form');

// Show image entry upload form - ajax uplaod handler
Route::get('/entries', 'EntriesController@index')->name('entries_upload_form');
Route::post('/process', 'EntriesController@process')->name('process');
Route::post('/upload', 'EntriesController@uploader')->name('uploader');
Route::post('/submit', 'EntriesController@submit');

// Checkout
Route::get('/checkout', 'CheckoutController@index')->name('checkout');

// User registration
Route::get('registered', 'Auth\RegisterController@registered')->name('registered');
Route::get('register/confirm/{token}', 'Auth\RegisterController@confirmEmail');
// Route::get('step1', 'ApplicationController@index')->name('step1');
//
//

// Payment

Route::get('payment', 'PaymentController@index')->name('payment');
