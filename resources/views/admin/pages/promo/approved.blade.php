@extends('layout.default')
@section('title')
    Approved Promo
@stop
@section('main')
<link href="//cdn.rawgit.com/noelboss/featherlight/1.7.1/release/featherlight.min.css" type="text/css" rel="stylesheet" />
    <!-- Slider -->
    <div class="page-head">
        <h3>
            Promo
        </h3>
        <span class="sub-title">Pending Approval</span>
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
                        Approved Promos List
                    </header>
                    <div class="panel-body">
                        <table class="table convert-data-table data-table"  id="sample_1">
                            <thead>
                                <tr>
                                    <th>
                                        Company Name
                                    </th>
                                    <th class="col-md-1">
                                        Image
                                    </th>
                                    <th class="col-md-2">
                                        Promo Title
                                    </th>
                                    <th>
                                        Description
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
                                @foreach($aAds as $a)
                                    <tr>
                                        <td>
                                            <button class="btn btn-link" data-toggle="modal" data-target="#vendorModal{{$a->vendor->id}}">
                                                {{$a->vendor->name}}
                                            </button>
                                        </td>
                                        <td>
                                            <?php $i=0; ?>
                                            @foreach($a->image as $img)
                                                <div style="width: 50px; display: inline-block" data-featherlight="#lightbox{{$a->id}}{{$i}}">
                                                    <img src="{{$img}}" id="lightbox{{$a->id}}{{$i}}" class="img-responsive" />
                                                    <?php $i++; ?>
                                                </div>
                                            @endforeach
                                        </td>
                                        <td>
                                            {{$a->short_description}}
                                        </td>
                                        <td>
                                            <small>{{$a->description}}</small>
                                        </td>
                                        <td>
                                            {{$a->created_at->diffForHumans()}}
                                        </td>
                                        <td style="text-align: right">
                                            <a href="{{url('advert/unapprovepromo/'.$a->id)}}" class="btn btn-warning btn-sm">
                                                <i class="fa fa-check"></i> &nbsp; Un-Approve
                                            </a>
                                            <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#golive{{$a->id}}">
                                                <i class="fa fa-lightbulb-o"></i> &nbsp; Go Live!!!
                                            </button>
                                        </td>
                                    </tr>
                                    <!-- Modal -->
                                    <div class="modal fade" id="vendorModal{{$a->vendor->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                        @include("partials.vendorBox", ["vendor" => $a->vendor])
                                    </div>
                                    <!-- GO LIVE Modal -->
                                    <div class="modal fade" id="golive{{$a->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="myModalLabel">{{$a->vendor->name}}'s Promo</h4>
                                                </div>
                                                <form action="{{url('advert/promogolive/'.$a->id)}}" method="POST">
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-10 col-md-offset-1">
                                                            
                                                                <?php $i=0; ?>
                                                                @foreach($a->image as $img)
                                                                        <img src="{{$img}}" class="img-responsive" />
                                                                        <?php $i++; ?>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        <br />
                                                        <div class="row">
                                                            <div class="col-md-10 col-md-offset-1">
                                                                <p>{{$a->description}}</p>
                                                            </div>
                                                        </div>
                                                        <hr />
                                                        <div class="row">
                                                            <div class="col-md-2 col-md-offset-1">
                                                                <b>Begin</b>
                                                            </div>
                                                            <div class="col-md-8 ">
                                                                <input class="form-control" required type="datetime-local" name="begin" />
                                                            </div>
                                                        </div>
                                                        <br />
                                                        <div class="row">
                                                            <div class="col-md-2 col-md-offset-1">
                                                                <b>End</b>
                                                            </div>
                                                            <div class="col-md-8 ">
                                                                <input class="form-control" required type="datetime-local" name="end" />
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-info">Go Live!!!</button>
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
    <script>
    $(document).ready(function(){
        $('#sample_1 tr, #sample_2 tr').click(function() {
            $(this).find('td input:radio').prop('checked', true);
        });
    });
    </script>
@stop
