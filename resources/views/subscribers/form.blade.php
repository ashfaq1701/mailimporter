@extends('layouts.backend')

@section('content')
<h1 class="page-header">Subscribers</h1>
<div class="container-fluid">
	<form role="form" method="POST" action="/subscribers{{ !empty($subscriber) ? '/'.$subscriber->id : '' }}">
		{{ csrf_field() }}
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label class="control-label" for="email">Email</label>
					<input type="text" id="email" name="email" class="form-control" placeholder="Email" value="{{ !empty($subscriber) ? $subscriber->email : '' }}"/>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label class="control-label" for="status">Status</label>
					<input type="text" id="status" name="status" class="form-control" placeholder="Status" value="{{ !empty($subscriber) ? $subscriber->status : '' }}"/>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label" for="first_name">First Name</label>
					<input type="text" id="first_name" name="first_name" class="form-control" placeholder="First Name" value="{{ !empty($subscriber) ? $subscriber->first_name : '' }}"/>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label" for="last_name">Last Name</label>
					<input type="text" id="last_name" name="last_name" class="form-control" placeholder="Last Name" value="{{ !empty($subscriber) ? $subscriber->last_name : '' }}"/>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label class="control-label" for="list">List</label>
					<select id="list" name="list" class="form-control">
						<option value="0">Select</option>
						@foreach($lists as $list)
						<option value="{{ $list->id }}"{{ !empty($subscriber) ? ($subscriber->list_id == $list->id ? ' selected' : '') : '' }}>{{ $list->name }}</option>
						@endforeach
					</select>
				</div>
			</div>
		</div>
		<button type="submit" class="btn btn-success">Save</button>
	</form>
</div>
@endsection