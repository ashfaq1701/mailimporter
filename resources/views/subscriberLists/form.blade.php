@extends('layouts.backend')

@section('content')
<h1 class="page-header">Lists</h1>
<div class="container-fluid">
	<form role="form" method="POST" action="/lists{{ !empty($subscriberList) ? '/'.$subscriberList->id : '' }}">
		{{ csrf_field() }}
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label class="control-label" for="name">Name</label>
					<input type="text" id="name" name="name" class="form-control" placeholder="Name" value="{{ !empty($subscriberList) ? $subscriberList->name : '' }}"/>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label class="control-label" for="permission_reminder">Permission Reminder</label>
					<textarea rows="4" id="permission_reminder" name="permission_reminder" class="form-control" placeholder="Permission Reminder">{{ !empty($subscriberList) ? $subscriberList->permission_reminder : '' }}</textarea>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label class="control-label" for="company">Company</label>
					<input type="text" id="company" name="company" class="form-control" placeholder="Company" value="{{ !empty($subscriberList) ? (!empty($subscriberList->contact) ? $subscriberList->contact->company : '') : '' }}"/>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label class="control-label" for="address1">Address Line 1</label>
					<input type="text" id="address1" name="address1" class="form-control" placeholder="Address Line 1" value="{{ !empty($subscriberList) ? (!empty($subscriberList->contact) ? $subscriberList->contact->address1 : '') : '' }}"/>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label class="control-label" for="address2">Address Line 2</label>
					<input type="text" id="address2" name="address2" class="form-control" placeholder="Address Line 2" value="{{ !empty($subscriberList) ? (!empty($subscriberList->contact) ? $subscriberList->contact->address2 : '') : '' }}"/>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label" for="city">City</label>
					<input type="text" id="city" name="city" class="form-control" placeholder="City" value="{{ !empty($subscriberList) ? (!empty($subscriberList->contact) ? $subscriberList->contact->city : '') : '' }}"/>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label" for="state">State</label>
					<input type="text" id="state" name="state" class="form-control" placeholder="State" value="{{ !empty($subscriberList) ? (!empty($subscriberList->contact) ? $subscriberList->contact->state : '') : '' }}"/>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label" for="zip">Zip</label>
					<input type="text" id="zip" name="zip" class="form-control" placeholder="Zip" value="{{ !empty($subscriberList) ? (!empty($subscriberList->contact) ? $subscriberList->contact->zip : '') : '' }}"/>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label" for="country">Country</label>
					<input type="text" id="country" name="country" class="form-control" placeholder="Country" value="{{ !empty($subscriberList) ? (!empty($subscriberList->contact) ? $subscriberList->contact->country : '') : '' }}"/>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label class="control-label" for="phone">Phone</label>
					<input type="text" id="phone" name="phone" class="form-control" placeholder="Phone" value="{{ !empty($subscriberList) ? (!empty($subscriberList->contact) ? $subscriberList->contact->phone : '') : '' }}"/>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label" for="from_name">From Name</label>
					<input type="text" id="from_name" name="from_name" class="form-control" placeholder="From Name" value="{{ !empty($subscriberList) ? (!empty($subscriberList->campaign) ? $subscriberList->campaign->from_name : '') : '' }}"/>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label" for="from_email">From Email</label>
					<input type="text" id="from_email" name="from_email" class="form-control" placeholder="From Email" value="{{ !empty($subscriberList) ? (!empty($subscriberList->campaign) ? $subscriberList->campaign->from_email : '') : '' }}"/>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label" for="subject">Subject</label>
					<input type="text" id="subject" name="subject" class="form-control" placeholder="Subject" value="{{ !empty($subscriberList) ? (!empty($subscriberList->campaign) ? $subscriberList->campaign->subject : '') : '' }}"/>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label" for="language">Language</label>
					<input type="text" id="language" name="language" class="form-control" placeholder="Language" value="{{ !empty($subscriberList) ? (!empty($subscriberList->campaign) ? $subscriberList->campaign->language : '') : '' }}"/>
				</div>
			</div>
		</div>
		<button type="submit" class="btn btn-success">Save</button>
	</form>
</div>
@endsection