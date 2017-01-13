<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Card;
use \Auth;

class CollectionController extends Controller
{

    public function index()
    {
        $cards = Auth::user()->cards()->orderBy('created_at', 'desc')->get();
        $count = true;

        return view('user.collection')->with(compact('cards', 'count'));
    }


    public function add()
    {
        $cards = Auth::user()->cards()->orderBy('updated_at', 'desc')->take(5)->get();
        $count = true;

        return view('user.collectionAdd')->with(compact('cards', 'count', 'card'));
    }


    public function store(Request $request)
    {
        if(isset($request->all()['cardID']))
            Auth::user()->cards()->attach($request->all()['cardID']);

        if(isset($request->all()['cardNumber']))
        {
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
        }

        return back()->withInput();
    }

    public function update(Request $request, $id)
    {
        $oldCount = Auth::user()->cards()->find($id)->pivot->count;
        Auth::user()->cards()->updateExistingPivot($id, ['count' => ($oldCount + $request->all()['count'])]);

        return back();
    }

    public function delete($id)
    {
        Auth::user()->cards()->detach($id);

        return back();
    }
}
