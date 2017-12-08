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

                   <p style="background:#f00; color: #eee;padding:15px">If you do not see the confirmation email in your inbox in the next few minutes then be sure to check your SPAM folder. <br />If you have the option, you could instruct your email system that emails being sent from admin@warragulnational.org are NOT spam.</p>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
