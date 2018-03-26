@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

			@include('layouts.partials.back_to_admin_dashboard_link')

			<h1>All ({{ $n }}) messages have now been queued for delivery</h1>
		</div>
	</div>
</div>

@endsection
