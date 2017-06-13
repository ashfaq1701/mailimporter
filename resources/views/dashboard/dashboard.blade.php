@extends('layouts.backend')

@section('content')
@if(!empty($alert))
	<div class="alert alert-{{ $alert['type'] }}">
  		{{ $alert['message'] }}
	</div>
@endif
<h1 class="page-header">Dashboard</h1>
@endsection