@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <h1>{{ $settings->title }}</h1>

            @if($settings->competition_status == 'Closed')
            <h2>The competion is currently not open</h2>

            @else
            <h2>Welcome</h2>
            <p>If you would like to enter the competition you will need to first <a href="{{ route('register') }}">register an account</a></p>

            <p>The competion terms and conditions can be <a href="{{ $settings->terms_and_conditions_url }}">viewed here</a></p>

            @endif

		</div>
	</div>
</div>


@endsection
