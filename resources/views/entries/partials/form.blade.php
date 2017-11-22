


<div class="no-print">

	<div style="background: #eee; padding: 5px;" >
		<h3>Upload images</h3>
		<div class="row" style="padding-top:10px;">
			<div class="col-xs-2" style="padding-top:30px; text-align: right;">
				<div>Title:</div>
			</div>

			<div class="col-xs-4" >
			  <button id="select_file_btn" class="btn btn-large btn-primary btn-block" style="padding:10px" >Click to<br />select image to upload</button>
			</div>
			<div class="col-xs-4">
			  <div class="notice">IMPORTANT: Files must be JPEG and no more than 1920 pixels wide or 1080 pixels high.</div>
			</div>

		</div>
		<div class="row" style="padding-top:10px;">
			<div class="col-xs-2" style="padding-top:30px; text-align: right;">
				<div>Title:</div>
			</div>
			<div class="col-xs-8">
			  &nbsp;<input class="form-control" type=text id="photoTitle"	placeholder="Image title ..."/>
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
			  <button id="upload_entry_btn" class="btn btn-large btn-primary"  >Upload</button>
			</div>
		</div><!-- row end -->

		<div class="row" style="padding-top:10px;">
			<div class="col-xs-10">
			  <div id="progressOuter" class="progress progress-striped active" style="display:none;">
			    <div id="progressBar" class="progress-bar progress-bar-success"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
			  </div>
			</div>
		</div><!-- row end -->
	</div>
<div id="msgBox"></div>
</div>
<h3>Photo entries</h3>



	<div id="entries"></div>

	<p>PLEASE ADDRESS ENTRIES TO</p>
	<p>Warragul Camera Club 42nd National Photographic Exhibition<br />
	P.O. Box 436, Warragul. Vic.  3820<br />
	<p>OR DELIVERED TO<br />
	Roylaines P/L 16 Smith Street,<br />Warragul. Vic. 3820.</p>
	<hr>

	<p>ENTRY FEES<br />
	First section: $14.00<br />
	Additional sections: $10.00 each<br />
	</p>
	<hr>

	<div class="row">
		<div class="col-xs-12">RETURN INSTRUCTIONS</div>
		<div class="col-xs-12">
			<select class="form-control" name="return_instructions" id="return_instructions">
			<option value="">Select option ...</option>
			<option value="">No Return Required (default)</option>
			<option>Return by Post (typically $20)</option>
			<option>Pickup Roylaines - Warragul</option>
			<option>Pickup Roylaines - Pakenham</option>
			<option>Forward to Pakenham National</option>
			</select>
		</div>
	</div>
	<hr>

	<p>RETURN POSTAGE</p>
	Return postage for prints only - enter an amount sufficient to cover return:
	<div class="input-group">
	<div class="input-group-addon">$</div><input type=text id="return_postage" class="form-control" style="width:5em" /></div>
	<hr>
	<p>TOTAL COST OF ENTRY<br />
	<div id="total_cost">0.00</div>

	<?php // include 'payment_details.php';?>

	<hr>

	<p>Once you have completed the application form, click on the button below to submit your application</p>
	<p>Note: An application confirmation email will be sent to the email address provided: <?php //echo $user['email'] ?>. </p>
	<h3>Be sure to check your junk folder if you don't see our confirmation email in your in-box!</h3>
	<button id="final_submit_button" class="btn btn-primary">Submit Application</button>
	<p>&nbsp;</p>
</div><!-- container end -->

