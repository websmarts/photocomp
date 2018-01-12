@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <h3>{{ $settings->title }}</h3>

            @if($settings->competition_status == 'Closed')
            <h2>The competion is currently not open</h2>

            @else
            <p>&nbsp;</p>

            <h3>Procedure for the on-line entry for the Warragul National Photography Competition and Exhibition:</h3>
            <ol>
            <li> Register as a new entrant (Link on top right). You first need to register an email address. An email is then sent to you (please check your junk email folder!) with a link to verify that this is your email. It is important to move any such email to the Inbox before clicking on the link to confirm your email.</li>

            <li> You can then logon using this email as your username and the password you entered in the first step.</li>

            <li> You then enter your personal details including address (necessary for return of catalogues and your print, etc.) and club membership (if any). (Entrant details are not carried forward from the previous year.)</li>

            <li> The next screen allows you to upload images including digital versions of print entries. (The digital copies of print entries are needed for the catalogue.) Use unembellished titles (e.g. <strong>My Winning Image</strong> ).</li>

            <li> Image uploads and their titles are saved automatically. You can leave the entry form at any time and come back to it as many times as you like. You can delete images and replace them with others. (To move an image from one section to another, delete from the original section and upload it again to the other section.)</li>

            <li> To finalize your entry, proceed to the payment page. This employs the secure PayPal payment gateway where you can use major credit or debit cards or your personal PayPal account.</li>

            <li> You will receive another email with a full summary of your entry including thumbnails of your images. (Check your Junk folder!)</li>

            <li> Once payment is received no further changes can be made to your entry.</li>
            </ol>





            @endif

		</div>
	</div>
</div>


@endsection
