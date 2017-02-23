@extends('layout.default')
@section('title')
    Add Question
@stop
@section('main')
    <!-- Slider -->
    <div class="page-head">
        <h3>
            Batch
        </h3>
        <span class="sub-title">Add a new Batch</span>
    </div>
    <style>
    textarea{
        resize: none
    }
    </style>

    <div class="wrapper" ng-app="gratisApp">
        <div class="row" ng-controller="qCtrl as Q">

            <div class="col-md-4">
                <section class="panel">
                    <header class="panel-heading">
                        Add a new Batch
                    </header>
                    <div class="panel-body">
                        <form method="POST" enctype="multipart/form-data" autocomplete="off" action="{{ url('admin/home/changeLogo/') }}">
                            <input type="hidden" name="_token" value="{{ Session::getToken() }}"/>
                            @include('partials.errors')
                            @include('partials.messages')
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <h4>Batch Name</h4>
                                    <input type="text" name="name" class="form-control" />
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <h4>Number of Questions</h4>
                                    <input type="number" name="name" class="form-control" />
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <h4>Days</h4>
                                    <select name="" class="form-control">
                                        @for($i=5;$i<=30;$i = $i +5)
                                            <option>{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <hr />
                                <div class="form-group">
                                    <button type="submit" type="button" class="btn btn-info">Create Batch</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
            </div>

            <div class="col-md-8">
                <section class="panel">
                    <header class="panel-heading">
                        Cashless Ads
                    </header>
                    <div class="panel-body">
                        <table class="table convert-data-table data-table"  id="sample_1">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>
                                        Vendor
                                    </th>
                                    <th>
                                        Question
                                    </th>
                                    <th>
                                        Type
                                    </th>
                                    <th>
                                        Answer
                                    </th>
                                    <th>
                                        Used
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @for($i=0;$i<10;$i++)
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="questions[]" value="{{$i}}" />
                                        </td>
                                        <td>
                                            {{$i+1}}
                                        </td>
                                        <td>
                                            <small>Questions for the gods</small>
                                        </td>
                                        <td>
                                            Theory
                                        </td>
                                        <td>
                                            C
                                        </td>
                                        <td>
                                            2
                                        </td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>

        </div>
    </div>
@stop
@section('scripts')
    @include('admin.includes.datatable')
@endsection

@section('footer_scripts')
    <script>
    $(document).ready(function(){
        $('#sample_1 tr, #sample_2 tr').click(function() {
            $(this).find('td input:checkbox').prop('checked', true);
        });
    });
    </script>
@stop
