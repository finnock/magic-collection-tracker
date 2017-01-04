<?php


namespace App\Http\Controllers;

use App\Card;
use Illuminate\Http\Request;

class CardController extends Controller
{
    public function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //dd($card);
        $card = Card::find($id);
        return view('cards.show')->with(['card' => $card]);

    }
}
