<!-- main-header opened -->
			<div class="main-header sticky side-header nav nav-item">
				<div class="container-fluid">
					<div class="main-header-left ">
						<div class="responsive-logo">
							<a href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/logo.png')}}" class="logo-1" alt="logo"></a>
							<a href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/logo-white.png')}}" class="dark-logo-1" alt="logo"></a>
							<a href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/favicon.png')}}" class="logo-2" alt="logo"></a>
							<a href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/favicon.png')}}" class="dark-logo-2" alt="logo"></a>
						</div>
						<div class="app-sidebar__toggle" data-toggle="sidebar">
							<a class="open-toggle" href="#"><i class="header-icon fe fe-align-left" ></i></a>
							<a class="close-toggle" href="#"><i class="header-icons fe fe-x"></i></a>
						</div>
						<div class="main-header-center mr-3 d-sm-none d-md-none d-lg-block">
							<input class="form-control" placeholder="Search for anything..." type="search"> <button class="btn"><i class="fas fa-search d-none d-md-block"></i></button>
						</div>
					</div>
					<div class="main-header-right">
						<div class="nav nav-item  navbar-nav-right ml-auto align-items-center">

							{{-- the language selector  --}}
							@foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
								@if ($localeCode !== LaravelLocalization::getCurrentLocale())
									<a class='d-flex m-2' style="color: #5b6e88" href="{{ LaravelLocalization::getLocalizedURL( $localeCode) }}"
									class='d-flex align-items-center'>
										@foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
											@if ($localeCode !== LaravelLocalization::getCurrentLocale())
													{{ $properties['native']}}
													{{-- {{$localeCode}} --}}
											@endif
										@endforeach
											<i class="las la-globe tx-22 mr-1 header-icon-svgs" ></i>
									</a>
								@endif
							@endforeach
							{{-- end the language selector --}}
							<div class="dropdown nav-item main-header-notification">
								<a class="new nav-link" href="#">
								<svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg><span class=" pulse"></span></a>
								<div class="dropdown-menu">
									<div class="menu-header-content bg-primary text-right">
										<div class="d-flex">
											<h6 class="dropdown-title mb-1 tx-15 text-white font-weight-semibold">الإشعارات</h6>
											<span class="badge badge-pill badge-warning mr-auto my-auto float-left">Mark All Read</span>
										</div>
										<p class="dropdown-title-text subtext mb-0 text-white op-6 pb-0 tx-12 ">لديك {{auth()->user()->unreadNotifications->count()}} من الإشعارات لم تراها بعد</p>
									</div>
									<div class="main-notification-list Notification-scroll">
										@foreach (auth()->user()->unreadNotifications as $index =>  $notification)
											{{-- @foreach ($notification['data'] as $data)
											@endforeach --}}
											<a class="d-flex p-3 border-bottom" href="{{route('products.show' , $notification['data']["id"])}}">
												<div class="notifyimg bg-danger">
													<i class="la la-file-alt text-white"></i>
												</div>
												<div class="mr-3">
													<h6>{{$notification['data']["name"]}} :   تبقا فقط  {{$notification['data']["quantity"]}} عناصر</h6>
													<div class="notification-subtext">{{$notification->created_at}}</div>
												</div>
												<div class="mr-auto" >
													<i class="las la-angle-left text-left text-muted"></i>
												</div>
											</a>
										@endforeach
									</div>
									<div class="dropdown-footer">
										<a href="{{route('markAllAsRead')}}">لقد تم رؤية الإشعارات</a>
									</div>
								</div>
							</div>
							<div class="nav-item full-screen fullscreen-button">
								<a class="new nav-link full-screen-link" href="#"><svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-maximize"><path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"></path></svg></a>
							</div>
							<div class="dropdown main-profile-menu nav nav-item nav-link">
								<a class="profile-user d-flex" href="">
									<img alt="" src="/images/profile/{{company()->image_path}}">
								</a>
								<div class="dropdown-menu">
									<div class="main-header-profile bg-primary p-3">
										<div class="d-flex wd-100p">
											<div class="main-img-user">
												<img alt="" src="/images/profile/{{company()->image_path}}" />
											</div>
											<div class="mr-3 my-auto">
												<h6>{{auth()->user()->name}}</h6><span>{{auth()->user()->email}}</span>
											</div>
										</div>
									</div>
									<a class="dropdown-item" href="{{URL::to('profile')}}"><i class="bx bx-user-circle"></i>Profile</a>
									<a class="dropdown-item" href=""><i class="bx bx-cog"></i> Edit Profile</a>
									<a class="dropdown-item" href=""><i class="bx bxs-inbox"></i>Inbox</a>
									<a class="dropdown-item" href=""><i class="bx bx-envelope"></i>Messages</a>
									<a class="dropdown-item" href=""><i class="bx bx-slider-alt"></i> Account Settings</a>
									<a class="dropdown-item" href="{{ url('/' . $page='page-signin') }}"><i class="bx bx-log-out"></i> Sign Out</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
<!-- /main-header -->
