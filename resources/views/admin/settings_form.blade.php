@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

			@include('layouts.partials.back_to_admin_dashboard_link')

			<h1>Competition settings</h1>
			{{-- dump($settings->toArray()) --}}

			<form method="post" action="{{route('admin.settings.update')}}" id="settings_form">
			    {{ csrf_field() }}
				<div class="form-group">
			    	<div class="row" style="margin-top:20px;">
				        <div class="col-xs-12">
				            <label for="title" class="control-label">Competition title</label>
				            <input type="text" class="form-control" id="title" name="title" value="{{ old('title',$settings->title) }}" />
				            @if ($errors->has('title'))
				                <span class="help-block">
				                    <strong>{{ $errors->first('title') }}</strong>
				                </span>
				            @endif
				        </div>
			       	</div>
			       	<div class="row" style="margin-top:20px;">
				        <div class="col-xs-12">
				            <label for="terms_and_conditions_url" class="control-label">Link to terms and conditions (eg http://www.warragulnational.org/term_and_conditions.html)</label>
				            <input type="text" class="form-control" id="terms_and_conditions_url" name="terms_and_conditions_url" value="{{ old('terms_and_conditions_url',$settings->terms_and_conditions_url) }}" />
				            @if ($errors->has('terms_and_conditions_url'))
				                <span class="help-block">
				                    <strong>{{ $errors->first('terms_and_conditions_url') }}</strong>
				                </span>
				            @endif
				        </div>
						</div>
			       	<div class="row" style="margin-top:20px;">
				        <div class="col-xs-12">
				            <label for="first_section_cost" class="control-label">First section entry cost (eg 14.00)</label>
				            <input type="text" class="form-control" id="first_section_cost" name="first_section_cost" value="{{ old('first_section_cost',$settings->first_section_cost) }}" />
				            @if ($errors->has('first_section_cost'))
				                <span class="help-block">
				                    <strong>{{ $errors->first('first_section_cost') }}</strong>
				                </span>
				            @endif
				        </div>
						</div>
			       	<div class="row" style="margin-top:20px;">
				        <div class="col-xs-12">
				            <label for="additional_section_cost" class="control-label">Additional section cost (eg 10.00)</label>
				            <input type="text" class="form-control" id="additional_section_cost" name="additional_section_cost" value="{{ old('additional_section_cost',$settings->additional_section_cost) }}" />
				            @if ($errors->has('additional_section_cost'))
				                <span class="help-block">
				                    <strong>{{ $errors->first('additional_section_cost') }}</strong>
				                </span>
				            @endif
				        </div>
						</div>
			       	<div class="row" style="margin-top:20px;">
				        <div class="col-xs-12">
				            <label for="max_entries_per_section" class="control-label">Maximum entries per section</label>
				            <input type="text" class="form-control" id="max_entries_per_section" name="max_entries_per_section" value="{{ old('max_entries_per_section',$settings->max_entries_per_section) }}" />
				            @if ($errors->has('max_entries_per_section'))
				                <span class="help-block">
				                    <strong>{{ $errors->first('max_entries_per_section') }}</strong>
				                </span>
				            @endif
				        </div>
			    	</div>

			    	<div class="row" style="margin-top:20px;">
				        <div class="col-xs-12">
				            <label for="max_entries_per_section" class="control-label">Return Instructions (one option per line)</label>
				            <textarea class="form-control" style="min-height:10em" name="return_instructions">{{ old('return_instructions',$settings->return_instructions) }}</textarea>

				            @if ($errors->has('return_instructions'))
				                <span class="help-block">
				                    <strong>{{ $errors->first('return_instructions') }}</strong>
				                </span>
				            @endif
				        </div>
			    	</div>

			    	 <div class="row">
				        <div class="col-xs-12">
				            <label class="control-label">Competition status</label>
				            <select  class="form-control" name="competition_status" >
				            <option  value="">Select status</option>
				           	@foreach(['Open','Closed'] as $v)
								<option {{ old('competition_status',$settings->competition_status) == $v ? 'selected' : '' }} value="{{$v}}">{{ $v }}</option>
							@endforeach
				            </select>
				            @if ($errors->has('club_nomination'))
				                <span class="help-block">
				                    <strong>{{ $errors->first('club_nomination') }}</strong>
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