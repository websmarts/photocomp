@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

			@include('layouts.partials.back_to_admin_dashboard_link')

			<h1>Vaps Clubs</h1>


			<form method="post" action="{{route('admin.clubs.update')}}" id="clubs_form">
			    {{ csrf_field() }}
				<div class="form-group">


			    	<div class="row" style="margin-top:20px;">
				        <div class="col-xs-12">
				            <label for="clubs" class="control-label">VAPS Clubs (one option per line)</label>
				            <textarea class="form-control" style="min-height:600px" name="clubs">{{ old('clubs',$clubs) }}</textarea>

				            @if ($errors->has('clubs'))
				                <span class="help-block">
				                    <strong>{{ $errors->first('clubs') }}</strong>
				                </span>
				            @endif
				        </div>
			    	</div>


				</div> <!-- end form-group -->

				<div class="row" style="margin-top:20px;">
			        <div class="col-xs-12 col-md-3 col-md-offset-5">
			            <button type="submit" class="btn btn-primary" id="save_btn" name="save_btn" >Save</button>
			        </div>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection
