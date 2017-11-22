@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h3> Display steps and status</h3>
                    <p><a href="{{ route('show_application_form') }}" >Registration form </a>
                        @if(Auth::user()->application->registration_status)
                            (completed)
                        @else
                            (NOT completed)
                        @endif
                    </p>

                    <p><a href="{{ route('entries_upload_form') }}">Entry form</a> (in progress)</p>


                    <p>Application submitted (no)</p>

                    @can('admin')
                    I can admin
                    @endcan



                </div>
            </div>
        </div>
    </div>
</div>
@endsection
