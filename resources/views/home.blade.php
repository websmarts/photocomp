use Illuminate\Support\Facades\Auth;
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        {{-- dump($application) --}}
        {{-- dump($application->completed) --}}
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Entrant Dashboard</h3>
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
                            @if(!$application->completed )
                             <a href="{{ route('show_application_form') }}" >Complete the Application Form</a>
                             @else
                             Complete the Application Form<br/>
                            
                            @endif


                        </div>
                        <div class="col-sm-6">
                            <p>
                                @if( $application->completed )
                                    Application Form has been completed<br />
                                    <!--<a href="{{ route('show_application_form') }}" >Edit Application Form</a>-->
                                @else
                                    Application Form has NOT been completed
                                @endif
                            </p>
                        </div>
                        <div class="col-sm-2"><span class="icon glyphicon {{ $application->completed ? 'glyphicon-ok' : 'glyphicon-remove' }}"></span></div>
                    </div>

                    <div class="row" >
                        <div class="col-sm-4">Step 2:<br />
                            @if($application->completed && !$application->submitted)
                            <a href="{{ route('entries_upload_form') }}">Complete the Entry Form</a>
                            
                            @else
                            Complete the Entry Form
                            
                            @endif

                        </div>
                        <div class="col-sm-6">
                            <p>


                               @if($application->completed)
                                    @if($application->submitted )
                                        Entry form has been completed<br />
                                        
                                            <a href="{{ route('entries_upload_form') }}">View entries</a><br>
                                            <a href="{{ route('edit_entries') }}" >Edit  entries</a><br>
                                            <a href="{{ url('labelpdf') }}" >Print entry labels pdf</a>
                                    
                                    @else
                                        Entry Form has NOT been completed
                                    @endif

                                @else
                                    Please complete Step 1 before Step 2<br />
                                @endif
                            </p>
                        </div>
                        <div class="col-sm-2"><span class="icon glyphicon {{ $application->submitted ? 'glyphicon-ok' : 'glyphicon-remove' }}"></span></div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">Step 3<br />
                            @if($application->submitted && ! $application->paid )
                                <a href="{{ route('checkout') }}">Pay entry fee</a>
                            @elseif($application->paid)
                                Pay entry fee (Entry fee has been paid)
                            @else
                                Pay the entry fee
                            @endif



                        </div>
                        <div class="col-sm-6">
                            <div>
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
                                    @if($application->submitted)
                                        <p>The fee for your current entries will be ${{ number_format($application->entries_cost + $application->return_postage,2) }}</p>
                                        @if($application->payment_method == 'direct_debit')
                                        <p>You have indicated you will be paying the entry fee by <strong>Direct Debit</strong>.</p>

                                        @endif

                                        @if($application->payment_method == 'paypal')
                                        <p>You have indicated you will be paying the entry fee via <strong>Paypal</strong>. </p>
                                        @endif

                                        @if($application->payment_method)
                                        <p>Once your payment has been received your entry will be updated and the payment details will be displayed here.</p>

                                        @endif
                                    @else
                                       <p>Complete Step 1 and Step 2 before making payment</p>
                                    @endif
                                @endif

                            </div>
                        </div>
                        <div class="col-sm-2"><span class="icon glyphicon {{ $application->paid ? 'glyphicon-ok' : 'glyphicon-remove' }}"></span></div>
                    </div>



                </div>
            </div>
        </div>
    </div>
</div>
@endsection
