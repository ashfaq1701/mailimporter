@extends('layouts.backend')

@section('content')
<h1 class="page-header">Subscribers</h1>
<div class="table-responsive">
	<div class="row">
		<div class="col-md-2 col-md-offset-10">
			<a class="btn btn-success" href="/subscribers/create">Add Subscriber</a>
		</div>
	</div>
	<table class="table table-striped">
		<thead>
			<tr>
				<th></th>
				<th>Email</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>List</th>
			</tr>
		</thead>
		<tbody>
			@foreach($subscribers as $subscriber)
			<tr>
				<td>
					<a href="/subscribers/{{ $subscriber->id }}"><span class="glyphicon glyphicon-edit"></span></a>
					<a href="/subscribers/delete/{{ $subscriber->id }}"><span class="glyphicon glyphicon-remove"></span></a>
				</td>
				<td>{{ $subscriber->email }}</td>
				<td>{{ $subscriber->first_name }}</td>
				<td>{{ $subscriber->last_name }}</td>
				<td><a href="/lists/{{ $subscriber->subscriberList->id }}">List</a></td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
@endsection