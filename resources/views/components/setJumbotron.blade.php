<div class="jumbotron">
    <div class="row">
        <div class="col-sm-9">
            <h1>{{ $set->name }}</h1>
        </div>
        <div class="col-sm-3">
            @include('components.raritySymbol', ['setCode' => $set->code, 'rarity' => 'white', 'options' => 'ss-10x pull-right'])
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