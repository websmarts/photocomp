@extends('layouts.app');

@section('content')
<div class="container" >
	{{ dump($application) }}
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
			<h1>Paypal Checkout</h1>

		<form target="_self" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">

		<input type="text" name="upload" value="1"><br>

		<input type="text" name="cmd" value="_cart"><br>
		<input type="text" name="business" value="enquiries-facilitator@warragulnational.org"><br>

		<input type="text" name="item_name_1" value="Entry fee"><br>
		<input type="text" name="quantity_1" value="1"><br>
		<input type="text" name="amount_1" value="{{ $application->entries_cost }}"><br>

		<input type="text" name="item_name_2" value="Return handling fee"><br>
		<input type="text" name="quantity_2" value="1"><br>
		<input type="text" name="amount_2" value="{{ $application->return_postage }}"><br>



		<input type="text" name="currency_code" value="AUD"><br>

		<!-- a custome tracking var -->
		<input type="text" name="custom" value="{{ $application->user_id }}"><br>

		<input type="text" name="image_url" value="http://photocomp.warragulnational.org/images/logo.jpg"><br>

		<input type="text" name="cancel_return" value="{{ env('PAYPAL_CANCEL_URL') }}"><br>
		<input type="text" name="return" value="{{ env('PAYPAL_SUCCESS_URL') }}"><br>
		<input type="text" name="notify_url" value="{{ env('PAYPAL_NOTIFY_URL') }}"><br>
		<input type="text" name="rm" value="2"><br>

		<input type="text" name="address1" value="{{ $application->address1 }}"><br>
		<input type="text" name="address2" value="{{ $application->address2 }}"><br>
		<input type="text" name="city" value="{{ $application->city }}"><br>
		<input type="text" name="state" value="{{ $application->state }}"><br>
		<input type="text" name="country" value="AU"><br>
		<input type="text" name="zip" value="{{ $application->postcode }}"><br>
		<input type="text" name="first_name" value="{{ $application->firstname }}"><br>
		<input type="text" name="last_name" value="{{ $application->lastname }}"><br>
		<input type="text" name="email" value="{{ Auth::user()->email }}"><br>


<!-- 4239538223886700 12/22 -->
		<!--<input type="text" name="image_url" value="150px">-->


		<input type="submit" name="Pay now">

		<img src="https://www.paypalobjects.com/webstatic/en_US/i/buttons/cc-badges-ppmcvdam.png" alt="Credit Card Badges">
		</form>

		</div>
	</div>
</div>

@endsection
