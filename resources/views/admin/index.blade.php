@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

			<h1>Admin Dashboard</h1>

			<p><a href="{{ route('admin.settings') }}">Edit Competition Settings</a></p>
			<p><a href="{{ route('admin.clubs') }}">Edit list of VAPS Clubs</a></p>
			<p><a href="{{ route('admin.applications') }}">List Entrant Applications</a></p>

		</div>
	</div>
</div>

@endsection
