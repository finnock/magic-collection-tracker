@extends('layouts.content')

@section('content')
    <table class="table table-striped">
        <thead>
        <tr>
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
@endsection