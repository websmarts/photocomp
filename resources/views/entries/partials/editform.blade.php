

<div class="no-print" id="upload_form">


	<div style="background: #eee; padding: 5px;" >
		<h3>Image upload form</h3>
		<div class="row" style="padding-top:10px;">
			<div class="col-xs-2" style="padding-top:30px; text-align: right;">
				<div>Image file:</div>
			</div>

			<div class="col-xs-4">
			  <button id="select_file_btn" class="btn btn-large btn-primary btn-block" style="padding:10px" >Click here to<br />select image to upload</button>
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
</div>

<div id="messageContainer" class="alert alert-warning alert-dismissible" >
	<button type="button" id="closeMessageButton" class="close"  aria-label="Close"><span id="close_icon" aria-hidden="true"></span></button>
	<p>&nbsp;</p>
	<div id="msgBox"></div>
</div>

<h3>Entry images</h3>



<div id="entries"></div>
	
	
	



