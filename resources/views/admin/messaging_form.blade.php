@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

			@include('layouts.partials.back_to_admin_dashboard_link')


			{{-- dump($settings->toArray()) --}}
			<h3>Send a message to all applicants</h3>
			<p> Send a simple message to be sent all applicants email addreses. Enter the email subject and the message below.</p>

			<p>To send a test message to your Admin user email address - ensure the SUBJECT entry starts with the word TEST. To send message to all applicants make sure the subject DOES NOT start with TEST</p>

			<form method="post" action="{{route('admin.message_all')}}" id="message_form">
			    {{ csrf_field() }}
				<div class="form-group">
			    	<div class="row" style="margin-top:20px;">
				        <div class="col-xs-12">
				            <label for="subject" class="control-label">Subject</label>
				            <input type="text" class="form-control" id="subject" name="subject" value="{{ old('subject',$settings->subject) }}" />
				            @if ($errors->has('subject'))
				                <span class="help-block">
				                    <strong>{{ $errors->first('subject') }}</strong>
				                </span>
				            @endif
				        </div>
			       	</div>

			    	<div class="row" style="margin-top:20px;">
				        <div class="col-xs-12">
				            <label for="content" class="control-label">Message</label>
				            <textarea class="form-control" style="min-height:10em" name="content">{{ old('content',$settings->content) }}</textarea>

				            @if ($errors->has('content'))
				                <span class="help-block">
				                    <strong>{{ $errors->first('content') }}</strong>
				                </span>
				            @endif
				        </div>
			    	</div>

			    </div>

				<div class="row" style="margin-top:20px;">
			        <div class="col-xs-12 col-md-3 col-md-offset-5">
			            <button type="submit" class="btn btn-primary" id="save_btn" name="save_btn" >Send Message</button>
			        </div>
				</div>
			</form>

			<div style="margin-bottom: 20px;margin-top: 20px; border-bottom:1px dashed #333"></div>

			<h3>Send Final Reports</h3>
			<p>NOTE: The spreadsheet file must be in an EXCEL 2003 (xls) format. 
				It must only contain one worksheet - delete any additional worksheets otherwise the report 
				will not function correctly.</p>

				<form method="post" action="{{route('admin.message_results')}}"  enctype="multipart/form-data" id="message_results_form">
					{{ csrf_field() }}
					<div class="form-group">
				    	<div class="row" style="margin-top:20px;">
					        <div class="col-xs-12">
					            <label for="spreadsheet" class="control-label">Results spreadsheet</label>
					            <input type="file" class="form-control" id="spreadsheet" name="spreadsheet" value="{{ old('spreadsheet',$settings->spreadsheet) }}" />
					            @if ($errors->has('spreadsheet'))
					                <span class="help-block">
					                    <strong>{{ $errors->first('spreadsheet') }}</strong>
					                </span>
					            @endif
					        </div>
				       	</div>
			       </div>

					<div class="row" style="margin-top:20px;">
				        <div class="col-xs-12 col-md-3 col-md-offset-5">
				            <button type="submit" class="btn btn-primary" id="save_btn" name="save_btn" >Send Competition Results</button>
				        </div>
					</div>

				</form>

				<div style="margin-bottom: 20px;margin-top: 20px; border-bottom:1px dashed #333"></div>

				<h3>Send Acceptance Certificates</h3>
			<p>NOTE: The spreadsheet file must be in an EXCEL 2003 (xls) format. 
				It must only contain one worksheet - delete any additional worksheets otherwise the report 
				will not function correctly.</p>
				
				<form method="post" action="{{route('admin.acceptances')}}"  enctype="multipart/form-data" id="message_results_form">
					{{ csrf_field() }}
					<div class="form-group">
				    	<div class="row" style="margin-top:20px;">
					        <div class="col-xs-12">
					            <label for="spreadsheet" class="control-label">Certificate spreadsheet</label>
					            <input type="file" class="form-control" id="spreadsheet" name="spreadsheet" value="{{ old('spreadsheet',$settings->spreadsheet) }}" />
					            @if ($errors->has('spreadsheet'))
					                <span class="help-block">
					                    <strong>{{ $errors->first('spreadsheet') }}</strong>
					                </span>
					            @endif
					        </div>
				       	</div>
			       </div>

					<div class="row" style="margin-top:20px;">
				        <div class="col-xs-12 col-md-3 col-md-offset-5">
				            <button type="submit" class="btn btn-primary" id="save_btn" name="save_btn" >Send Acceptance Certificates</button>
				        </div>
					</div>

				</form>
				<div style="margin-bottom: 20px;margin-top: 40px; border-bottom:1px dashed #333"></div>

				<form method="post" action="{{route('admin.acceptance.background')}}"  enctype="multipart/form-data" id="message_results_form">
					{{ csrf_field() }}
					<div class="form-group">
				    	<div class="row" style="margin-top:20px;">
					        <div class="col-xs-12">
					            <label for="background" class="control-label">Certificate background image ** use a 2480px x 3508px jpg </label>
					            <input type="file" class="form-control" id="background" name="background" value="{{ old('background',$settings->background) }}" />
					            @if ($errors->has('background'))
					                <span class="help-block">
					                    <strong>{{ $errors->first('background') }}</strong>
					                </span>
					            @endif
					        </div>
				       	</div>
			       </div>

					<div class="row" style="margin-top:20px;">
				        <div class="col-xs-12 col-md-3 col-md-offset-5">
				            <button type="submit" class="btn btn-primary" id="save_btn" name="save_btn" >Upload background image</button>
				        </div>
					</div>

				</form>
				<p>The current background image:
				<a href="/storage/certificate_background.jpg?{{ time() }}" target="_blank" ><img src="/storage/certificate_background.jpg?{{ time() }}" width="200" border="0" /></a></p>

				<div style="margin-bottom: 20px;margin-top: 20px; border-bottom:1px dashed #333"></div>

		</div>
	</div>
</div>

@endsection
