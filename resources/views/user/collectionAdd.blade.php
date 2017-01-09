@extends('layouts.content')

@section('content')
    <div class="row">
        <div class="col-sm-2">
            <h3>Add Card</h3>
            <form action="{{ url('/Collection/Add') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <input type="text" class="form-control" name="setCode" id="code" placeholder="Set Code" value="{{ $request->setCode or '' }}">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="cardNumber" id="number" placeholder="Card Number">
                </div>
                <button type="submit" class="btn btn-default btn-success">Submit</button>
            </form>
        </div>
        @if(isset($card))
            <div class="col-sm-3 pull-right">
                <img style="width: 95%;" src="{{ $card->imagePath() }}">
            </div>
        @endif
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