@extends(config('sentinel.layout'))

{{-- Web site Title --}}
@section('title')
Log In
@stop

{{-- Content --}}
@section('content')

<form method="POST" action="{{ route('sentinel.session.store') }}" accept-charset="UTF-8">
    <div class="small-6 large-centered columns">
        <h3 class="form-signin-heading">Sign In</h3>

        <div class="row">
            <div class="small-2 columns">
                <label for="right-label" class="right inline">Cédula</label>
            </div>
            <div class="small-10 columns {{ ($errors->has('email')) ? 'error' : '' }}">
                <input placeholder="Email" autofocus="autofocus" name="email" type="text"  value="{{ Request::old('email') }}">
                {{ ($errors->has('email') ? $errors->first('email', '<small class="error">:message</small>') : '') }}
            </div>
        </div>
        <div class="row">
            <div class="small-2 columns">
                <label for="right-label" class="right inline">Password</label>
            </div>
            <div class="small-10 columns">
                <input class="form-control" placeholder="Password" name="password" value="" type="password">
                {{ ($errors->has('password') ?  $errors->first('password', '<small class="error">:message</small>') : '') }}
            </div>
        </div>
    </div>
</form>




@stop