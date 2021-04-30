
<html lang="en">
<head>
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Acceptance Certificate</title>


    <style>
    
  
    .page-break {
        page-break-after: always;
    }
   
    .certificate {
    
        background-image: url('http://photocomp.test/storage/certificate_background.jpg');
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
        
        border: 1px solid red;
        text-align: center;
    }

    #photo {
        width: 100%;
        border: 1px solid green;
        height: 300px;
        
    }

    #title {
       
        font-size:16pt;
        border: 1px solid green;
        padding:10px;
        
    }

    #entrant {
        border:1px solid blue;
        font-size:16pt;
        padding: 10px;
    }
    #section {
        border: 1px solid black;
        font-size: 16pt;
        padding:10px;
    }
    #result {
        border: 1px solid black;
        font-size: 20pt;
        font-weight: bold;
        padding:10px;
    }


	 

    
    </style>
</head>
<body class="certificate" style=" font-family:Arial, Helvetica, sans-serif; font-size:10pt; ">


<div id="container">

    <div id="photo"><img src="http://photocomp.warragulnational.org/storage/app/photos/{{ $certificate['filepath'] }}" 
        width="{{ $certificate['photo']->width }}" 
        height="{{ $certificate['photo']->height }}" /></div>


    <div id="title">&#8220; {{ $certificate['title'] }}  &#8221;</div>

    <div id="entrant">{{ $certificate['fullname'] }}</div>

    <div id="section">{{ $certificate['section'] }}</div>

    <div id="result">{{ $certificate['award'] }}</div>
</div>


</body>
</html>