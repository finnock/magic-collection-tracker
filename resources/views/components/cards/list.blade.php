<table class="table table-striped">
    <thead>
    <tr>
        @if(isset($count))
            <th></th>
        @endif
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
                @if(isset($count))
                    <td class="text-right" style="padding-right: 0;">
                        @include('components.cardCountStack')
                    </td>
                    <td>
                        <strong>{{ $card->pivot->count or '' }}</strong>
                    </td>
                @else
                    <td>
                        <img width="50" src="{{ $card->imagePath() }}">
                    </td>
                @endif
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
                    <div class="row">
                        <a class="btn btn-sm btn-secondary" href="/Card/{{ $card->getAttributes()['id'] }}">
                            <i class="fa fa-folder-open"></i>&nbsp;Card
                        </a>
                        <div class="btn-group">
                            <form action="{{ url('/Collection/'.$card->getAttributes()['id']) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('PATCH') }}
                                <input type="hidden" value="-1" name="count">
                                <button type="submit" class="btn btn-sm btn-secondary" role="button">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </form>

                            <form action="{{ url('/Collection/'.$card->getAttributes()['id']) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('PATCH') }}
                                <input type="hidden" value="1" name="count">
                                <button type="submit" class="btn btn-sm btn-secondary" role="button">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </form>

                            <form action="{{ url('/Collection/'.$card->getAttributes()['id']) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-sm btn-danger" role="button">
                                    <i class="fa fa-remove"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>