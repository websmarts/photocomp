@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

			@include('layouts.partials.back_to_admin_dashboard_link')

			<h1>Edit Categories</h1>

			<p>Note: Do not edit if competition entries have already been entered </p>
			{{-- dump($categories) --}}


			<form method="post" action="{{ route('admin.category.update') }}">
			{{ csrf_field() }}
			@foreach($categories as $category)
				<div class="form-group">
				    <div class="row">
				        <div class="col-xs-12">
				            <label class="control-label">Category</label>
				            <input class="form-control" type="text" value="{{ $category->name }}" name="category[{{ $loop->index }}]">
				        </div>
				    </div>
				    <div class="row">
				        <div class="col-xs-12">
				            <label class="control-label">Category-Sections</label>
				            <textarea class="form-control" rows="8" name="sections[{{ $loop->index }}]">{{ $category->sections }}</textarea>
				        </div>
				    </div>


				</div>
				@endforeach

			<button class="btn btn-primary">Update Categories</button>
			</form>
		</div>
	</div>
</div>

@endsection
