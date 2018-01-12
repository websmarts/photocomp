@extends('layouts.app');

@section('content')
<div class="container" >
	{{-- dump($application) --}}
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
        	@include('layouts.partials.back_to_dashboard_link')

			<h1>Make payment via PayPal</h1>
		@if($settings->paypal_mode == 'Sandbox')
			<form target="_self" action="{{ env('PAYPAL_SANDBOX_PAYMENT_URL')}}" method="post">
			<input type="hidden" name="business" value="{{ env('PAYPAL_SANDBOX_ACCOUNT_EMAIL') }}">
		@else
			<form target="_self" action="{{ env('PAYPAL_PAYMENT_URL')}}" method="post">
			<input type="hidden" name="business" value="{{ env('PAYPAL_ACCOUNT_EMAIL') }}">
		@endif

			<input type="hidden" name="upload" value="1">

			<input type="hidden" name="cmd" value="_cart">



			<input type="hidden" name="item_name_1" value="Entry fee">
			<input type="hidden" name="quantity_1" value="1">
			<input type="hidden" name="amount_1" value="{{ $application->entries_cost }}">

			<input type="hidden" name="item_name_2" value="Return handling fee">
			<input type="hidden" name="quantity_2" value="1">
			<input type="hidden" name="amount_2" value="{{ $application->return_postage }}">



			<input type="hidden" name="currency_code" value="AUD">

			<!-- a custome tracking var -->
			<input type="hidden" name="custom" value="{{ $application->user_id }}">

			<input type="hidden" name="image_url" value="http://photocomp.warragulnational.org/images/logo.jpg">

			<input type="hidden" name="cancel_return" value="{{ env('PAYPAL_CANCEL_URL') }}">
			<input type="hidden" name="return" value="{{ env('PAYPAL_SUCCESS_URL') }}">
			<input type="hidden" name="notify_url" value="{{ env('PAYPAL_NOTIFY_URL') }}">
			<input type="hidden" name="rm" value="0">

			<input type="hidden" name="address1" value="{{ $application->address1 }}">
			<input type="hidden" name="address2" value="{{ $application->address2 }}">
			<input type="hidden" name="city" value="{{ $application->city }}">
			<input type="hidden" name="state" value="{{ $application->state }}">
			<input type="hidden" name="country" value="AU">
			<input type="hidden" name="zip" value="{{ $application->postcode }}">
			<input type="hidden" name="first_name" value="{{ $application->firstname }}">
			<input type="hidden" name="last_name" value="{{ $application->lastname }}">
			<input type="hidden" name="email" value="{{ Auth::user()->email }}">


<!-- 4239538223886700 12/22 -->
		<!--<input type="hidden" name="image_url" value="150px">-->

			<p>The cost for your competition entry is ${{ number_format($application->entries_cost + $application->return_postage,2) }}</p>
			<p>Click the button below to make your payment using the secure PayPal payment gateway. You will be offered options to pay via major credit or debit cards or from your PayPal account if you have one.</p><br />


			<input type="submit" name="Pay now" value="Make payment via PayPal">
			<p>&nbsp;</p>

			<p><img src="https://www.paypalobjects.com/webstatic/en_US/i/buttons/cc-badges-ppmcvdam.png" alt="Credit Card Badges"></p>
			</form>

		</div>
	</div>
</div>

@endsection
