@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

        	@include('layouts.partials.back_to_admin_dashboard_link')

			<h1>List of Accounts</h1>
			{{-- dump ($accounts->first())  --}}

			@if( $accounts->count())
			<table class="table table-stiped">
				<tr>
					
					<th>Email address</th>
					<th>Email<br>verified</th>
                    <th>Application <br>form completed</th>
					<th>Account<br>created</th>
					

					<th>&nbsp;</th>
				</tr>

                @foreach($accounts->where('confirm_terms',0) as $a)

                
                <tr>
            
                    
                    <td>{{ $a->email }}</td>
                    <td>{{ $a->verified ? 'yes' : 'no' }}</td>
                    <td>{{ $a->application ? $a->application->completed ? 'yes' : 'no' : 'no' }}</td>
                    <td>{{ $a->created_at->format('d-m-Y') }}</td>
                    <td><a href="{{ route('admin.account.edit',['id'=>$a->id]) }}" >edit</a></td>
                </tr>


                @endforeach

                @foreach($accounts->where('confirm_terms',1) as $a)

               
                    <tr style="background:pink">
                
               
                    
                    <td>{{ $a->email }}</td>
                    <td>{{ $a->verified ? 'yes' : 'no' }}</td>
                    <td>{{ $a->application ? $a->application->completed ? 'yes' : 'no' : 'no' }}</td>
                    <td>{{ $a->created_at->format('d-m-Y') }}</td>
                    <td><a href="{{ route('admin.account.edit',['id'=>$a->id]) }}" >edit</a></td>
                </tr>


                @endforeach
				
			</table>

			@else
			<p>No Accounts to List</p>
			@endif




		</div>
	</div>
</div>

@endsection
