@extends('layout.default')
@section('title')
    How it Works Content
@stop
@section('main')
    <!-- Slider -->
    <div class="page-head">
        <h3>
            Add How it Works
        </h3>
        <span class="sub-title">How it works</span>
    </div>
    <style>
    textarea{
        resize: none
    }
    </style>

    <div class="wrapper" ng-app="gratisApp">
        <div class="row" ng-controller="qCtrl as Q">
           
        <div class="col-md-12">
            @include("partials/flash")
        </div> 

            <div class="col-md-12">
                <section class="panel">
                    <header class="panel-heading">
                        How it Works Content
                    </header>
                    <div class="panel-body">
                        <form action="{{ url('content/how') }}" method="POST">
                            <input type="hidden" name="name" value="how" />
                            <div class="row">
                                <div class="col-md-8 col-md-offset-2">
                                    <textarea class="form-control" name="content" style="height: 500px" placeholder="Details of How it works">{{$how->content}}</textarea>
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="col-md-4 col-md-offset-4">
                                    <button type="submit" class="btn btn-lg btn-block btn-success">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
            </div>

    </div>
</div>
@stop

@section('styles')
@stop

@section('scripts')
@endsection

@section('footer_scripts')
    <script>
    </script>
@stop
