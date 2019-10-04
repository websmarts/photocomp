<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Your Competition Entry Details</title>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">


</head>
<body style="font-family:arial">

<p style="font-size:140%; font-weight: bold; text-align: center">PRINT THE LABELS, CUT THEM ALONG THE LINES AND ATTACH SECURELY TO THE BACK OF EACH OF YOUR PRINTS<br>
Many entrants use AVERY one-up labels and cut the sheet after printing.</p>
<p style="color:red; font-weight: bold; text-align: center">When printing these labels, <u>DO NOT SCALE - DO NOT FIT TO SIZE</u> - Print only at 100% size</p>

<p style="color:blue; font-weight: bold; text-decoration: underline;  text-align: center">IF YOU DO NOT USE THESE LABELS, YOUR PRINTS WILL NOT BE JUDGED</p>

{{-- dump($prints->toArray()) --}}
{{-- dump($settings) --}}

@php
$entrantID = $user->id + 1000;
@endphp

@if($prints->count())


@php
$section = 0;
$counter = 0;
$labelCounter = 0;
@endphp

<div class="row">
  <div class="col-md-6">.col-md-6</div>
  <div class="col-md-6">.col-md-6</div>
  
</div>

<div class="page">

	@foreach($prints as $print)
		
		@php
			if($section != $print->section_id) {
				$counter = 0;
				$section = $print->section_id;
			}
			$counter++;
			$labelCounter++;
		@endphp

		@if($labelCounter % 4 == 0)
			</div> <!-- end page div -->
			<div style="clear: both; border:1px solid green; height:10px"></div>
			<div class="page">
		@endif

			
			
		<div style="border: 1px solid black; font-size: 16pt; width:40%; padding:2%;margin:5px; float:left">

		
			
			<p style="font-size:10pt; font-weight: bold">{{ $entrantID }}</p>
			<p>{{ $settings->title }} </p>
			
			<p>{{ $user->application->fullName }}</p>
			<p>{{ $user->email }}</p>

			<p style="font-size:10pt; font-weight: bold">{{ $print->section_id }}: {{ $print->section->name}}</p>	
			<p>Print {{ $counter }} of {{ $prints->where('section_id', $print->section_id)->count() }} </p>

			<p style="color: red; font-weight: bold;width:100%;float: left; border-top: 1px dashed black; text-align: center;padding:15px">{{ $print->title }}</p>
				
			
		</div>

		@if($counter % 4 == 0)

		<div style="clear: both; border:1px solid red; height:10px"></div>
		@endif


			

		

	@endforeach

@endif

<p>

</body>
</html>
