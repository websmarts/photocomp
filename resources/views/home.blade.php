@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Dashboard</h3>
                    @if($application->completed)
                        {{ $application->fullname }}
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
                            @if($application->completed )
                                Edit your registration form
                            @else
                                Fill out your registration form
                            @endif
                           </a>

                        </div>
                        <div class="col-sm-6">
                            <p>
                                @if( $application->completed )
                                    (Registration form is complete)
                                @else
                                    (NOT complete)
                                @endif
                            </p>
                        </div>
                        <div class="col-sm-2"><span class="icon glyphicon {{ $application->completed ? 'glyphicon-ok' : 'glyphicon-remove' }}"></span></div>
                    </div>

                    <div class="row" >
                        <div class="col-sm-4">Step 2:<br />

                            {!! linkRouteIf(' Upload photos and complete return instructions','entries_upload_form',!$application->submitted ) !!}

                        </div>
                        <div class="col-sm-6">
                            <p>
                               @if($application->submitted )
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
                            @if($application->submitted &&  ! $application->paid )
                                <a href="{{ route('checkout') }}">Pay entry fee</a>
                            @elseif($application->paid)
                                Pay entry fee (Entry fee has been paid)
                            @else
                                Pay entry fee
                            @endif



                        </div>
                        <div class="col-sm-6">
                            <p>
                                @if($application->paid)
                                    <table>
                                        <tr>
                                            <td>Payment Method:&nbsp;</td>
                                            <td>{{ ucWords(strtolower($application->payment_method)) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Payment date:&nbsp;</td>
                                            <td>{{ $application->payment_date }}</td>
                                        </tr>
                                        <tr>
                                            <td>Payment amount:&nbsp;</td>
                                            <td>${{ number_format($application->mc_gross,2) }}</td>
                                        </tr>

                                    </table>
                                @else
                                    No checkout details available as yet
                                @endif

                            </p>
                        </div>
                        <div class="col-sm-2"><span class="icon glyphicon {{ $application->paid ? 'glyphicon-ok' : 'glyphicon-remove' }}"></span></div>
                    </div>



                </div>
            </div>
        </div>
    </div>
</div>
@endsection
