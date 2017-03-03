@if(session()->has("issue_status"))
    <div class="alert alert-{{session()->get('issue_status')}}" style="text-align: center">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {!!session()->get("issue_message")!!}
    </div>
@endif
