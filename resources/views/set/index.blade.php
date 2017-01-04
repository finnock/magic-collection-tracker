@extends('layouts.content')

@section('content')
    <table class="table table-striped">
        <thead>
        <tr>
            <th></th>
            <th>Code</th>
            <th>Name</th>
            <th>Block</th>
            <th>Type</th>
            <th>Cards</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($sets as $set)
            <tr>
                <td><i class="ss ss-2x ss-fw ss-{{ strtolower($set->code) }}"></i></td>
                <td>{{ $set->code }}</td>
                <td>{{ $set->name }}</td>
                <td>{{ $set->block }}</td>
                <td>{{ $set->type }}</td>
                <td>{{ $set->cardCount }}</td>

                <td>
                    <a class="btn btn-small btn-success" href="/Set/{{ $set->code }}">
                        <span class="glyphicon glyphicon-folder-open "></span>
                        &nbsp;Show Set
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection