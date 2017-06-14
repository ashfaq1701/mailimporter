<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<meta name="description" content="">
    	<meta name="author" content="">
    	<link rel="icon" href="http://getbootstrap.com/favicon.ico">

    	<title>Dashboard Template for Bootstrap</title>

    	<!-- Bootstrap core CSS -->
    	<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
		<link href="{{ asset('css/ie10-viewport-bug-workaround.css') }}" rel="stylesheet">
		<link href="{{ asset('css/datatables.min.css') }}" rel="stylesheet">
    	<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    </head>

	<body>
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="/">Mail Importer</a>
				</div>
				<div id="navbar" class="navbar-collapse collapse">
				</div>
			</div>
		</nav>

		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-3 col-md-2 sidebar">
					@include('partials.sidebar-menu')
				</div>
				<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
					@yield('content')
				</div>
			</div>
		</div>

		<script src="{{ asset('js/jquery.min.js') }}"></script>
		<script src="{{ asset('js/bootstrap.min.js') }}"></script>
		<script src="{{ asset('js/holder.min.js') }}"></script>
		<script src="{{ asset('js/ie10-viewport-bug-workaround.js') }}"></script>
		<script src="{{ asset('js/datatables.min.js') }}"></script>
		<script src="{{ asset('js/custom.js') }}"></script>
	</body>
</html>