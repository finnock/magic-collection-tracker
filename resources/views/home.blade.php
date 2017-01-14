@extends('layouts.content')

@section('content')
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">Collection of {{ Auth::user()->name }}</div>
                <div class="panel-body">
                    <p>{{ Auth::user()->cards()->count() }} unique cards</p>
                    <p>{{ $cardCount }} cards in total</p>
                    <p>weighing {{ round(($cardCount * 1.8 / 1000), 2) }} kg in total and stack height of {{ round(($cardCount * 0.305 / 10) , 1) }} cm.</p>
                </div>
            </div>
        </div>
        <div class="col-sm-3"></div>
    </div>
@endsection