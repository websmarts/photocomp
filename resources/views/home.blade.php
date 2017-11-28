@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard:
                    @if(Auth::user()->application->completed )
                        {{ Auth::user()->application->fullname }}
                    @else
                        {{ Auth::user()->email }}
                    @endif

                </div>

                <div class="panel-body dashboard">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>The section below lists the current status of your entry</p>
                    <div class="row" >
                        <div class="col-md-4">Step 1<br /><a href="{{ route('show_application_form') }}" >Fill out the registration form </a></div>
                        <div class="col-md-6">
                            <p>
                                @if(Auth::user()->application->completed )
                                    (Completed)
                                @else
                                    (NOT completed)
                                @endif
                            </p>
                        </div>
                        <div class="col-md-2"><span class="icon glyphicon {{Auth::user()->application->completed ? 'glyphicon-ok' : 'glyphicon-remove' }}"></span></div>
                    </div>

                    <div class="row" >
                        <div class="col-md-4">Step 2:<br />

                            {!! linkRouteIf(' Upload photos and fill out return postage preferences','entries_upload_form',!Auth::user()->application->submitted ) !!}

                        </div>
                        <div class="col-md-6">
                            <p>
                               @if(Auth::user()->application->submitted )
                                    (Completed)<br />
                                    You can <a href="{{ route('entries_upload_form') }}">view your entry details</a> but you cannot make changes after you have submitted the entry
                                @else
                                    (Work in progres)<br />
                                    View and edit your entry details
                                @endif
                            </p>
                        </div>
                        <div class="col-md-2"><span class="icon glyphicon {{Auth::user()->application->submitted ? 'glyphicon-ok' : 'glyphicon-remove' }}"></span></div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">Step 3<br />
                            @if(Auth::user()->application->submitted)
                                <a href="{{ route('checkout') }}">Checkout and pay your entry fee</a>
                            @else
                                Checkout and pay your entry fee
                            @endif



                        </div>
                        <div class="col-md-6">
                            <p>
                                @if(Auth::user()->application->paid)
                                    List the date , payment method , the amount and the return option selected
                                @else
                                    No checkout details available as yet
                                @endif

                            </p>
                        </div>
                        <div class="col-md-2"><span class="icon glyphicon {{Auth::user()->application->paid ? 'glyphicon-ok' : 'glyphicon-remove' }}"></span></div>
                    </div>



                </div>
            </div>
        </div>
    </div>
</div>
@endsection
