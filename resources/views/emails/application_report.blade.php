<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Your Competition Entry Details</title>
</head>
<body style="font-family:arial">

<p style="font-size:140%; font-weight: bold">Warragul National Photo Competition Entry Report</p>
<p>Payment status:
@if($user->application->txn_id > 0 )
Received: ${{ number_format($user->application->mc_gross,2) }}
@else
Payment pending
@endif

</p>
	<p style="font-size:120%">Summary of your entry details</p>
	{{-- dump($settings) --}}
	{{-- dump($categories) --}}
	{{-- dump($user) --}}
	{{-- dump($user->application) --}}
	{{-- dump($user->photos->count()) --}}
@php
$application  = $user->application;
@endphp


<p>Date submitted: {{ $application->updated_at->toFormattedDateString() }}</p>
<p>Name: {{ $application->fullname }} </p>


<p>Honours: {{ $application->honours }}</p>
<p>Address: {{ $application->address1 }} {{ $application->address2 }} {{ $application->city }}
{{ $application->state }} {{ $application->postcode }}  </p>

<p>Phone: {{ $application->phone }}</p>
<p>VAPS Affiliated: {{ $application->vaps_affiliated }} </p>
<p>APS Member: {{ $application->aps_member }} </p>
<p>Club nomination: {{ $application->club_nomination }} <p>
<p>Return postage amount ($): {{ number_format($application->return_postage,2) }}<br>
Return option selected: {{ $application->return_post_option or ' - '}} </p>
<p>Cost of entries ($): {{ number_format($application->entries_cost,2) }}</p>

<p>You may log back into your account at any stage during the competition to review you entry details. </p>

@if(!$user->application->txn_id )
<p>You can pay for your entry fee using one of the options provided on the on the competition web site - http://photocomp.warragulnational.org </p>
@endif

<p>PLEASE ADDRESS ENTRIES TO</p>
<p>{{ $settings->title }}<br />
P.O. Box 436, Warragul. Vic.  3820<br />
<p>OR DELIVER TO<br />
Roylaines P/L 16 Smith Street,<br />Warragul. Vic. 3820.<br />
or<br />
	Roylaines P/L 148 Main Street,<br />Pakenham. Vic. 3810.
</p>

@if($user->photos->count())
<hr>
<p style="font-size: 120%">Photos submitted ({{ $user->photos->count() }}), see below:</p>

	@foreach($categories as $category)
		@foreach($category->sections as $section)

		@php
			$photos = user_section_photos($user,$section);
		@endphp
			@if(count($photos))
			<p style="text-decoration: underline">{{ $category->name }} - {{ $section->name }}</p>
			<table>

				@foreach($photos as $photo)
				<tr>
					<td><img src="{{ $message->embed(storage_path('app/public/photos/').$photo->filepath)  }}"></td><td>{{ $photo->title }}</td>
				</tr>
				@endforeach
			</table>
			@endif

		@endforeach

	@endforeach

@endif

<p>

</body>
</html>
