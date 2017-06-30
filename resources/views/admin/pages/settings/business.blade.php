@extends('layout.default')
@section('title')
    Add Question
@stop
@section('main')
    <!-- Slider -->
    <div class="page-head">
        <h3>
            Business Categories
        </h3>
        <span class="sub-title">Add a new Business Category</span>
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

            <div class="col-md-6">
                <section class="panel">
                    <header class="panel-heading">
                        Add a new Business Category
                    </header>
                    <div class="panel-body">
                        <form method="POST" autocomplete="off" action="{{ url('settings/addBusiness') }}">
                            <input type="hidden" name="_token" value="{{ Session::getToken() }}"/>
                            @include('partials.errors')
                            @include('partials.messages')
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <h4>Business Category</h4>
                                    <input type="text" name="name" class="form-control" required />
                                </div>
                            </div>
                            
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <button type="submit" type="button" class="btn btn-info">Add Business Category</button>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <hr />
                                <table class="table">
                                    @foreach($qcs as $name => $id)
                                        <tr>
                                            <td>{{$name}}</td>
                                            <td style="text-align: right">
                                                <a href="{{url('settings/business/'.$id.'/remove')}}" class="btn btn-xs btn-danger">Remove</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
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
    <script src="{{ url('js/angular.min.js') }}"></script>
    <script>
    angular.module('gratisApp', [])
    .controller('qCtrl', function() {
        this.type = 'obj';

        this.switch = function(title){
            this.type = title;
        }
    });
    </script>
@stop
