<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Your Competition Entry Results Report</title>
</head>
<body style="font-family:arial">


<table width="98%">
	<tr>
		<td width="400"><img src="{{ $message->embed(storage_path('app/public/email_image.jpg')) }}"></td>
		<td>
			<p style="font-size:140%; font-weight: bold;">{{ $settings->title }}</p>
			Warragul Downtowner<br />
			55-57 Victoria Street, Warragul<br />
			Friday 18th May 10:00am-5:00pm<br />
			Sat 19th May &amp; Sun 20th May 10:00am 4:00pm<br />
			Monday 21st May 10:00am-5:00pm<br />
			Official Opening 2:00pm Sunday May 20th
		</td>
	</tr>
</table>
<div style="margin-top:20px; margin-bottom: 20px">&nbsp;</div>

<table>
	<tr><td width="100" valign="top">Number<br />{{ $results->first()[1]['competitorno'] }}</td>
		<td>{{ $results->first()[1]['salutation'] }} {{ $results->first()[1]['givennames'] }} {{ $results->first()[1]['surname'] }}<br />
			{{ $results->first()[1]['street1'] }} {{ $results->first()[1]['street2'] }} <br />
			{{ $results->first()[1]['city'] }} {{ $results->first()[1]['state'] }} {{ $results->first()[1]['postalcode'] }}<br />
		</td></tr>
</table>

<p> Dear {{ $results->first()[1]['givennames'] }},</p>
<p> {{ str_repeat('&nbsp;',strlen($results->first()[1]['givennames']) + 6) }} Hello and thank you for your hard work, dedication and effort in entering or {{ $settings->title }}.</p>
<p>Your images were among {{ $photoCount}} images in total submitted by {{ $applicationCount }} entrants for judging this year.
Your score is derived by three judges each giving points out of five, therefore making the lowest score achievable being 3 and the highest score achievable being 15. Acceptance levels are determined by approximately the top 33% of the scores in each section.</p>

<p>Please find your results below</p>

{{-- dump($results) --}}
{{-- dump($settings) --}}
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
					@if(isSet($sections[$row['section']]) )
						{{ $sections[$row['section']]->name }} - {{ $sections[$row['section']]->category->name }}
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
			<td width="120">{{ $row['acceptance'] ? '** Acceptance **':'Unsuccessful Entry'}}</td>

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


<p>We are very pleased with the high standard of entries and we would like to thank you for your support of this Exhibition.</p>

<p>We cordially invite you, your family and your friends to attend our Official Opening and awards presentation
on Sunday 20th May, 2017, at The Warragul Downtowner, 55-57 Victoria Street, Warragul, Victoria at 2:00pm.</p>
<p>Our exhibition is open Friday 18th May to Monday 21st May from 10am to 5pm weekdays and 10am to 4pm on the weekend. We would love to see you and your family and friends at anytime during the weekend.</p>
<p>And don't forget to keep taking lots of photos so you are ready for next year's National as it will come around fast. </p>
<p>Keep an eye on our website www.warragulnational.org for more details.</p>
<p>We very much look forward to receiving your entries in 2019.</p>
<p>&nbsp;</p>
<p>Yours in Photography,</p>
<p>Jane Woodcock<br />
Chairman<br />
{{ $settings->title }}</p>




</body>
</html>
