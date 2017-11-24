@extends('layouts.app')

@section('content')

<form action="https://www.paypal.com/cgi-bin/webscr" method="post">

<input type="hidden" name="upload" value="1">

<input type="hidden" name="cmd" value="_cart">
<input type="hidden" name="business" value="enquiries@warragulnational.org">

<input type="hidden" name="item_name_1" value="Entry fee">
<input type="hidden" name="quantity_1" value="1">
<input type="hidden" name="amount_1" value="25.67">

<input type="hidden" name="shipping" value="19.99">

<input type="hidden" name="currency_code" value="AUD">

<!-- a custome tracking var -->
<input type="hidden" name="custom" value="bettymarsh">

<input type="hidden" name="cancel_return" value="http://photocomp.websmarts.com.au">
<input type="hidden" name="return" value="http://photocomp.websmarts.com.au">
<input type="hidden" name="rm" value="0">
<!--<input type="hidden" name="image_url" value="150px">-->


<input type="submit" name="Pay now">
</form>

@endsection
