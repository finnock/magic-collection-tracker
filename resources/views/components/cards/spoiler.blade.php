<?php $cardCollection = $set->cards; ?>

@while(!$cardCollection->isEmpty())

    <?php  // Take 4 cards annd remove them from the Collection
        $cards = $cardCollection->take(8);
        $cardCollection = $cardCollection->slice(8);
    ?>

    <!-- Display those 4 cards -->
    <div class="card-deck" style="margin: 10px 0;">
        @foreach($cards as $card)
            <div class="card" style="width: 155px; margin: 0 5px;">
                <img class="card-img-top img-fluid" src="{{ $card->imagePath() }}" alt="Card image of {{ $card->name }}">
                <div class="card-footer">
                    <small class="text-muted">{{ $card->name }}</small>
                </div>
            </div>
        @endforeach
    </div>

@endwhile