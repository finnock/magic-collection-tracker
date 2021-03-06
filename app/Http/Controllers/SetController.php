<?php

namespace App\Http\Controllers;

use App\Set;
use Illuminate\Http\Request;

class SetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cores = Set::cores();
        $expansions = Set::expansions();

        return view('set.index')->with(compact('cores', 'expansions'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Set  $set
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $set = Set::with('cards.users')->find($id);
        $cards = $set->cards;

        return view('set.show')->with(compact('set', 'cards'));
    }
}
