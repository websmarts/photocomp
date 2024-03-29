<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Your Competition Entry Results Report</title>
</head>
<body style="font-family:arial">


<table width="98%">
	<tr>
		<td>
			<p style="font-size:140%; font-weight: bold;text-align: center">{{ $settings->title }}</p>
			<div style="text-align: center">
				{!! nl2br($settings->result_report_top_text_block) !!}
				
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
<p> 
{{ str_repeat('&nbsp;',strlen($results->first()[1]['givennames']) + 6) }} 

{!! nl2br($settings->result_report_main_text_block) !!}
</p>

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



</body>
</html>
