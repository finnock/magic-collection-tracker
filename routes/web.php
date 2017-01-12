<?php

use Illuminate\Http\Request;

use App\Card;


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

    Route::get('/Collection', 'CollectionController@index');
    Route::get('/Collection/Add', 'CollectionController@add');
    Route::post('/Collection', 'CollectionController@store');
    Route::patch('/Collection/{id}', 'CollectionController@update');
    Route::delete('/Collection/{id}', 'CollectionController@delete');

    Route::get('test', function(){
        return view('test');
    });

    Route::get('/home', function () {
        return redirect('/');
    });

    Route::get('/', function () {
        return view('home');
    });

    Route::get('/{url}', function () {
        return redirect('/');
    });
});