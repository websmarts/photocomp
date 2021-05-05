
<html lang="en">
<head>
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Acceptance Certificate</title>


    <style>
    
  
    .page-break {
        page-break-after: always;
    }
   
    .certificate {
    
        background-image: url('{{ url("/storage/certificate_background.jpg") }}');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: -23px -20px;
        height:100%;
        
    
    }

    #container {
        position: relative;
        left:40px;
        top: 300px;
        width:602px;
        
        border: 0px solid red;
        text-align: center;
    }

    #photo {
        width: 100%;
        border: 0px solid green;
        height: 300px;
        
    }

    #title {
       
        font-size:16pt;
        border: 0px solid green;
        padding:10px;
        margin-top:30px;
        
    }

    #entrant {
        border: 0px solid blue;
        font-size:16pt;
        padding: 10px;
    }
    #section {
        border: 0px solid black;
        font-size: 16pt;
        padding:10px;
    }
    #result {
        border: 0px solid black;
        font-size: 20pt;
        font-weight: bold;
        padding:10px;
    }


	 

    
    </style>
</head>
<body class="certificate" style=" font-family:Arial, Helvetica, sans-serif; font-size:10pt; ">


<div id="container">

    <div id="photo"><img src="{{ route('admin.acceptance.photo',['filepath'=>$certificate['filepath']]) }}" 
        width="{{ $certificate['photo']->width }}" 
        height="{{ $certificate['photo']->height }}" /></div>


    <div id="title">&#8220; {{ $certificate['title'] }}  &#8221;</div>

    <div id="entrant">{{ $certificate['fullname'] }}</div>

    <div id="section">{{ $certificate['section'] }}</div>

    <div id="result">{{ $certificate['award'] }}</div>
</div>


</body>
</html>