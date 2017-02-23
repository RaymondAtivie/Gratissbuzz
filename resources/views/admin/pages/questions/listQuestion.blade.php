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
        <div class="row" ng-controller="qCtrl as Q">

            <div class="col-md-12">
                <section class="panel">
                    <header class="panel-heading">
                        Questions List
                    </header>
                    <div class="panel-body">
                        <table class="table convert-data-table data-table"  id="sample_1">
                            <thead>
                                <tr>
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
