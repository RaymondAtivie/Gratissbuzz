@extends('layout.default')
@section('title')
    Add Question
@stop
@section('main')
    <!-- Slider -->
    <div class="page-head">
        <h3>
            Send Message
        </h3>
        <span class="sub-title">Send Message to all users</span>
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
                        Send Message to all users
                    </header>
                    <div class="panel-body">
                        <form method="POST" autocomplete="off" action="{{ url('users/sendmessagetoall') }}">
                            <input type="hidden" name="_token" value="{{ Session::getToken() }}"/>
                            @include('partials.errors')
                            @include('partials.messages')
                            
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <h4>Title</h4>
                                    <input name="title" class="form-control" required />
                                </div>
                            </div>
                            
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <h4>Message</h4>
                                    <textarea name="message" class="form-control" required rows="5"></textarea>
                                </div>
                            </div>
                            
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <h4>Type</h4>
                                    <select name="type" class="form-control">
                                        <option value="">--SELECT TYPE--</option>
                                        <option value="message">Message</option>
                                        <option value="warning">Warning</option>
                                        <option value="promo">Promo</option>
                                        <option value="info">Info</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <button type="submit" type="button" class="btn btn-info">Send Message</button>
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
