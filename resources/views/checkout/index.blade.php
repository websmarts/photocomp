@extends('layouts.app');

@section('content')
<div class="container" >
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
        	@include('layouts.partials.back_to_dashboard_link')

			<h1>Select payment option</h1>


			<h2 style="margin-top:60px">Payment Method - Option 1</h2>
			<h3>You can pay online via PayPal where you will have the option to either pay with a credit card or directly from your PayPal account if you have one.</h3>
			<div>If you would like to pay online now via PayPal - <a href="{{ route('checkout.using',['method'=>'paypal']) }}">click here</a></div>




			<h2 style="margin-top:60px">Payment Method - Option 2</h2>
			<h3>Pay by direct debit</h3>
			<div>If you would like to pay by making a direct debit to the Warragul National bank account - <a href="{{ route('checkout.using',['method'=>'direct_debit']) }}">click here</a></div>






		</div>
	</div>
</div>

@endsection
