@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

			@include('layouts.partials.back_to_admin_dashboard_link')

			<h1>Emails have been queued for delivery for {{ $entrants }} entrants with a total of {{ $certificates }} attached.</h1>
		</div>
	</div>
</div>

@endsection
