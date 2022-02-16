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


<p> 
 

{!! nl2br($settings->result_report_main_text_block) !!}
</p>

<p>Please find your results below</p>

{{-- dump($results) --}}
{{-- dump($settings) --}}
{{-- dump($sections) --}}







</body>
</html>
