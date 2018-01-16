@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                   <h3>Thank you for registering an account. </h3>

                   <p>You have been sent an email with instructions on how to verify and activate your new account.</p>

                   <p style="background:#ccf; color: #333;padding:15px">If you do not see the confirmation email in your inbox in the next few minutes then be sure to check your SPAM folder. <br />If you have the option, you could instruct your email system that emails being sent to you from {{ config('mail.from.address') }} are NOT spam.<br />
                   <br />

                   If, after two hours, you fail to receive your confirmation email you can <a href="mailto:warr.nat.entries@outlook.com">contact the competition administrator</a> to request a manual confirmation of your email.

                   </p>



                </div>
            </div>
        </div>
    </div>
</div>
@endsection
