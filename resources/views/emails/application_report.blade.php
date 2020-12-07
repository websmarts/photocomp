<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Your Competition Entry Details</title>
</head>
<body style="font-family:arial">

<p style="font-size:140%; font-weight: bold">Warragul National Photo Competition Entry Report</p>


@if($user->application->txn_id > ' ' )


<p>&nbsp;</p>
<p style="font-size:130%;"><u>To help the Print Entry Stewards,</u> <strong>please print out a copy of this email and include it with any prints submitted.</strong></p>
<p>&nbsp;</p>
<p style="font-size:120%; font-weight: bold">Entrant number: {{ $user->id +1000 }} </p>

	@if($user->prints->count())
        <div class="row">
            <div class="col-md-8 col-md-offset-2 text-right">
			<p>If you have print entries, please use the labels in the attached PDF with your prints.<br />
Uniform identifying labels on Prints will help the Print Stewards immensely.</p>
			
			<p style="font-size:140%; font-weight: bold; text-align: center">PRINT THE LABELS, CUT THEM ALONG THE 
			LINES AND<br>ATTACH SECURELY TO THE BACK OF EACH OF YOUR PRINTS ON THE BOTTOM LEFT CORNER</p>
			
			<p style=" text-align: center">Many entrants use AVERY one-up labels and cut the sheet after printing.</p>
			<p style="color:blue; font-weight: bold; text-align: center">When printing these labels, <u>DO NOT SCALE - DO NOT FIT TO SIZE</u> - Print only at 100% size</p>


            </div>
        </div>
    @endif

@endif


<p>Payment status:
@if($user->application->txn_id > ' ' )
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
Return option selected: {{ $application->return_post_option or ' - '}} <br>
Return group entered: {{ $application->return_group or ' - '}}</p>
<p>Cost of entries ($): {{ number_format($application->entries_cost,2) }}</p>
<p>Total cost ($):{{ number_format(($application->entries_cost + $application->return_postage),2) }}

<!--<p>You may log back into your account at any stage during the competition to review you entry details. </p>-->

@if(!$user->application->txn_id )
<p>You can pay for your entry fee using one of the options provided on the competition web site - http://photocomp.warragulnational.org </p>
@endif

<p>PLEASE ADDRESS ENTRIES TO</p>
<p>{{ $settings->title }}<br />
P.O. Box 436, Warragul. Vic.  3820<br />
OR DELIVER TO<br />
Roylaines P/L 16 Smith Street,<br />Warragul. Vic. 3820.<br />
or<br />
	Roylaines P/L 148 Main Street,<br />Pakenham. Vic. 3810.<br />
or<br />
Digital Works,<br />Unit 2/34-36 Melverton Drive,<br />Hallam. Vic. 3803.	
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
			<p style="text-decoration: underline">{{ $category->name }} - {{ $section->name }} | Section({{ $section->id }})</p>
			<table>

				@foreach($photos as $photo)
				<tr>
					<td>{{ $photo->section_entry_number + 1 }}</td>
					<td><img src="{{ $message->embed(storage_path('app/public/photos/').$photo->filepath)  }}"></td>
					<td>{{ $photo->title }}</td>
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
