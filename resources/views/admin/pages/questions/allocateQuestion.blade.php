@extends('layout.default')
@section('title')
    Add Question
@stop
@section('main')
    <!-- Slider -->
    <div class="page-head">
        <h3>
            Questions
        </h3>
        <span class="sub-title">Add a new Question</span>
    </div>
    <style>
    textarea{
        resize: none
    }
    </style>

    <div class="wrapper" ng-app="gratisApp">

        <div class="row">
            <div class="col-sm-8">
                <button class="btn btn-lg btn-primary">Allocate</button>
                <button class="btn btn-lg btn-primary">Randomly Allocate All</button>
            </div>
        </div>
        <br />
        <div class="row" ng-controller="qCtrl as Q">
            <div class="col-md-6">
                <section class="panel">
                    <header class="panel-heading">
                        Questions List
                    </header>
                    <div class="panel-body">
                        <table class="table convert-data-table data-table"  id="sample_1">
                            <thead>
                                <tr>
                                    <th>

                                    </th>
                                    <th>
                                        S/N
                                    </th>
                                    <th>
                                        Question
                                    </th>
                                    <th>
                                        Type
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
                                            <label>
                                                <input type="radio" name="question_id" value="{{$i}}" />
                                            </label>
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
                                            2
                                        </td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>

            {{-- <div class="col-md-1">
        </div> --}}

        <div class="col-md-6">
            <section class="panel">
                <header class="panel-heading">
                    Advert List
                </header>
                <div class="panel-body">
                    <table class="table convert-data-table data-table"  id="sample_2">
                        <thead>
                            <tr>
                                <th>

                                </th>
                                <th>
                                    Vendor Name
                                </th>
                                <th>
                                    Incentive
                                </th>
                                <th>
                                    Amount
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @for($i=0;$i<10;$i++)
                                <tr>
                                    <td>
                                        <input type="radio" name="vendor_id" value="{{$i}}" />
                                    </td>
                                    <td>
                                        Reftek
                                    </td>
                                    <td>
                                        Free Website
                                    </td>
                                    <td>
                                        {{number_format(140000)}}
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
