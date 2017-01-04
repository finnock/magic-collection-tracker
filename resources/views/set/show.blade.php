@extends('layouts.content')

@section('content')
    <div class="jumbotron">
        <div class="row">
            <div class="col-sm-9">
                <h1>{{ $set->name }}</h1>
            </div>
            <div class="col-sm-3">
                @include('components.raritySymbol', ['setCode' => $set->code, 'rarity' => 'common', 'options' => 'ss-10x pull-right'])
            </div>
        </div>
        <div class="row" style="font-size: 1.3em;">
            <div class="col-sm-4">
                <b>Release Date:</b> <i>{{ $set->releaseDate }}</i>
            </div>
            <div class="col-sm-4">
                <b>Block:</b> <i>{{ $set->block }}</i>
            </div>
            <div class="col-sm-4">
                <b>Type:</b> <i>{{ $set->type }}</i>
            </div>
        </div>
    </div>
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
        @foreach($set->cards as $card)
            <tr>
                <td><img width="50" src="/img/cards/{{ $set->code }}/{{ $card->imageName }}.jpg"></td>
                <td>
                    @include('components.raritySymbol', ['setCode' => $set->code, 'rarity' => $card->rarity, 'options' => 'ss-2x ss-fw'])
                </td>
                <td>{{ $card->number }}</td>
                <td>{{ $card->name }}</td>
                <td>{{ $card->type }}</td>
                <td>
                    @include('components.costSymbols', ['cost' => $card->manaCost, 'options' => 'ms-cost ms-shadow'])
                </td>
                <td>
                    <a class="btn btn-small btn-success" href="/Card/{{ $card->getAttributes()['id'] }}">
                        <i class="glyphicon glyphicon-folder-open"></i>
                        &nbsp;Show Card
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection