<?php



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::group(['middleware' => ['web']], function ()
{
    Auth::routes();
});


Route::group(['middleware' => ['web', 'auth']], function ()
{
    Route::resource('Card', 'CardController');
    Route::resource('Set', 'SetController');

    Route::get('test', function(){
        return view('test');
    });

    Route::get('/', function () {
        return view('home');
    });
});