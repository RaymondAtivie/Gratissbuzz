<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">{{$vendor->name}}</h4>
        </div>
        <div class="modal-body">
            <h4>User Details</h4>
            <div class="row">
                <div class="col-md-3"><b>Name</b></div>
                <div class="col-md-9">{{$vendor->user->name}}</div>
            </div>
            <hr />
            <div class="row">
                <div class="col-md-3"><b>Email</b></div>
                <div class="col-md-9">{{$vendor->user->email}}</div>
            </div>
            <hr />
            <div class="row">
                <div class="col-md-3"><b>Phone</b></div>
                <div class="col-md-9">{{$vendor->user->phone}}</div>
            </div>
            <hr />
            <div class="row">
                <div class="col-md-3"><b>Location</b></div>
                <div class="col-md-9">{{$vendor->user->location}}</div>
            </div>
            <hr />

            <h4>Vendor Details</h4>
            <div class="row">
                <div class="col-md-3"><b>Name</b></div>
                <div class="col-md-9">{{$vendor->name}}</div>
            </div>
            <hr />
            <div class="row">
                <div class="col-md-3"><b>Short Description</b></div>
                <div class="col-md-9">{{$vendor->short_description}}</div>
            </div>
            <hr />
            <div class="row">
                <div class="col-md-3"><b>Full Description</b></div>
                <div class="col-md-9">{{$vendor->full_description}}</div>
            </div>
            <hr />
            <div class="row">
                <div class="col-md-3"><b>Address</b></div>
                <div class="col-md-9">{{$vendor->address}}</div>
            </div>
            <hr />
            <div class="row">
                <div class="col-md-3"><b>Phone</b></div>
                <div class="col-md-9">{{$vendor->phone}}</div>
            </div>
            <hr />
            <div class="row">
                <div class="col-md-3"><b>Email</b></div>
                <div class="col-md-9">{{$vendor->email}}</div>
            </div>
            <hr />
            <div class="row">
                <div class="col-md-3"><b>Business Category</b></div>
                <div class="col-md-9">{{$vendor->category}}</div>
            </div>
            <hr />
            <div class="row">
                <div class="col-md-3"><b>Website</b></div>
                <div class="col-md-9">{{$vendor->website}}</div>
            </div>
            <hr />
            <div class="row">
                <div class="col-md-3"><b>Location</b></div>
                <div class="col-md-9">{{$vendor->location}}</div>
            </div>
            <hr />
            <div class="row">
                <div class="col-md-3"><b>Facebook</b></div>
                <div class="col-md-9">{{$vendor->facebook}}</div>
            </div>
            <hr />
            <div class="row">
                <div class="col-md-3"><b>Twitter</b></div>
                <div class="col-md-9">{{$vendor->twitter}}</div>
            </div>
            <hr />
            <div class="row">
                <div class="col-md-3"><b>Instagram</b></div>
                <div class="col-md-9">{{$vendor->instagram}}</div>
            </div>
            <hr />
            <div class="row">
                <div class="col-md-3"><b>BlackBerry</b></div>
                <div class="col-md-9">{{$vendor->blackberry}}</div>
            </div>
            <hr />
            <div class="row">
                <div class="col-md-3"><b>Youtube</b></div>
                <div class="col-md-9">{{$vendor->youtube}}</div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>