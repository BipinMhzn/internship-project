@if($message = Session::get('success'))
    <div class="row">
        <div class="col-md-4 mr-md-auto">
            <div class="alert alert-info alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        </div>
    </div>
@endif
