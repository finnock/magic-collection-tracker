<div class="d-flex flex-wrap justify-content-between" style="width: 100%;">
@foreach($cards as $card)
    <?php
        if(!$card->users->isEmpty())
            $count = $card->users->where('id', Auth::id())->first()->pivot->count;
        else
            $count = 'not collected...';
    ?>
    <div class="card" style="width: 200px; margin: 5px 3px;">
        <img class="card-img-top img-fluid" src="{{ $card->imagePath() }}" alt="Card image of {{ $card->name }}">
        <div class="card-footer text-center">
            <small class="">{{ $count }}</small>
        </div>
    </div>
@endforeach
    @for($i=0; $i < 10; $i++)
        <div style="width: 200px; height: 0;"></div>
    @endfor
</div>