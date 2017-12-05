@extends('layouts.app')

@section('content')
<div class="container" >
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @include('layouts.partials.back_to_dashboard_link')
            <div class="panel panel-default">
                <div class="panel-heading"><h4>Competition Entries Form</h4></div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                     <!-- AT include('entries.partials.userinfo')-->
                     <div id="loadingDiv" class="display-none">
                        <div>
                            <h1>Please wait...</h1>
                        </div>
                    </div>
                    @include('entries.partials.form')

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- Cost of entering competition sections -->
<script>
    var first_section_cost = {{ $settings->first_section_cost }};
    var additional_section_cost = {{ $settings->additional_section_cost }};
    var application_return_postage = parseInt({{ $application->return_postage or 0 }});
</script>

<script type="text/javascript" src="{{ mix('js/entries_form.js') }}>"></script>


@endsection
