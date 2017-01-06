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
        <table class="table table-striped">
            <thead>
            <tr>
                <th></th>
                <th></th>
                <th>Rarity</th>
                <th>Number</th>
                <th>Name</th>
                <th>Type</th>
                <th>Cost</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($cards as $card)
                <tr>
                    <td>{{ $card->pivot->count }}</td>
                    <td><img width="50" src="{{ $card->imagePath() }}"></td>
                    <td>
                        @include('components.raritySymbol', ['setCode' => $card->setCode, 'rarity' => $card->rarity, 'options' => 'ss-2x ss-fw'])
                    </td>
                    <td>{{ $card->number }}</td>
                    <td>{{ $card->name }}</td>
                    <td>{{ $card->type }}</td>
                    <td>
                        @include('components.costSymbols', ['cost' => $card->manaCost, 'options' => 'ms-cost ms-shadow'])
                    </td>
                    <td>
                        <a class="btn btn-small btn-default" href="/Card/{{ $card->getAttributes()['id'] }}">
                            <i class="glyphicon glyphicon-folder-open"></i>
                            &nbsp;Show Card
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
    <script>
        $( document ).ready(function() {
            $("#number").focus();
        });
    </script>
@endsection