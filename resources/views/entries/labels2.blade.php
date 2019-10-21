
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
        color: black; font-size:10pt; font-weight: normal;
     }
     p.standout {
        color: black; font-size:14pt; font-weight: bold;
     }

    
    </style>
</head>
<body style="font-family:arial">

@php
 $entrantID = $user->id + 1000;
 $section = 0;
 $counter = 0;

 $labelCounter = 0;
 $cellCounter  =0;
 $rowCounter = 0; 
@endphp

<p style="font-size:140%; font-weight: bold; text-align: center">PRINT THE LABELS, CUT THEM ALONG THE LINES AND ATTACH SECURELY TO THE BACK OF EACH OF YOUR PRINTS</p>
<div style="text-align: center">Many entrants use AVERY one-up labels and cut the sheet after printing.</div>
<div style="color:red; font-weight: bold; text-align: center">Fix to back of the mat at the BOTTOM LEFT corner.</div>
<p style="color:blue; font-weight: bold; text-align: center">When printing these labels, <u>DO NOT SCALE - DO NOT FIT TO SIZE</u> - Print only at 100% size</p>

<p style="color:red; font-weight: bold; text-decoration: underline;  text-align: center">IF YOU DO NOT USE THESE LABELS, YOUR PRINTS WILL NOT BE JUDGED</p>



<table border=1 style="width: 100%">
<tr>

@foreach($prints as $print)

    @php

        if($section != $print->section_id) {
            $counter = 0;
            $section = $print->section_id;
        }
        $counter++;
    @endphp			
    <td width="50%">
        
        <p class="standout">{{ $entrantID }}</p>
        <p class="normal">{{ $settings->title }} </p>
        
        <p class="normal">{{ $user->application->fullName }}</p>
        <p class="normal">{{ $user->email }}</p>

        <p  class="standout">{{ $print->section_id }}: {{ $print->section->name}}</p>	
        <p class="normal">Print {{ $counter }} of {{ $prints->where('section_id', $print->section_id)->count() }} </p>

        <p class="imagetitle">{{ $print->title }}</p>
        <table width="100%">
            <tr class="boxed">
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td style="border:3px solid #000">&nbsp;</td>
            </tr>
        </table>
        
    </td>  
    @php
    $cellCounter++
    @endphp
   
    @if($cellCounter ==  2 )
    </tr>
    @endif

    @if($cellCounter == 2 && $rowCounter ==1)
        </table>
        <div class="page-break"></div>
        <table border=1 style="width: 100%">
            <tr>
    @elseif($cellCounter == 2 && $rowCounter ==0)
     <tr>

    @endif

   
    @php
    if ($cellCounter == 2 ){
        $cellCounter = 0;
        $rowCounter++;

    }

    if($rowCounter > 1){
        $rowCounter = 0;
    }
    @endphp
    
@endforeach

@if($cellCounter == 1)
<td>-</td></tr></table>
@endif

</body>
</html>
