@if (Session::has('message'))
    <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

        <li>{!! session('message') !!}</li>
    </div>

@endif

@if (isset($message))
    <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

        <li>{!! $message !!}</li>
    </div>
@endif