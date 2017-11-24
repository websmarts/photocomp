@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @include('layouts.partials.back_to_dashboard_link')

            <div class="panel panel-default">
                <div class="panel-heading">Registration details</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @can('admin')
                    I can admin
                    @endcan

                    @include('registration.partials.registration_form')

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
