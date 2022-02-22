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

<div style="text-align:center; margin:0 auto">
<div style="width:800px;text-align:left;margin:0 auto">

<table width="400" >
	<tr>
		<td width="30%" valign="top">Entrant #1203</td>
		<td width="70%">
		Mr David Woodcock<br>
		215 Fraser Spur Road<br>
		Neerim East VIC 3831<br>
		</td>
	</tr>
</table>
<p> 
	<br>

Dear David,<br><br>


{!! nl2br($settings->result_report_main_text_block) !!}
</p>

<p>Please find your results below</p>
</div>
</div>
{{-- dump($results) --}}
{{-- dump($settings) --}}
{{-- dump($sections) --}}







</body>
</html>
