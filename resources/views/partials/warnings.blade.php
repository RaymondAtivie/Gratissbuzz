@if (Session::has('message'))
    <div class="alert alert-warning">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

        {!! session('message') !!}
    </div>

@endif

@if (isset($message))
    <div class="alert alert-warning">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

        {!! $message !!}
    </div>
@endif