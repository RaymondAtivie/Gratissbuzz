<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Send message to {{$user->name}}</h4>
        </div>
        <form method="POST" action="{{ url('users/sendmessagetoone') }}">
            <div class="modal-body">
                
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <h4>Title</h4>
                            <input type="text" name="title" class="form-control" required />
                            <input type="hidden" name="user_id" class="form-control" value="{{$user->id}}" />
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
                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Send</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </form>
    </div>
</div>