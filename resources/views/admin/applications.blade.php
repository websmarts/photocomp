@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

        	@include('layouts.partials.back_to_admin_dashboard_link')

			<h1>List of Applications</h1>

			{{ dump($applications->toArray()) }}


		</div>
	</div>
</div>

@endsection
