<div class="d-flex flex-wrap justify-content-between" style="width: 100%;">
    @foreach($cards as $card)
        <?php
        if(!$card->users->isEmpty())
            $count = $card->users->where('id', Auth::id())->first()->pivot->count;
        else
            $count = false;
        ?>
            <div class="mct-card panel panel-default text-center">
                <div class="panel-heading">
                    @for($i = 0; $i < $count; $i++)
                        <i class="fa fa-circle"></i>
                    @endfor
                    @if($count == 0)
                        <span>&nbsp;</span>
                    @endif
                </div>
                <div class="panel-body">
                    <img class="mct-image {{ (!$count) ? 'fade-out' : '' }}" src="{{ $card->imagePath() }}" alt="Card image of {{ $card->name }}">
                </div>
                <div class="panel-footer">
                    {{ ($count) ? $count : '-' }}
                </div>
            </div>
    @endforeach
    @for($i=0; $i < 10; $i++)
        <div style="width: 200px; height: 0;"></div>
    @endfor
</div>