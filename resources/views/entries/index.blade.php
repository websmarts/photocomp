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
    var flagfall_cost = parseFloat({{ $settings->flagfall_cost }});
    var print_section_cost = parseFloat({{ $settings->print_section_cost }});
    var digital_section_cost = parseFloat({{ $settings->digital_section_cost }});
    var max_entries_per_section = parseInt({{ $settings->max_entries_per_section }});


    // var first_section_cost = parseFloat({{ $settings->first_section_cost }});
    // var additional_section_cost = parseFloat({{ $settings->additional_section_cost }});
    var digital_only_entry_surcharge = parseFloat({{ $settings->digital_only_entry_surcharge }});
    var application_return_postage = parseInt({{ $application->return_postage or 0 }});
    var return_instructions = "{{ $application->return_post_option }}";
    var $apiToken = "{{ Auth::user()->api_token }}";
    var user_application = @json(Auth::user()->application);
</script>

<script type="text/javascript" src="{{ mix('js/entries_form.js') }}>"></script>


@endsection
