@extends('layouts.bootstrap')

@section('content')

    <?php
    $obj = json_decode(file_get_contents('C:\localhost\htdocs\json-to-mysql-master\SetList.json'), true, 1024);

    dd($obj);

    foreach ($obj['cards'] as $name => $card)
    {
        echo "<h3>$name</h3>";
        foreach ($card as $key => $value)
        {
            if (!is_array($value))
                echo "$key => $value <br>";
            else
                echo "$key => " . json_encode($value) . "<br>";
        }
    }
    ?>

@endsection