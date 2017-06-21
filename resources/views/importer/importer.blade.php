@extends('layouts.backend')

@section('content')
<h1 class="page-header">Importer</h1>
<div class="container-fluid">
	<h2>Mailchimp</h2>
	<form role="form" action="/importer/mailchimp" method="POST">
		{{ csrf_field() }}
		<div class="form-group">
			<label class="control-label">Mailchimp API Key</label>
			<input type="text" class="form-control" name="mailchimp-api-key" placeholder="Enter Mailchimp API Key"/>
		</div>
		<button type="submit" class="btn btn-success">Import</button>
	</form>
	<h2>GetResponse</h2>
	<form role="form" action="/importer/getresponse" method="POST">
		{{ csrf_field() }}
		<div class="form-group">
			<label class="control-label">GetResponse API Key</label>
			<input type="text" class="form-control" name="getresponse-api-key" placeholder="Enter GetResponse API Key"/>
		</div>
		<button type="submit" class="btn btn-success">Import</button>
	</form>
</div>
@endsection