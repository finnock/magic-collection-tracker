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
        $sets = Set::expansionsAndCoreSets();
        return view('set.index')->with('sets', $sets);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Set  $set
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $set = Set::find($id);
        return view('set.show')->with('set', $set);
    }
}
