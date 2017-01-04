@extends('layouts.content')

@section('content')
    <div class="row" style="margin: 40px 0;">
        <div class="col-sm-2">
        </div>
        <div class="col-sm-4">
            <img style="width: 95%;" src="/img/cards/{{ $card->setCode }}/{{ $card->imageName }}.jpg">
        </div>
        <div class="col-sm-4">
            <div class="row">
                <div class="col-sm-12" style="margin-bottom: 10px;"">
                    <h3 style="display: inline;">{{ $card->name }}</h3>
                    <div class="pull-right">
                        @include('components.costSymbols', ['cost' => $card->manaCost, 'options' => 'ms-cost ms-shadow'])
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    {{ $card->type }}
                </div>
            </div>
            <div class="row" style="margin-top: 20px;">
                <div class="col-sm-12 well">
                    <p>{{ $card->text }}</p>
                    <p><i>{{ $card->flavor }}</i></p>
                </div>
            </div>
            <div class="row" style="margin-top: 20px;">
                <div class="col-sm-12 well">
                    <p>{{ $card->text }}</p>
                    <p><i>{{ $card->flavor }}</i></p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    @include('components.raritySymbol', ['setCode' => $card->setCode, 'rarity' => $card->rarity, 'options' => 'ss-2x ss-fw']) - {{ $card->numberNumeric }}
                </div>
            </div>
        </div>
        <div class="col-sm-2">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            {{ var_dump($card->getAttributes()) }}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            {{ var_dump($card->meta()) }}
        </div>
    </div>

@endsection