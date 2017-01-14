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
        $cards = Auth::user()->cards()->get();
        $cardList = array();

        foreach ($cards as $card){
            $cardItem = new stdClass;
            $cardItem->manaCost = $card->manaCost;
            $cardItem->convertedManaCost = $card->convertedManaCost;
            $cardItem->type = $card->type;
            $cardItem->meta = json_decode($card->meta);
            $cardItem->imageName = $card->imageName;
            $cardItem->name = $card->name;
            $cardItem->power = $card->power;
            $cardItem->rarity = $card->rarity;
            $cardItem->text = $card->text;
            $cardItem->toughness = $card->toughness;
            $cardItem->count = $card->pivot->count;
            $cardItem->imagePath = $card->imagePath();

            $cardItem->cmcSort = ($card->convertedManaCost ?: 0);

            $cardItem->number = $card->numberNumeric;
            $cardItem->code = $card->setCode;



            array_push($cardList, $cardItem);
        }

        return view('test')->with(compact('cardList'));
    });

    Route::get('/home', function () {
        return redirect('/');
    });

    Route::get('/', 'CollectionController@dashboard');

    Route::get('/{url}', function () {
        return redirect('/');
    });
});