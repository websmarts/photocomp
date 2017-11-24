@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <h1>Welcome to the<br /> {{ $settings->title }}</h1>

            <p>If you would like to enter the competition you will need to first <a href="{{ route('register') }}">register an account</a></p>

            <p>The terms and conditions, including costs can be viewed here</p>

		</div>
	</div>
</div>


@endsection
