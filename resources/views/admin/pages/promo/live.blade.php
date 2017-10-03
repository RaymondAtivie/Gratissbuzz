@extends('layout.default')
@section('title')
    Approved Promos
@stop
@section('main')
    <link href="//cdn.rawgit.com/noelboss/featherlight/1.7.1/release/featherlight.min.css" type="text/css" rel="stylesheet" />
    <!-- Slider -->
    <div class="page-head">
        <h3>
            Promos
        </h3>
        <span class="sub-title">Live Promos</span>
    </div>
    <style>
    textarea{
        resize: none
    }
    </style>

    <div class="wrapper" ng-app="gratisApp">

        <div class="row">
            <div class="col-md-12">
                @include("partials/flash")
            </div>
        </div>
        
        <div class="row" ng-controller="qCtrl as Q">

            <div class="col-md-12">
                <section class="panel">
                    <header class="panel-heading">
                        Promo List
                    </header>
                    <div class="panel-body">
                        <table class="table convert-data-table data-table"  id="sample_1">
                            <thead>
                                <tr>
                                    <th>
                                        Company
                                    </th>
                                    <th class="col-md-1">
                                        Live
                                    </th>
                                    <th class="col-md-1">
                                        Image
                                    </th>
                                    <th>
                                        Description
                                    </th>
                                    <th>
                                        Begin
                                    </th>
                                    <th>
                                        End
                                    </th>
                                    <th>
                                        Created
                                    </th>
                                    <th>
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lAds as $la)
                                    <tr>
                                        <td>
                                             <button class="btn btn-link" data-toggle="modal" data-target="#vendorModal{{$la->promo->vendor->id}}">
                                                {{$la->promo->vendor->name}}
                                            </button>
                                        </td>
                                        <td>
                                            @if($la->isLive())
                                                <i class="fa fa-circle" style="color: green"></i>
                                            @else
                                                <i class="fa fa-circle" style="color: yellow"></i>
                                            @endif
                                        </td>
                                        <td>
                                            <?php $i=0; ?>
                                            @foreach($la->promo->image as $img)
                                                <div style="width: 50px; display: inline-block" data-featherlight="#lightbox{{$la->promo->id}}{{$i}}">
                                                    <img src="{{$img}}" id="lightbox{{$la->promo->id}}{{$i}}" class="img-responsive" />
                                                    <?php $i++; ?>
                                                </div>
                                            @endforeach
                                        </td>
                                        <td>
                                            <small>{{$la->promo->description}}</small>
                                        </td>
                                        <td title="{{$la->begin->format('d M Y h:ia')}}">
                                            <small>{{$la->begin->format('d M Y h:ia')}}<br />
                                            {{$la->begin->diffForHumans()}}</small>
                                        </td>
                                        <td title="{{$la->end->format('d M Y h:ia')}}">
                                            <small>{{$la->end->format('d M Y h:ia')}}<br />
                                            {{$la->end->diffForHumans()}}</small>
                                        </td>
                                        <td>
                                            {{$la->promo->created_at->diffForHumans()}}
                                        </td>
                                        <td style="text-align: right">
                                             <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#liveDetails{{$la->id}}">
                                                <i class="fa fa-info-circle"></i> &nbsp; Details
                                            </button>
                                             <a href="{{url('advert/livepromos/remove/'.$la->id)}}" onclick="return confirm('Are you sure you want to remove this Live Promo?')" class="btn btn-danger btn-sm">
                                                <i class="fa fa-close"></i> &nbsp; Remove
                                            </a>
                                        </td>
                                    </tr>
                                    <!-- Modal -->
                                    <div class="modal fade" id="vendorModal{{$la->promo->vendor->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                        @include("partials.vendorBox", ["vendor" => $la->promo->vendor])
                                    </div>
                                    <!-- GO LIVE Modal -->
                                    <div class="modal fade" id="liveDetails{{$la->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="myModalLabel">{{$la->promo->vendor->name}}'s Promo</h4>
                                                </div>
                                                <form action="{{url('advert/adgolive/'.$la->promo->id)}}" method="POST">
                                                    <input type="hidden" name="selection_method" value="{{$la->promo->selection_method}}" />
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-10 col-md-offset-1"></div>
                                                                @foreach($la->promo->image as $img)
                                                                    <img src="{{$img}}" class="img-responsive" />
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        <br />
                                                        <div class="row">
                                                            <div class="col-md-10 col-md-offset-1">
                                                                <p>{{$la->promo->description}}</p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-2 col-md-offset-1">
                                                                <b>Begin</b>
                                                            </div>
                                                            <div class="col-md-8 ">
                                                                {{$la->begin->format('d M Y h:ia')}}
                                                            </div>
                                                        </div>
                                                        <br />
                                                        <div class="row">
                                                            <div class="col-md-2 col-md-offset-1">
                                                                <b>End</b>
                                                            </div>
                                                            <div class="col-md-8 ">
                                                                {{$la->end->format('d M Y h:ia')}}
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-danger">Remove from Live!!!</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>

    </div>
</div>
@stop

@section('styles')
@stop

@section('scripts')
    @include('admin.includes.datatable')
@endsection

@section('footer_scripts')
    <script src="//code.jquery.com/jquery-latest.js"></script>
    <script src="//cdn.rawgit.com/noelboss/featherlight/1.7.1/release/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="{{ url('js/angular.min.js') }}"></script>
    <script>
    angular.module('gratisApp', [])
        .controller('qCtrl', function() {
            this.qType = 'random';
        });
    </script>
    <script>
    $(document).ready(function(){
        $('#sample_1 tr, #sample_2 tr').click(function() {
            $(this).find('td input:radio').prop('checked', true);
        });
    });
    </script>
@stop
