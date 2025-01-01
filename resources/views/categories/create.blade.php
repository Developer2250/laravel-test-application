@extends('layouts.app')

@section('content')
	<h1>Add Category</h1>
	<form action="{{ route('categories.store') }}" method="POST">
		@csrf
		<div class="form-group mt-3">
			<label for="Name">Category Name</label>
			<input type="text" name="name" class="form-control" value="{{ old('name') }}">
			@if ($errors->has('name'))
				<div class="text-danger">{{ $errors->first('name') }}</div>
			@endif
		</div>
		<div class="form-group mt-3">
			<label for="Status">Status</label>
			<select name="status" class="form-control">
				{{-- <option value="1" {{ isset($category) && $category->status == 1 ? 'selected' : '' }}>Enabled</option>
				<option value="2" {{ isset($category) && $category->status == 2 ? 'selected' : '' }}>Disabled</option> --}}

				<option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Enabled</option>
				<option value="2" {{ old('status') == 2 ? 'selected' : '' }}>Disabled</option>
			</select>
			@if ($errors->has('status'))
				<div class="text-danger">{{ $errors->first('status') }}</div>
			@endif
		</div>
		<div class="form-group mt-3">
			<label for="ParentId">Parent Category</label>
			<select name="parentId" class="form-control">
				<option value="">None</option>
				{{-- @foreach ($categories as $id => $path)
					<option value="{{ $id }}" {{ isset($category) && $category->parentId == $id ? 'selected' : '' }}>
						{{ $path }}</option>
				@endforeach --}}
				@foreach ($categories as $id => $path)
					<option value="{{ $id }}" {{ old('parentId') == $id ? 'selected' : '' }}>
						{{ $path }}
					</option>
				@endforeach
			</select>
			@if ($errors->has('parentId'))
				<div class="text-danger">{{ $errors->first('parentId') }}</div>
			@endif
		</div>
		<button type="submit" class="btn btn-success mt-4">Save</button>
	</form>
@endsection
