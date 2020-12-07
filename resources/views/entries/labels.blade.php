
<html lang="en">
<head>
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Your Competition Entry Details</title>


    <style>
    .page-break {
        page-break-after: always;
    }
    td {
        padding: 5px;
		border: 1px solid #000;
    }
     td p {
         padding:4px;
         margin:0;
     }
     tr.boxed td {
         border:1px solid #000000;
         height: 60px;
     }
     p.imagetitle {
        color: red; font-size:12pt; font-weight: bold;border-top: 1px dashed black; text-align: center;
     }
     p.normal {
        color: black; font-size:10pt; font-weight: normal; text-align: center;
     }
	 .larger {
		font-size:16pt;
		padding:.5em;
		font-weight: bold;
	 }
     p.standout {
        color: black; font-size:14pt; font-weight: bold;
     }
	 

    
    </style>
</head>
<body style="font-family:Arial, Helvetica, sans-serif; font-size:10pt">

@php
 $entrantID = $user->id + 1000;
 $section = 0;
 $counter = 0;

 $labelCounter = 0;
 $cellCounter  =0;
 $rowCounter = 0; 
@endphp






@foreach($prints->chunk(4)  as $chunk)

<p class="normal">Please use these labels with your prints.<br />
Uniform identifying labels on Prints will help the Print Stewards immensely.</p>
<p style="font-size:14pt; font-weight: normal; text-align: center">PRINT THE LABELS, CUT THEM ALONG THE LINES AND<br><span style="font-weight:bold">
 ATTACH SECURELY TO THE BACK OF EACH OF YOUR PRINTS

ON THE BOTTOM LEFT CORNER</span></p>
<div style="text-align: center">Many entrants use AVERY one-up labels and cut the sheet after printing.</div>

<p style="color:blue; font-weight: bold; text-align: center">When printing these labels, <u>DO NOT SCALE - DO NOT FIT TO SIZE</u> - Print only at 100% size</p>



	<table  style="width: 100%" cellspacing="10">

	@foreach($chunk->chunk(2) as $items)
	 	<tr>

		@foreach($items as $print)

			@php

				if($section != $print->section_id) {
					$counter = 0;
					$section = $print->section_id;
				}
				$counter++;
			@endphp	

			<td width="50%" >
				
				<p class="larger">{{ $entrantID }}</p>
				<!-- <p class="larger">{{-- $settings->title --}} </p> -->

				
				<p class="larger uppercase">{{ strtoupper($user->application->lastname) }}, {{ strtoupper($user->application->firstname) }}</p>

				<p class="larger">{{ $print->title }}</p>
				<!-- <p class="larger">{{-- $user->email --}}</p> -->

				<p  class="larger">{{ $print->section_id }}: {{ $print->section->name}}</p>	
				<p class="larger">Print {{ $print->section_entry_number + 1 }} of {{ $prints->where('section_id', $print->section_id)->count() }} </p>

				
				<table width="100%">
					<tr class="boxed">
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td style="border:3px solid #000">&nbsp;</td>
					</tr>
				</table>
				
			</td>  

			@if($items->count() == 1)
			<td width="50%" >&nbsp;</td>
			@endif
			
		
			
		@endforeach
		</tr>
	@endforeach 
	</table>

	@if(!$loop->last)
		<div class="page-break"></div>
	@endif
@endforeach


</body>
</html>
