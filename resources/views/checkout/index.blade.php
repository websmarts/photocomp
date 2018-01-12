@extends('layouts.app');

@section('content')
<div class="container" >
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
        	@include('layouts.partials.back_to_dashboard_link')

			<h1>Make payment</h1>


			<h3 style="margin-top:20px">Using PayPal</h3>

			<h4>Click the button below to make your payment using the secure PayPal payment gateway. You will be offered options to pay via major credit or debit cards or from your PayPal account if you have one.</h4>
			<div style="margin-bottom: 80px"> <a class="btn btn-primary" href="{{ route('checkout.using',['method'=>'paypal']) }}">Secure PayPal payment gateway</a></div>




			<!--<h3 style="margin-top:60px">Payment Method - Option 2</h3>
			<h4>Pay by direct debit</h4>
			<div>If you would like to pay by making a direct debit to the Warragul National bank account - <a href="{{ route('checkout.using',['method'=>'direct_debit']) }}">click here</a></div>-->






		</div>
	</div>
</div>

@endsection
