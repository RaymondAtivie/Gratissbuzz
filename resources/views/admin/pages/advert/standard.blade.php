@extends('layout.default')
@section('title')
    Pending Cashless Adverts
@stop
@section('main')
    <!-- Slider -->
    <div class="page-head">
        <h3>
            Standard Adverts
        </h3>
        <span class="sub-title">Top of App Home Page</span>
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
        
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
            
                <section class="panel">
                    <header class="panel-heading">
                        Add new Advert
                    </header>
                    <div class="panel-body">
                        <form action="{{url('advert/newstandardad')}}" method="POST" enctype="multipart/form-data">
                             <div class="col-sm-12">
                                <div class="form-group">
                                    <h4>Image</h4>
                                    <input type="file" required name="image" class="form-control" required />
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <h4>Link</h4>
                                    <input type="text" required name="link" placeholder="http://www.example.com" class="form-control" required />
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <h4>Begin</h4>
                                    <input type="datetime-local" required name="begin" class="form-control" required />
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <h4>End</h4>
                                    <input type="datetime-local" required name="end" class="form-control" required />
                                </div>
                            </div>


                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input type="submit" value="ADD" class="btn btn-primary" />
                                </div>
                            </div>

                        </form>
                    </div>
                </section>

            </div>
        </div>

        <div class="row" ng-controller="qCtrl as Q">

            <div class="col-md-12">
                <section class="panel">
                    <header class="panel-heading">
                        Advert List
                    </header>
                    <div class="panel-body">
                        <table class="table convert-data-table data-table"  id="sample_1">
                            <thead>
                                <tr>
                                    <th>
                                        Image
                                    </th>
                                    <th>
                                        Link
                                    </th>
                                    <th>
                                        Begins
                                    </th>
                                    <th>
                                        Ends
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
                                @foreach($sAds as $a)
                                    <tr>
                                        <td class="col-md-2">
                                            <img src="{{$a->image}}" class="img img-responsive" />
                                        </td>
                                        <td>
                                            <small>{{$a->link}}</small>
                                        </td>
                                        <td>
                                            {{$a->begin}}
                                        </td>
                                        <td>
                                            {{$a->end}}
                                        </td>
                                        <td>
                                            {{$a->created_at}}
                                        </td>
                                        <td style="text-align: right">
                                            <button class="btn btn-danger btn-sm">
                                                <i class="fa fa-close"></i> Remove
                                            </button>
                                        </td>
                                    </tr>
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
    <script>
    $(document).ready(function(){
        $('#sample_1 tr, #sample_2 tr').click(function() {
            $(this).find('td input:radio').prop('checked', true);
        });
    });
    </script>
@stop
