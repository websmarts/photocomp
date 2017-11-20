@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>Entries Upload Form</h2></div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                     <!-- AT include('entries.partials.userinfo')-->

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
</script>

<script type="text/javascript" src="{{ mix('js/utils.js') }}>"></script>


@endsection
