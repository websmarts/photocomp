<p class="alert alert-warning"><strong>IMPORTANT NOTICE </strong>-
	Category definitions are clearly defined <a href="http://www.warragulnational.org/category-definitions/" target="_blank" title="Category definitions for entries"><strong>here</strong></a> and it is IMPORTANT all entries comply with
	the category requirements to avoid being rejected. Please review the definitions before submitting your entries in any category.
</p>

<div class="no-print" id="upload_form">


	<div style="background: #eee; padding: 5px;">
		<h3>Image upload form</h3>
		<div class="row" style="padding-top:10px;">
			<div class="col-xs-2" style="padding-top:30px; text-align: right;">
				<div>Image file:</div>
			</div>

			<div class="col-xs-4">
				<button id="select_file_btn" class="btn btn-large btn-primary btn-block" style="padding:10px">Click here to<br />select image to upload</button>
			</div>
			<div class="col-xs-6">
				<div>IMPORTANT: Image files must be:
					<ul>
						<li>JPEG format.</li>
						<li>No more than 1920 pixels wide.</li>
						<li>No more than 1080 pixels high.</li>
						<li>No more than a 3MB file size.</li>
					</ul>

				</div>
			</div>

		</div>
		<div class="row" style="padding-top:10px;">
			<div class="col-xs-2" style="padding-top:30px; text-align: right;">
				<div>Title:</div>
			</div>
			<div class="col-xs-8">
				&nbsp;<input class="form-control" type=text id="photoTitle" placeholder="Image title ..." />
			</div>
		</div>

		<div class="row" style="padding-top:10px;">
			<div class="col-xs-2" style="padding-top:10px; text-align: right;">
				<div>Section:</div>
			</div>

			<div class="col-xs-8">
				<select class="form-control" id="category_section" name="category_section">
					<option value="0">Select section....</option>
					@php
					echo category_section_options($categories);
					@endphp
				</select>
			</div>
		</div>



		<div class="row" style="padding-top:40px;">
			<div class="col-xs-12" style="text-align: center">
				<button id="upload_entry_btn" class="btn btn-large btn-primary">Upload</button>
			</div>
		</div><!-- row end -->

		<div class="row" style="padding-top:10px;">
			<div class="col-xs-10">
				<div id="progressOuter" class="progress progress-striped active" style="display:none;">
					<div id="progressBar" class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
				</div>
			</div>
		</div><!-- row end -->
	</div>
</div>

<div id="messageContainer" class="alert alert-warning alert-dismissible">
	<button type="button" id="closeMessageButton" class="close" aria-label="Close"><span id="close_icon" aria-hidden="true"></span></button>
	<p>&nbsp;</p>
	<div id="msgBox"></div>
</div>

<h3>Submitted images</h3>



<div id="entries"></div>
{{-- dump($application->toArray()) --}}
{{-- dump($returnOptions) --}}

<p>PLEASE ADDRESS ENTRIES TO</p>
<p>{{ $settings->title }}<br />
	P.O. Box 436, Warragul. Vic. 3820<br />
	OR DELIVER TO<br />
	Roylaines P/L 16 Smith Street,<br />Warragul. Vic. 3820.<br />
	or<br />
	Roylaines P/L 148 Main Street,<br />Pakenham. Vic. 3810.<br />
	or<br />
	Digital Works,<br />Unit 2/34-36 Melverton Drive,<br />Hallam. Vic. 3803.
</p>
<hr>

<p>ENTRY FEES<br />
	Base fee: ${{ number_format($settings->flagfall_cost,2)  }}<br />



	Digital image sections: ${{ number_format($settings->digital_section_cost,2) }} each section<br />
	Print sections: ${{ number_format($settings->print_section_cost,2) }} each section<br />
	@if($application->club_nomination !== "Warragul Camera Club")
	Please note - an additional fee of ${{ number_format($settings->digital_only_entry_surcharge,2) }} for catalog postage will apply for digital-only entries.<br>
	@endif
</p>
<hr>


<div class="row">
	<div class="col-xs-12">RETURN INSTRUCTIONS - FOR PRINT ENTRIES</div>
	<div class="col-xs-12">
		<select class="form-control" name="return_instructions" id="return_instructions">
			<!--<option value="">Select option ...</option>-->
			@foreach( $returnOptions as $opt)
			<option {{ $application->return_post_option == $opt ? 'selected' : '' }} value="{{$opt}}">{{ $opt }}</option>
			@endforeach
		</select>
	</div>
</div>

<!-- TODO implement this new form field for free text entry of the optional return group -->
<div class="row" style="margin-top:2em">
	<div class="col-xs-12">If you selected a group return option for your prints you need to enter the return group name below.</div>
	<div class="col-xs-12"><input placeholder="Return group name ..." type="text" id="return_group" class="form-control" style="width:30em" value="{{ $application->return_group }}" /></div>
</div>
<hr>

<p>RETURN POSTAGE</p>
Return postage for prints only - enter an amount sufficient to cover return:<br />
(Note: Only enter an amount here if you have selecetd the <strong>Return By Post</strong> option above)
<div class="input-group">
	<div class="input-group-addon">$</div><input type=text id="return_postage" class="form-control" style="width:5em" value="{{ $application->return_postage }}" />
</div>
<hr>
<p>TOTAL COST OF ENTRY<br />
	<div id="total_cost">0.00</div>



	<hr>

	<p>Only click the FINALISE ENTRY FORM button below after you have completed uploading all of your photos and indicated your return instructions.</p>
	<p>If you would like to complete this section later it is safe to logout and login again later when you are ready to continue updating the form, the system will remember all the photos you have uploaded to date.</p>

	<button id="final_submit_button" class="btn btn-primary">Finalise Entry Form</button>
	<p>&nbsp;</p>