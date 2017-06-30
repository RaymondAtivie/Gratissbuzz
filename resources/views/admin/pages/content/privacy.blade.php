@extends('layout.default')
@section('title')
    Privacy Policy Content
@stop
@section('main')
    <!-- Slider -->
    <div class="page-head">
        <h3>
            Add Privacy Policy
        </h3>
        <span class="sub-title">Privacy Policy</span>
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
                        Privacy Policy Content
                    </header>
                    <div class="panel-body">
                        <form action="{{ url('content/privacy') }}" method="POST">
                            <input type="hidden" name="name" value="privacy" />
                            <div class="row">
                                <div class="col-md-8 col-md-offset-2">
                                    <textarea class="form-control" name="content" style="height: 500px" placeholder="Privacy Policy content">{{$privacy->content}}</textarea>
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
