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
                        <div class="col-sm-4">Step 1<br />
                             <a href="{{ route('show_application_form') }}" >
                            @if(Auth::user()->application->completed )
                                Edit your registration form
                            @else
                                Fill out your registration form
                            @endif
                           </a>

                        </div>
                        <div class="col-sm-6">
                            <p>
                                @if(Auth::user()->application->completed )
                                    (Registration form is complete)
                                @else
                                    (NOT complete)
                                @endif
                            </p>
                        </div>
                        <div class="col-sm-2"><span class="icon glyphicon {{Auth::user()->application->completed ? 'glyphicon-ok' : 'glyphicon-remove' }}"></span></div>
                    </div>

                    <div class="row" >
                        <div class="col-sm-4">Step 2:<br />

                            {!! linkRouteIf(' Upload photos and complete return instructions','entries_upload_form',!Auth::user()->application->submitted ) !!}

                        </div>
                        <div class="col-sm-6">
                            <p>
                               @if(Auth::user()->application->submitted )
                                    (Completed)<br />
                                    <a href="{{ route('entries_upload_form') }}">View your entries</a>
                                @else
                                    (Work in progres)<br />
                                    View and edit your entry details
                                @endif
                            </p>
                        </div>
                        <div class="col-sm-2"><span class="icon glyphicon {{Auth::user()->application->submitted ? 'glyphicon-ok' : 'glyphicon-remove' }}"></span></div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">Step 3<br />
                            @if(Auth::user()->application->submitted && ! Auth::user()->application->paid)
                                <a href="{{ route('checkout') }}">Pay entry fee</a>
                            @else
                                Pay entry fee
                            @endif



                        </div>
                        <div class="col-sm-6">
                            <p>
                                @if(Auth::user()->application->paid)
                                    List the date , payment method , the amount and the return option selected
                                @else
                                    No checkout details available as yet
                                @endif

                            </p>
                        </div>
                        <div class="col-sm-2"><span class="icon glyphicon {{Auth::user()->application->paid ? 'glyphicon-ok' : 'glyphicon-remove' }}"></span></div>
                    </div>



                </div>
            </div>
        </div>
    </div>
</div>
@endsection
