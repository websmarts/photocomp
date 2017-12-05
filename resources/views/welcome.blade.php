@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <h3>{{ $settings->title }}</h3>

            @if($settings->competition_status == 'Closed')
            <h2>The competion is currently not open</h2>

            @else
            <p>&nbsp;</p>
            <h2>Welcome</h2>
            <hr>
            <p>Maybe some brief background information could be inserted here?</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>If you would like to enter the competition you will need to first <a href="{{ route('register') }}">register an account</a></p>
            <p>&nbsp;</p>

            <p>The competion terms and conditions can be <a href="{{ $settings->terms_and_conditions_url }}">viewed here</a></p>

            @endif

		</div>
	</div>
</div>


@endsection
