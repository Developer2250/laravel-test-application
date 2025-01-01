@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<h1>Categories</h1>
			</div>
			<div class="col-md-6">
				<a href="{{ route('categories.create') }}" class="btn btn-primary float-end">Add Category</a>
			</div>
		</div>
		<div class="container mt-3">
			<table class="table">
				<thead>
					<tr>
						<th>Category ID</th>
						<th>Name (Full Path)</th>
						<th>Status</th>
						{{-- <th>Parent ID</th> --}}
						<th>Created Date</th>
						<th>Updated Date</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($categoriesWithData as $id => $category)
						<tr>
							<td>{{ $id }}</td>
							<td>{{ $category['path'] }}</td>
							<td>{{ $category['status'] == 1 ? 'Enabled' : 'Disabled' }}</td>
							{{-- <td>{{ $category['parentId'] == null ? 'N / A' : $category['parentId'] }}</td> --}}
							<td>{{ $category['created_at']->format('Y-m-d H:i:s') }}</td>
							<td>{{ $category['updated_at']->format('Y-m-d H:i:s') }}</td>
							<td>
								<a href="{{ route('categories.edit', $id) }}" class="btn btn-warning">Edit</a>
								<form action="{{ route('categories.destroy', $id) }}" method="POST" style="display: inline;">
									@csrf
									@method('DELETE')
									<button type="submit" class="btn btn-danger">Delete</button>
								</form>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	@endsection
