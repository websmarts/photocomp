@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

        	@include('layouts.partials.back_to_admin_dashboard_link')

			<h1>List of Applications</h1>
			{{-- dump($applications->toArray()) --}}
			<p><a href="{{ route('admin.application.exportcsv') }}">Export Application (csv file)</a></p>

			@if($applications->count())
			<table class="table table-stiped">
				<tr>
					<th>Entrant #</th>
					<th>Name</th>
					<th>Pay via</th>
					<th>Cost</th>
					<th>Paid($)</th>
					<th>Paid (date)</th>

					<th>&nbsp;</th>
				</tr>
				@foreach($applications as $a)
				<tr>
					<td>{{ 1000 + $a->user->id }}</td>
					<td>{{ $a->fullname }}</td>
					<td>{{ $a->payment_method or '-' }}</td>
					<td>${{ number_format($a->entries_cost + $a->return_postage,2) }}</td>
					<td>${{ number_format($a->mc_gross,2) }}</td>
					<td>{{ $a->payment_date or '-' }}</td>

					<td><a href="{{ route('admin.application.edit',['application'=>$a->id]) }}" >edit</a></td>
				</tr>
				@endforeach
			</table>

			@else
			<p>No Applications to List</p>
			@endif




		</div>
	</div>
</div>

@endsection
