@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

			@include('layouts.partials.back_to_admin_dashboard_link')

			<h1>Update Administrator Login</h1>

			<p>Current email: {{ Auth::user()->email }}</p>

			<div clsss="row" style="margin-top:60px">

				<form method="post" action="{{ route('admin.credentials.update') }}">
				{{ csrf_field() }}

			 		<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}" style="clear:left;">
                        <label for="email" class="col-md-6 control-label">E-Mail / Login</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}" style="clear:left;">
                        <label for="password" class="col-md-6 control-label">Password (must be at least 6 characters)</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="password" required>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group" style="clear:left;">
                        <label for="password-confirm" class="col-md-6 control-label">Confirm Password</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>
                    </div>

                    <div class="form-group" style="margin-top:60px;">
                        <div class="col-md-offset-6 col-md-6 ">
                            <button type="submit" class="btn btn-primary">
                                Update
                            </button>
                        </div>
                    </div>

                </form>
            </div>
		</div>
	</div>
</div>

@endsection
