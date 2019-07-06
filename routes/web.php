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

Route::get('giadnt','Frontend\TransactionController@giadonate');
Route::get('/', 'Frontend\UsersController@donate')->name('home');
Route::get('/alert','Frontend\DonateAlerts@index');
Route::post('donateac', 'Frontend\TransactionController@addCard');
Route::get('donate', 'Frontend\UsersController@donate')->name('donate');
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
Route::group(['prefix' => 'auth'], function() {
    Route::get('/redirect/{social}', 'Auth\SocialAuthController@redirect')->name('sociallogin');
    Route::get('/callback/{social}', 'Auth\SocialAuthController@callback');
    Auth::routes();

});


Route::group(['prefix' => 'user' ,'middleware' => 'auth'], function() {
    Route::get('/', 'Frontend\UsersController@index')->name('user');
    Route::post('/{id}', 'Frontend\UsersController@update')->name('updateinfo');
    Route::get('/history', 'Frontend\TransactionController@index')->name('transaciton');
});
