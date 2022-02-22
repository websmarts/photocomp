@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

			@include('layouts.partials.back_to_admin_dashboard_link')

			<h1>Edit Account</h1>
            <h3>for</h3>
            <h3>{{ $account->email }}</h3>
			{{-- dump($account) --}}
            
			
			
			<form method="post" action="{{ route('admin.account.update',['id'=>$account->id]) }}">
			{{ csrf_field() }}

<hr>
            <div class="form-group">
			    <div class="row">
			        <div class="col-xs-12">
			            <label for="new_password" class="control-label">To change the account password enter a new password in the field below.<br /> Leave this field blank to leave the account password unchanged<br></label>
			            <input type="text" class="form-control" id="new_password" placeholder="new password ..." name="new_password" value="" />
			    </div>
			</div>

			

            
            
            @if(!$account->application->completed && $account->is_admin == 'no' )

           
            <hr>
			<div class="form-group">
			    <div class="row">
			        <div class="col-xs-12">
			            <label for="delete_account" class="control-label">Enter DELETE in the field below if you want to remove the account<br>Leave blank if just changing the account password.</label>
			            <input type="text" class="form-control" id="delete_account" placeholder="Action ..." name="delete_account" value="" />
			    </div>
			</div>
            @endif


			<div style="margin-top:40px">
            <button class="btn btn-primary">Update Account</button>
            </div>
			</form>
		</div>
	</div>
</div>

@endsection
