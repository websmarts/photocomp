@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

			<h1>Admin Dashboard</h1>
			<hr>
			<h3>Setup</h3>
			<p><a href="{{ route('admin.settings') }}">Edit Competition Settings</a></p>
			<p><a href="{{ route('admin.clubs') }}">Edit list of VAPS Clubs</a></p>
			<p><a href="{{ route('admin.category.form') }}">Edit Competition Categories</a></p>
			<p><a href="{{ route('admin.credentials.form') }}">Change the Administrator</a></p>
			<hr>

			<h3>Applications ({{ $applicationCount }})</h3>
			<p><a href="{{ route('admin.applications') }}">List Entrant Applications</a></p>
			<p><a href="{{ route('admin.messaging') }}">Message (email) Applicants</a></p>
			<hr>
			<h3>Export Photos ({{ $photoCount }})</h3>
			<p>The export photos option will save a copy of all uploaded photos to the S3 Bucket. They will be exported with a customised filename in the form of:<br />


			{section_number}_{section_entry_number}_{application_number}_{entrant_firstname entrant_lastname}.jpg</p>
			<p>The exporting process runs in the background and the time taken to complete the export will depend on the number of photos the process is exporting - it may take a few minutes so make a cup of coffee before trying to download images from the S3 Bucket with your S3 client.</p>
			<p style="padding:15px; background:#f55; color: white">NOTE: The export process first deletes the export folder and all photos currently stored in the S3 Bucket

			<p><a href="{{ route('admin.export.photos') }}">Export Photos to S3 Bucket</a></p>

			@if($settings->competition_status == 'Closed')
			<hr>
			<h3>Master Reset</h3>
			<div style="padding:15px; background:#f55; color: white">
				<p>BE WARNED - Doing a MASTER RESET will delete:</p>
				<ul>
					<li>All users - except the admin user</li>
					<li>All photos and application details</li>
				</ul>
			</div>
			<p>The MASTER RESET is intended to be run well after the competition has finished and no one will need access to any competition data or photos anymore.</p>
			<p><a href="{{ route('admin.master.reset') }}">Master Reset Button!!!</a></p>
			@endif

		</div>
	</div>
</div>

@endsection
