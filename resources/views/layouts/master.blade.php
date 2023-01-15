<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="Description" content="Bootstrap Responsive Admin Web Dashboard HTML5 Template">
		<meta name="Author" content="Spruko Technologies Private Limited">
		<meta name="Keywords" content="admin,admin dashboard,admin dashboard template,admin panel template,admin template,admin theme,bootstrap 4 admin template,bootstrap 4 dashboard,bootstrap admin,bootstrap admin dashboard,bootstrap admin panel,bootstrap admin template,bootstrap admin theme,bootstrap dashboard,bootstrap form template,bootstrap panel,bootstrap ui kit,dashboard bootstrap 4,dashboard design,dashboard html,dashboard template,dashboard ui kit,envato templates,flat ui,html,html and css templates,html dashboard template,html5,jquery html,premium,premium quality,sidebar bootstrap 4,template admin bootstrap 4"/>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
		<title>
			@yield('title')
		</title>
		@include('layouts.head')
		<style>
			*{
				font-family: 'cairo', sans-serif;
			}
		</style>
	</head>

	<body class="main-body app sidebar-mini">
		<!-- Loader -->
		<div id="global-loader">
			<img src="{{URL::asset('assets/img/loader.svg')}}" class="loader-img" alt="Loader">
		</div>
		<!-- /Loader -->
		@include('layouts.main-sidebar')		
		<!-- main-content -->
		<div class="main-content app-content">
			@include('layouts.main-header')			
			<!-- container -->
			<div class="container-fluid">
				@if (Session::has('message'))
					@if (Session::has('type'))
						<div class="alert alert-danger alert-dismissible fade mt-3 show d-flex justify-content-between align-items-center" role="alert">
							<h4>{{Session::get('message')}}.</h4> 
							<button type="button" class="btn btn-close" data-bs-dismiss="alert" aria-label="Close">
								<i class="bi bi-x-lg fs-3"></i>
							</button>
						</div>
					@else
						<div class="alert alert-success alert-dismissible fade mt-3 show d-flex justify-content-between align-items-center" role="alert">
							<h4>{{Session::get('message')}}.</h4> 
							<button type="button" class="btn btn-close" data-bs-dismiss="alert" aria-label="Close">
								<i class="bi bi-x-lg fs-3"></i>
							</button>
						</div>
					@endif
				@endif
				@yield('page-header')
				@yield('content')
				@include('layouts.models')
            	@include('layouts.footer')
				@include('layouts.footer-scripts')	
	</body>
</html>