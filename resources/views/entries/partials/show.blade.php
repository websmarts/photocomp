@php
$user = Auth::user();
$application  = $user->application;
@endphp
{{-- dump($settings) --}}
{{-- dump($categories) --}}
{{-- dump($user) --}}
{{-- dump($user->application) --}}
{{-- dump($user->photos->count()) --}}
<p style="font-size:140%; font-weight: bold">Warragul National Photo Competition Entry Report</p>
<p>{{ date('j-m-Y')}}</p>

@if($application->paid)
<p>Payment status: Paid</p>
<p>Payment method: {{ $application->payment_method }}</p>
<p>Paid amount ($): {{ number_format($application->mc_gross,2) }}</p>
<p>Payment reveived: {{ $application->payment_date }}</p>
@else
<p>Payment status: Pending payment</p>
<p>
  @if($application->submitted && !$application->payment_method )
    <a href="{{ route('checkout') }}">Pay entry fee</a>
  @else
  Payment method chosen: {{ $application->payment_method }}
  @endif
</p>


@endif
<hr>

<p style="font-size:120%;font-weight:bold">Summary of your entry details</p>



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
<p>Cost of enrties ($): {{ number_format($application->entries_cost,2) }}</p>

<p>You may log back into your account at any stage during the competition to review you entry details. </p>

<p>You can pay for your entry fee by selecting the payment option on the dashboard of the competion web site - http://potocomp.warragulnational.org </p>

<p>PLEASE ADDRESS ENTRIES TO</p>
<p>{{ $settings->title }}<br />
	P.O. Box 436, Warragul. Vic.  3820<br />
	OR DELIVER TO<br />
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
			<table class="table table-striped">

				@foreach($photos as $photo)
				<tr>
					<td width="120"><img src="storage/photos/{{ $photo->filepath  }}"></td><td>{{ $photo->title }}</td>
				</tr>
				@endforeach
			</table>
			@endif

		@endforeach

	@endforeach

@endif

<p>
