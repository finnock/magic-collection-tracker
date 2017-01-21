@extends('layouts.content-fluid')

@section('content')

<script src="/js/peg-0.9.0.min.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<div class="form-group">
    <label for="usr">Query:</label>
    <input type="text" class="form-control" id="query">
</div>
<div class="form-group">
    <label for="comment">Grammar:</label>
    <textarea class="form-control" style="height: 600px; font-family:monospace;" id="grammar"></textarea>
</div>
<a href="#" id="refresh-btn" class="btn btn-primary">Refresh</a>

<script>

    var parser = null;

    $('#refresh-btn').click(function() {
        window.parser = PEG.buildParser($('#grammar').val());

        console.log(parser.parse($('#query').val(), <?php echo json_encode($cardItem); ?>));
    });

    axios.get('/js/mtgFilter.pegjs')
        .then(function (response) {
        })
        .catch(function (error) {
            console.log(error);
        });


</script>

@endsection