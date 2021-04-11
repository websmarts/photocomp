<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Your Competition Entry Results Report</title>
</head>
<body style="font-family:arial">


<table width="98%">
	<tr>
		<td width="400"><img src="{{ $message->embed(public_path('images/email_image.jpg')) }}">
		<br>APS Approval Number 2021/05</td>
		<td>
			<p style="font-size:140%; font-weight: bold;text-align: center">{{ $settings->title }}</p>
			<div style="text-align: center">
				West Gippsland Arts Centre<br />
				63 Smith Street, Warragul VIC<br />
				Friday 14th to Sunday 16th May<br />
				10:00am 4:00pm<br />
				Award Presentations<br />
				Sunday 16th May 2:00pm
				
				&nbsp;
			</div>
		</td>
	</tr>
</table>
<div style="margin-top:20px; margin-bottom: 20px">&nbsp;</div>

<table>
	<tr><td width="100" valign="top">Entrant #<br />{{ $results->first()[1]['competitorno'] }}</td>
		<td>{{ $results->first()[1]['salutation'] }} {{ $results->first()[1]['givennames'] }} {{ $results->first()[1]['surname'] }}<br />
			{{ $results->first()[1]['street1'] }} {{ $results->first()[1]['street2'] }} <br />
			{{ $results->first()[1]['city'] }} {{ $results->first()[1]['state'] }} {{ $results->first()[1]['postalcode'] }}<br />
		</td></tr>
</table>

<p> Dear {{ $results->first()[1]['givennames'] }},</p>
<p> {{ str_repeat('&nbsp;',strlen($results->first()[1]['givennames']) + 6) }} Hello and 
	thank you for your hard work, dedication and effort in entering our {{ $settings->title }}.</p>


<p>Your images were among 1123 images submitted by 110 entrants for judging this year.
Your score is derived by three judges each giving points out of five, 
therefore making the lowest score achievable being 3 
and the highest score achievable being 15. Acceptance levels were 31 percent across Print sections and 32 percent across the Digital sections.</p>

<p>Please find your results below</p>

{{-- dump($results) --}}
{{-- dump($settings) --}}
{{-- dump($sections) --}}


<table width="95%">
	<tr>
			<th width="40">&nbsp;</th>
			<th align="right">Judge&nbsp;: &nbsp;</th>
			<th align="left" width="40">1</th>
			<th align="left" width="40">2</th>
			<th align="left" width="40">3</th>
			<th align="left" width="70">Total</th>
			<th width="120">&nbsp;</th>
		</tr>

@foreach($results as $result)
  	@foreach($result as $row)
  		@if($loop->first)
			<tr>
				</td>

				<td colspan="7"><div style="padding-bottom:8px; font-weight: bold; border-bottom: 1px solid #000000">Section {{ $row['section'] }}
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					@if( $sections->where('id',$row['section'])->first() )
						{{$row['section']}}::{{ $sections->where('id',$row['section'])->first()->name }} -
						{{ $sections->where('id',$row['section'])->first()->category->name }}
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						Acceptance Level: {{ $row['acceptancelevel'] }}
					@endif
				</div></td>
			</tr>
		@endif


		<tr>
			<td width="20">{{ $row['entryno']}}</td>
			<td >{{ $row['title']}}</td>
			<td width="40">{{ $row['scorejudge1']}}</td>
			<td width="40">{{ $row['scorejudge2']}}</td>
			<td width="40">{{ $row['scorejudge3']}}</td>
			<td width="70">{{ $row['scoretotal']}}</td>
			<td width="120">
			{{ $row['acceptance'] ? '** Acceptance **':'Unsuccessful Entry'}}
			{!! $row['specialawardname'] ? '<br />'.$row['specialawardname'] : '' !!}
			</td>

		</tr>
		@if ($loop->last)
		<tr>
				</td>

				<td colspan="7"><div style="padding:8px; border-bottom: 1px solid #000000">&nbsp;</div></td>
			</tr>

		@endif
	@endforeach
@endforeach
</table>


<p>We cordially invite you to attend the Awards Presentation at 2pm on Sunday 16th May, 2021, 
in the Fountain Room at the West Gippsland Arts Centre, 63 Smith Street, Warragul, Victoria (enter via Civic Place).</p>
<p>Due to covid restrictions, numbers will need to be capped. Please book your place (free) through TryBooking using the following URL:
https://www.trybooking.com/BQHNA</p>

<p>When you make a booking you will be sent tickets so please print the tickets out and bring them with you.</p>

<p>Our exhibition is open Friday 14th to Sunday 16th May from 10am to 4pm daily. We would love to see you and your family and friends at anytime during the weekend.</p>

<p>If you are looking to use acceptances towards APS honours please check the details  carefully and email us of any changes ASAP.</p>

<p>It is always surprising how quickly the year rolls around. January 2022, when entries open for the 49th Warragul National,
 is not that far away. We hope to see your images again next year.</p>

<p>Keep an eye on our website www.warragulnational.org for more details.</p>

<p>Thank you for your support for the 2021 Warragul National.
</p>



<p>&nbsp;</p>
<p>Kind Regards,</p>
<p>Jane Woodcock FAPS EFIAP<br />
Chairman<br />
{{ $settings->title }}</p>




</body>
</html>
