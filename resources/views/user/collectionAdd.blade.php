@extends('layouts.content')

@section('content')
    <div class="row" style="margin: 50px 0;">
        <div class="col-sm-9">
            <h3>Add Card</h3>
            <form action="{{ url('/Collection') }}" method="post" class="form">
                {{ csrf_field() }}
                <div class="form-inline row">
                    <input type="text" class="form-control mx-sm-3" name="setCode" id="code" placeholder="Set Code" value="{{ $cards->first()->setCode }}" style="margin: 5px 16px;">
                    <small class="text-muted">
                        Must be a valid SET Code. See <a href="/Sets">Sets</a> page for reference.
                    </small>
                </div>
                <div class="form-inline row" >
                    <input type="text" class="form-control mx-sm-3" name="cardNumber" id="number" placeholder="Card Number" style="margin: 5px 16px;">
                    <small class="text-muted">
                        Provide a card number and optionally a numeral card count, seperated by comma.
                    </small>
                </div>
                <div class="form-inline row">
                    <button type="submit" class="btn btn-default btn-success" style="margin: 5px 16px;"><i class="fa fa-plus"></i>&nbsp;Add Card</button>
                </div>
            </form>
        </div>
        <div class="col-sm-3">
            <img style="width: 95%; margin: 10px;" src="{{ $cards->first()->imagePath() }}">
        </div>
    </div>

    @if(isset($cards))
        @include('components.cards.list')
    @endif

    <script>
        $( document ).ready(function() {
            $("#number").focus();
        });
    </script>
@endsection