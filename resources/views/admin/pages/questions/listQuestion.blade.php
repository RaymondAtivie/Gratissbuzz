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
            @include("partials/flash")
        </div> 

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
                                        Category
                                    </th>
                                    <th>
                                        Type
                                    </th>
                                    <th>
                                        Answer
                                    </th>
                                    <th>
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $i=0; ?>
                                @foreach($questions as $q)
                                    <tr>
                                        <td>
                                            {{$i+1}}
                                        </td>
                                        <td>
                                            <small>{{$q->question}}</small>
                                        </td>
                                        <td>
                                            <small>{{$q->category}}</small>
                                        </td>
                                        <td>
                                            {{$q->type}}
                                        </td>
                                        <td>
                                            {{$q->answer}}
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-info" data-toggle="modal" data-target="#editModal{{$q->id}}">Edit</a>
                                            <a href="{{url('question/'.$q->id.'/delete')}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this question?')">Delete</a>
                                        </td>
                                    </tr>

                                        <!-- Modal -->
                                        <div class="modal fade" id="editModal{{$q->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">Edit this question</h4>
                                            </div>
                                            <form action="{{url('question/'.$q->id.'/edit')}}" method="POST">
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h4>Question</h4>
                                                        <textarea class="form-control" name="question">{{$q->question}}</textarea>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <h4>Question Category</h4>
                                                            <select name="category" class="form-control" required>
                                                                <option value="">{{$q->category}}</option>
                                                                @foreach($qcs as $qc)
                                                                    <option value="{{$qc}}">{{$qc}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                    @if($q->type == "obj")
                                                        <div class="col-sm-12">
                                                            <h4>Answer Options</h4>
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon">
                                                                            <input type="radio" @if($q->answer == 'A')  checked="checked" @endif name="answer" value="A">
                                                                        </span>
                                                                        <span class="input-group-addon"><b>A</b></span>
                                                                        <input type="text" name="option_a" class="form-control" value="{{$q->option_a}}" required placeholder="Option A">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <br />
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon">
                                                                            <input type="radio" @if($q->answer == 'B')  checked="checked" @endif name="answer" value="B">
                                                                        </span>
                                                                        <span class="input-group-addon"><b>B</b></span>
                                                                        <input type="text" name="option_b" class="form-control" value="{{$q->option_b}}" required placeholder="Option B">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <br />
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon">
                                                                            <input type="radio" @if($q->answer == 'C')  checked="checked" @endif name="answer" value="C">
                                                                        </span>
                                                                        <span class="input-group-addon"><b>C</b></span>
                                                                        <input type="text" name="option_c" class="form-control" value="{{$q->option_c}}" required placeholder="Option C">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <br />
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon">
                                                                            <input type="radio" @if($q->answer == 'D') checked="checked" @endif name="answer" value="D">
                                                                        </span>
                                                                        <span class="input-group-addon"><b>D</b></span>
                                                                        <input type="text" name="option_d" class="form-control" value="{{$q->option_d}}" required placeholder="Option D">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="col-sm-12">
                                                            <h4>Theory Answer</h4>
                                                            <textarea name="answer" class="form-control" required rows="2">{{$q->answer}}</textarea>
                                                        </div>
                                                    @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                            </form>
                                            </div>
                                        </div>
                                        </div>
                                    <?php $i++; ?>
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
