@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

			@include('layouts.partials.back_to_admin_dashboard_link')

			<h1>Edit Application</h1>
			{{-- dump($application) --}}
			<div clsss="row">
			<div class="col-sm-3">Entrant:</div><div class="col-sm-9">{{ $application->fullname }}</div>
			<div class="col-sm-3">Phone:</div><div class="col-sm-9">{{ $application->phone }}</div>
			<div class="col-sm-3">Email:</div><div class="col-sm-9">{{ $application->user->email }}
				@if($application->user->verified)
				 (verified)
				 @else
				 (email NOT verified - <a href="{{ route('admin.application.verifyemail',['application'=>$application->id]) }}">click here to verify user email now</a>)
				 @endif

			</div>
			</div>
			<form method="post" action="{{ route('admin.application.update',['application'=>$application->id]) }}">
			{{ csrf_field() }}

			<div class="form-group">
			    <div class="row">
			        <div class="col-xs-12">
			            <label for="mc_gross" class="control-label">Amount paid</label>
			            <input type="text" class="form-control" id="mc_gross" name="mc_gross" value="{{ old('mc_gross',$application->mc_gross) }}"/>
			            @if ($errors->has('mc_gross'))
			                <span class="help-block">
			                    <strong>{{ $errors->first('mc_gross') }}</strong>
			                </span>
			            @endif
			        </div>
			    </div>
			</div>

			<div class="form-group">
			    <div class="row">
			        <div class="col-xs-12">
			            <label for="payment_method" class="control-label">Payment method</label>
			            <input type="text" class="form-control" id="payment_method" name="payment_method" value="{{ old('payment_method',$application->payment_method) }}"/>
			            @if ($errors->has('payment_method'))
			                <span class="help-block">
			                    <strong>{{ $errors->first('payment_method') }}</strong>
			                </span>
			            @endif
			        </div>
			    </div>
			</div>

			<div class="form-group">
			    <div class="row">
			        <div class="col-xs-12">
			            <label for="notes" class="control-label">Notes or Comments</label>
			            <textarea style="min-height:80px;" class="form-control" id="notes" name="notes" >{{ old('notes',$application->notes) }}</textarea>
			            @if ($errors->has('notes'))
			                <span class="help-block">
			                    <strong>{{ $errors->first('notes') }}</strong>
			                </span>
			            @endif
			        </div>
			    </div>
			</div>



			<div class="form-group">
			    <div class="row">
			        <div class="col-xs-12">
			            <label for="notes" class="control-label">Enter DELETE in the field below to remove the application<br></label>
			            <input type="text" class="form-control" id="payment_method" name="delete_application" value="" />
			    </div>
			</div>


			<button class="btn btn-primary">Update Application</button>
			</form>
		</div>
	</div>
</div>

@endsection
