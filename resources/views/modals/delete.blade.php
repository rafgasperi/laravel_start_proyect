<form method="POST" action="{{ route('sentinel.logout') }}" role="form" class="form" id="form-delete">
    <input name="_method" type="hidden" value="DELETE">
    <input name="_token" value="{{ csrf_token() }}" type="hidden">
    <div class="message-box animated fadeIn" data-sound="alert" id="mb-remove-row">
        <div class="mb-container">
            <div class="mb-middle">
                <div class="mb-title"><span class="fa fa-times"></span> Remove <strong>Data</strong> ?</div>
                <div class="mb-content">
                    <p>Are you sure you want to remove this row ?</p>
                    <p>Press Yes if you sure.</p>
                </div>
                <div class="mb-footer">
                    <div class="pull-right">
                        <button type="submit" class="btn btn-success btn-lg mb-control-yes">Yes</button>
                        <button class="btn btn-default btn-lg mb-control-close">No</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>