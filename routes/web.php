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

    Route::get('test', function(){
        return view('test');
    });

    Route::get('/Collection/Add', function (){
        $cards = Auth::user()->cards()->orderBy('updated_at', 'desc')->take(5)->get();

        $count = true;
        return view('user.collectionAdd')->with(compact('cards', 'count'));
    });

    Route::post('/Collection/Add', function (Request $request) {
        $cardNumberSplit = explode(',', $request->all()['cardNumber']);

        $card = \App\Card::where('setCode', $request->all()['setCode'])
            ->where('number', $cardNumberSplit[0])
            ->first();

        $addCount = (isset($cardNumberSplit[1])) ? $cardNumberSplit[1] : 1;

        if(Auth::user()->cards()->get()->contains($card->id))
        {
            $count = Auth::user()->cards()->find($card->id)->pivot->count;
            Auth::user()->cards()->updateExistingPivot($card->id, ['count' => $count + $addCount]);
        }else{
            Auth::user()->cards()->attach($card->id, ['count' => $addCount]);
        }

        $cards = Auth::user()->cards()->orderBy('updated_at', 'desc')->take(5)->get();

        return view('user.collectionAdd')->with(compact('card', 'request', 'cards'));
    });

    Route::get('/Collection', function (){
        $cards = Auth::user()->cards()->orderBy('created_at', 'desc')->get();
        $count = true;

        return view('user.collection')->with(compact('cards', 'count'));
    });

    Route::post('/Collection', function (Request $request){
        Auth::user()->cards()->attach($request->all()['cardID']);

        return redirect('/Collection');
    });

    Route::get('/', function () {
        return view('home');
    });
});