@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>Entrant registration form<h2></div>

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
