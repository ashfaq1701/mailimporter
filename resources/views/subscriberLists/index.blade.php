@extends('layouts.backend')

@section('content')
<h1 class="page-header">Lists</h1>
<div class="table-responsive">
	<div class="row">
		<div class="col-md-2 col-md-offset-10">
			<a class="btn btn-success" href="/lists/create">Add List</a>
		</div>
	</div>
	<table class="table table-striped">
		<thead>
			<tr>
				<th></th>
				<th>Name</th>
				<th>Permission Remainder</th>
				<th>From Name</th>
				<th>From Email</th>
				<th>Subscribers</th>
			</tr>
		</thead>
		<tbody>
			@foreach($subscriberLists as $subscriberList)
			<tr>
				<td>
					<a href="/lists/{{ $subscriberList->id }}"><span class="glyphicon glyphicon-edit"></span></a>
					<a href="/lists/delete/{{ $subscriberList->id }}"><span class="glyphicon glyphicon-remove"></span></a>
				</td>
				<td>{{ $subscriberList->name }}</td>
				<td>{{ $subscriberList->permission_reminder }}</td>
				<td>{{ $subscriberList->campaign->from_name }}</td>
				<td>{{ $subscriberList->campaign->from_email }}</td>
				<td><a href="/lists/{{ $subscriberList->id }}/subscribers">Subscribers</a></td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
@endsection