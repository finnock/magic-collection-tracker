@extends('layouts.content')

@section('content')
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">Collection of {{ Auth::user()->name }}</div>
                <div class="panel-body">{{ Auth::user()->cards()->count() }} Unique Cards</div>
            </div>
        </div>
        <div class="col-sm-3"></div>
    </div>
@endsection