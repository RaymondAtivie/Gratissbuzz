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

<form>
        <div class="row">
            <div class="col-sm-8">
                <button type="submit" class="btn btn-lg btn-primary">Allocate</button>
                <button type="button" class="btn btn-lg btn-primary">Randomly Allocate All</button>
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
                                </tr>
                            </thead>
                            <tbody>
                            <?php $i=0; ?>
                                @foreach($questions as $q)
                                    <tr>
                                        <td>
                                            <label>
                                                <input type="radio" name="question_id" value="{{$q->id}}" />
                                            </label>
                                        </td>
                                        <td>
                                            {{$i+1}}
                                        </td>
                                        <td>
                                            <small>{{$q->question}}</small>
                                        </td>
                                        <td>
                                            {{$q->type}}
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>

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
                            @foreach($ads as $ad)
                                <tr>
                                    <td>
                                        <input type="radio" name="ad_id" value="{{$ad->id}}" />
                                    </td>
                                    <td>
                                        {{$ad->vendor->name}}
                                    </td>
                                    <td>
                                        {{$ad->incentive}}
                                    </td>
                                    <td>
                                        {{number_format($ad->incentive_amt)}}                                        
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
</form>
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
