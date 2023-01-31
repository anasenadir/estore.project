<!-- main-sidebar -->
		<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
		<aside class="app-sidebar sidebar-scroll">
			<div class="main-sidebar-header active">
				<a class="desktop-logo logo-light active" style="height: unset" href="{{ url('/' . $page='index') }}"><img  src="{{URL::asset('assets/img/brand/logo1.jpg')}}" style="height: 58px" alt="logo"></a>
				<a class="desktop-logo logo-dark active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/logo-white.png')}}" class="main-logo dark-theme" alt="logo"></a>
				<a class="logo-icon mobile-logo icon-light active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/favicon.png')}}" class="logo-icon" alt="logo"></a>
				<a class="logo-icon mobile-logo icon-dark active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/favicon-white.png')}}" class="logo-icon dark-theme" alt="logo"></a>
			</div>
			<div class="main-sidemenu">
				<div class="app-sidebar__user clearfix">
					<div class="dropdown user-pro-body">
						<div class="">
							<img alt="user-img" class="avatar avatar-xl brround" src="/images/profile/{{company()->image_path}}"><span class="avatar-status profile-status bg-green"></span>
						</div>
						<div class="user-info">
							<h4 class="font-weight-semibold mt-3 mb-0">{{Str::ucfirst(auth()->user()->name)}}</h4>
							<span class="mb-0 text-muted">{{auth()->user()->email}}</span>
						</div>
					</div>
				</div>
				<ul class="side-menu">
					<li class="side-item side-item-category">Main</li>
					<li class="slide">
						<a class="side-menu__item" href="{{ url('/' . $page='index') }}"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24" ><path d="M0 0h24v24H0V0z" fill="none"/><path d="M5 5h4v6H5zm10 8h4v6h-4zM5 17h4v2H5zM15 5h4v2h-4z" opacity=".3"/><path d="M3 13h8V3H3v10zm2-8h4v6H5V5zm8 16h8V11h-8v10zm2-8h4v6h-4v-6zM13 3v6h8V3h-8zm6 4h-4V5h4v2zM3 21h8v-6H3v6zm2-4h4v2H5v-2z"/></svg><span class="side-menu__label">{{trans('dashbord/sidebar.dashbord')}}</span><span class="badge badge-success side-badge">1</span></a>
					</li>
					<li class="side-item side-item-category">{{ trans('dashbord/sidebar.transactions_title') }}</li>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3"/><path d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z"/></svg><span class="side-menu__label">{{trans('dashbord/sidebar.seles')}}</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="{{ url('/' . $page='seles/create') }}">{{trans('dashbord/sidebar.create_sele_invoice')}}</a></li>
							<li><a class="slide-item" href="{{ url('/' . $page='seles') }}">{{trans('dashbord/sidebar.view_seles')}}</a></li>
						</ul>
					</li>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
							<svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" fill="#000000" width="800px" height="800px" viewBox="0 0 24 24"><path d="M8,3V7H21l-2,7H8v2H18a1,1,0,0,1,0,2H7a1,1,0,0,1-1-1V4H4A1,1,0,0,1,4,2H7A1,1,0,0,1,8,3ZM6,20.5A1.5,1.5,0,1,0,7.5,19,1.5,1.5,0,0,0,6,20.5Zm9,0A1.5,1.5,0,1,0,16.5,19,1.5,1.5,0,0,0,15,20.5Z"/></svg>
							{{-- <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3"/><path d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z"/></svg> --}}
							<span class="side-menu__label">
								{{ trans('dashbord/sidebar.purchases') }}
							</span>
							<i class="angle fe fe-chevron-down"></i>
						</a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="{{ url('/' . $page='purchases/create') }}">{{ trans('dashbord/sidebar.create_purchase_invoice') }}</a></li>
							<li><a class="slide-item" href="{{ url('/' . $page='purchases') }}">{{ trans('dashbord/sidebar.view_purchases') }}</a></li>
						</ul>
					</li>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
							{{-- <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3"/><path d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z"/></svg> --}}
							<svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon"  viewBox="0 0 24 24"><path d="M18,22a1,1,0,0,0,1-1V8L12,2,5,8V21a1,1,0,0,0,1,1ZM12,7a2,2,0,1,1-2,2A2,2,0,0,1,12,7ZM9,16h2V14h2v2h2v2H13v2H11V18H9Z"/></svg>
							<span class="side-menu__label">{{ trans('dashbord/sidebar.pricings') }}</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="{{ url('/' . $page='pricing/create') }}">{{ trans('dashbord/sidebar.create_pricing_invoice') }}</a></li>
							<li><a class="slide-item" href="{{ url('/' . $page='pricing') }}">{{ trans('dashbord/sidebar.view_pricings') }}</a></li>
						</ul>
					</li>
					<li class="side-item side-item-category">{{ trans('dashbord/sidebar.expences_title') }}</li>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
							{{-- <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M3.31 11l2.2 8.01L18.5 19l2.2-8H3.31zM12 17c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z" opacity=".3"/><path d="M22 9h-4.79l-4.38-6.56c-.19-.28-.51-.42-.83-.42s-.64.14-.83.43L6.79 9H2c-.55 0-1 .45-1 1 0 .09.01.18.04.27l2.54 9.27c.23.84 1 1.46 1.92 1.46h13c.92 0 1.69-.62 1.93-1.46l2.54-9.27L23 10c0-.55-.45-1-1-1zM12 4.8L14.8 9H9.2L12 4.8zM18.5 19l-12.99.01L3.31 11H20.7l-2.2 8zM12 13c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/></svg> --}}
							<svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" xmlns:xlink="http://www.w3.org/1999/xlink" width="800px" height="800px" viewBox="-0.5 0 17 17" version="1.1" class="si-glyph si-glyph-money-3">

								<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">

									<g transform="translate(0.000000, 2.000000)" class="side-menu__icon" fill="#434343">

									<g>

									<path d="M12.345,12.947 L1.655,12.947 C0.755,12.947 0.021,12.244 0.021,11.377 L0.021,3.616 C0.021,2.752 0.754,2.045 1.655,2.045 L12.345,2.045 C13.246,2.045 13.98,2.752 13.98,3.616 L13.98,11.377 C13.979,12.244 13.246,12.947 12.345,12.947 L12.345,12.947 Z M0.995,4.414 L0.995,10.625 L2.364,12.057 L11.694,12.057 L13.021,10.672 L13.021,4.46 L11.694,2.936 L2.364,2.936 L0.995,4.414 L0.995,4.414 Z" class="si-glyph-fill">

									</path>

									<path d="M14.248,0.033 L3.047,0.033 L3.043,0.969 L13.256,0.969 L15.031,2.783 L15.031,8.937 L15.927,8.921 L15.927,1.663 C15.927,0.793 15.161,0.049 14.248,0.033 L14.248,0.033 Z" class="si-glyph-fill">

									</path>

									</g>

									<rect x="2" y="7" width="0.953" height="0.984" class="si-glyph-fill">

									</rect>

									<rect x="11" y="7" width="0.984" height="0.953" class="si-glyph-fill">

									</rect>

									<g transform="translate(5.000000, 4.000000)">

									<rect x="0" y="2" width="0.969" height="0.969" class="si-glyph-fill">

									</rect>

									<rect x="4" y="4" width="0.984" height="0.969" class="si-glyph-fill">

									</rect>

									<path d="M3,0.016 L2.031,0.016 L2.031,1.031 L1,1.031 L1,1.969 L2.031,1.969 L2.031,3.031 L1,3.031 L1,3.969 L2.031,3.969 L2.031,5.031 L1,5.031 L1,5.969 L2.031,5.969 L2.031,6.969 L3,6.969 L3,5.969 L3.984,5.969 L3.984,5.031 L3,5.031 L3,3.969 L3.984,3.969 L3.984,3.031 L3,3.031 L3,1.969 L3.984,1.969 L3.984,1.031 L3,1.031 L3,0.016 Z" class="si-glyph-fill">

									</path>

									</g>

									</g>

								</g>

							</svg>
							<span class="side-menu__label">{{ trans('dashbord/sidebar.expenses_categories') }}</span><i class="angle fe fe-chevron-down"></i>
						</a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="{{ url('/' . $page='expensesCategories/create') }}">{{ trans('dashbord/sidebar.create_expense_category') }}</a></li>
							<li><a class="slide-item" href="{{ url('/' . $page='expensesCategories') }}">{{ trans('dashbord/sidebar.view_expenses_categories') }}</a></li>
						</ul>
					</li>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M3.31 11l2.2 8.01L18.5 19l2.2-8H3.31zM12 17c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z" opacity=".3"/><path d="M22 9h-4.79l-4.38-6.56c-.19-.28-.51-.42-.83-.42s-.64.14-.83.43L6.79 9H2c-.55 0-1 .45-1 1 0 .09.01.18.04.27l2.54 9.27c.23.84 1 1.46 1.92 1.46h13c.92 0 1.69-.62 1.93-1.46l2.54-9.27L23 10c0-.55-.45-1-1-1zM12 4.8L14.8 9H9.2L12 4.8zM18.5 19l-12.99.01L3.31 11H20.7l-2.2 8zM12 13c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/></svg><span class="side-menu__label">{{ trans('dashbord/sidebar.daily_expenses') }}</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="{{ url('/' . $page='products') }}">{{ trans('dashbord/sidebar.create_daily_expense') }}</a></li>
							<li><a class="slide-item" href="{{ url('/' . $page='product-details') }}">{{ trans('dashbord/sidebar.view_daily_expenses') }}</a></li>
						</ul>
					</li>
					<li class="side-item side-item-category">{{ trans('dashbord/sidebar.store_title') }}</li>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
							<svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" width="800px" height="800px" viewBox="0 0 48 48">
							<g id="Layer_2" data-name="Layer 2">
								<g id="invisible_box" data-name="invisible box">
								<rect width="48" height="48" fill="none"/>
								</g>
								<g id="icons_Q2" data-name="icons Q2">
								<path d="M24,10h0a2,2,0,0,1,2-2H42a2,2,0,0,1,2,2h0a2,2,0,0,1-2,2H26A2,2,0,0,1,24,10Z"/>
								<path d="M24,24h0a2,2,0,0,1,2-2H42a2,2,0,0,1,2,2h0a2,2,0,0,1-2,2H26A2,2,0,0,1,24,24Z"/>
								<path d="M24,38h0a2,2,0,0,1,2-2H42a2,2,0,0,1,2,2h0a2,2,0,0,1-2,2H26A2,2,0,0,1,24,38Z"/>
								<path d="M12,2a2.1,2.1,0,0,0-1.7,1L4.2,13a2.3,2.3,0,0,0,0,2,1.9,1.9,0,0,0,1.7,1H18a2.1,2.1,0,0,0,1.7-1,1.8,1.8,0,0,0,0-2l-6-10A1.9,1.9,0,0,0,12,2Z"/>
								<path d="M12,30a6,6,0,1,1,6-6A6,6,0,0,1,12,30Z"/>
								<path d="M16,44H8a2,2,0,0,1-2-2V34a2,2,0,0,1,2-2h8a2,2,0,0,1,2,2v8A2,2,0,0,1,16,44Z"/>
								</g>
							</g>
							</svg>
							<span class="side-menu__label">{{ trans('dashbord/sidebar.products_categories') }}</span>
							<i class="angle fe fe-chevron-down"></i>
						</a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="{{ url('/' . $page='productCategories/create') }}">{{ trans('dashbord/sidebar.create_products_category') }}</a></li>
							<li><a class="slide-item" href="{{ url('/' . $page='productCategories') }}">{{ trans('dashbord/sidebar.view_products_categories') }}</a></li>
						</ul>
					</li>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
						{{-- <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M3.31 11l2.2 8.01L18.5 19l2.2-8H3.31zM12 17c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z" opacity=".3"/><path d="M22 9h-4.79l-4.38-6.56c-.19-.28-.51-.42-.83-.42s-.64.14-.83.43L6.79 9H2c-.55 0-1 .45-1 1 0 .09.01.18.04.27l2.54 9.27c.23.84 1 1.46 1.92 1.46h13c.92 0 1.69-.62 1.93-1.46l2.54-9.27L23 10c0-.55-.45-1-1-1zM12 4.8L14.8 9H9.2L12 4.8zM18.5 19l-12.99.01L3.31 11H20.7l-2.2 8zM12 13c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/></svg> --}}
						<svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" xmlns:xlink="http://www.w3.org/1999/xlink" width="800px" height="800px" viewBox="0 0 512 512" version="1.1">
						<path d="M192,7.10542736e-15 L384,110.851252 L384,332.553755 L192,443.405007 L1.42108547e-14,332.553755 L1.42108547e-14,110.851252 L192,7.10542736e-15 Z M127.999,206.918 L128,357.189 L170.666667,381.824 L170.666667,231.552 L127.999,206.918 Z M42.6666667,157.653333 L42.6666667,307.920144 L85.333,332.555 L85.333,182.286 L42.6666667,157.653333 Z M275.991,97.759 L150.413,170.595 L192,194.605531 L317.866667,121.936377 L275.991,97.759 Z M192,49.267223 L66.1333333,121.936377 L107.795,145.989 L233.374,73.154 L192,49.267223 Z" id="Combined-Shape">
						</path>
						</svg>
						<span class="side-menu__label">{{ trans('dashbord/sidebar.products') }}</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="{{ url('/' . $page='products/create') }}">{{ trans('dashbord/sidebar.create_product') }}</a></li>
							<li><a class="slide-item" href="{{ url('/' . $page='products') }}">{{ trans('dashbord/sidebar.view_products') }}</a></li>
						</ul>
					</li>
					<li class="side-item side-item-category">{{ trans('dashbord/sidebar.clients_supplier_title') }}</li>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
						<svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="_x32_" viewBox="0 0 512 512" xml:space="preserve">
						<g>
							<path class="st0" d="M256.494,96.433c26.632,0,48.209-21.592,48.209-48.201C304.703,21.584,283.126,0,256.494,0   c-26.647,0-48.216,21.584-48.216,48.232C208.278,74.84,229.847,96.433,256.494,96.433z"/>
							<path class="st0" d="M321.225,126.746l-64.731,64.731l-65.139-65.131c-14.756,9.176-26.412,25.91-26.412,41.718v162.059   c0,11.687,9.466,21.153,21.153,21.153c5.738,0,0,0,14.757,0l8.045,138.214c0,12.433,10.078,22.511,22.519,22.511   c5.236,0,14.92,0,24.583,0c9.67,0,19.34,0,24.591,0c12.432,0,22.503-10.078,22.503-22.511l8.052-138.214c14.757,0,9.003,0,14.757,0   c11.679,0,21.145-9.466,21.145-21.153V168.063C347.049,152.475,335.715,136,321.225,126.746z"/>
							<polygon class="st0" points="242.076,165.732 256.463,180.119 269.807,166.784 269.807,140.82 242.076,140.82  "/>
							<rect x="242.091" y="113.787" class="st0" width="27.691" height="17.747"/>
							<path class="st0" d="M408.711,149.084c23.28,0,42.102-18.854,42.102-42.11c0-23.256-18.822-42.11-42.102-42.11   c-23.249,0-42.094,18.853-42.094,42.11C366.617,130.231,385.462,149.084,408.711,149.084z"/>
							<path class="st0" d="M458.065,171.784l-50.202,50.194l-33.123-33.123v141.267c0,13.586-5.62,25.815-14.614,34.669v6.852   l7.025,120.694c0,10.856,8.815,19.662,19.662,19.662c4.592,0,13.029,0,21.475,0c8.453,0,16.899,0,21.474,0   c10.863,0,19.662-8.806,19.662-19.662l7.025-120.694c12.889,0,7.873,0,12.889,0c10.204,0,18.468-8.265,18.468-18.484V211.641   C487.805,195.511,473.936,178.314,458.065,171.784z"/>
							<polygon class="st0" points="407.886,210.581 421.073,197.403 421.073,180.323 395.752,180.323 395.752,198.447  "/>
							<rect x="395.744" y="160.23" class="st0" width="25.344" height="11.648"/>
							<path class="st0" d="M103.289,149.084c23.249,0,42.094-18.854,42.094-42.11c0-23.256-18.845-42.11-42.094-42.11   c-23.28,0-42.102,18.853-42.102,42.11C61.187,130.231,80.009,149.084,103.289,149.084z"/>
							<path class="st0" d="M137.26,188.855l-33.123,33.123l-50.202-50.194c-15.87,6.53-29.74,23.727-29.74,39.858v141.518   c0,10.22,8.265,18.484,18.468,18.484c5.015,0,0,0,12.888,0l7.026,120.694c0,10.856,8.798,19.662,19.661,19.662   c4.576,0,13.022,0,21.475,0c8.446,0,16.883,0,21.475,0c10.848,0,19.662-8.806,19.662-19.662l7.025-120.694v-6.852   c-8.994-8.854-14.614-21.083-14.614-34.669V188.855z"/>
							<polygon class="st0" points="104.113,210.581 116.248,198.447 116.248,180.323 90.927,180.323 90.927,197.403  "/>
							<rect x="90.911" y="160.23" class="st0" width="25.345" height="11.648"/>
						</g>
						</svg>
						<span class="side-menu__label">{{ trans('dashbord/sidebar.suppliers') }}</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="{{ url('/' . $page='suppliers/create') }}">{{ trans('dashbord/sidebar.create_supplier') }}</a></li>
							<li><a class="slide-item" href="{{ url('/' . $page='suppliers') }}">{{ trans('dashbord/sidebar.view_suppliers') }}</a></li>
						</ul>
					</li>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
						<svg xmlns="http://www.w3.org/2000/svg"class="side-menu__icon" xmlns:xlink="http://www.w3.org/1999/xlink" height="800px" width="800px" version="1.1" id="_x32_" viewBox="0 0 512 512" xml:space="preserve">
							<g>
								<path class="st0" d="M324.708,174.596c-12.583-2.092-41.546-2.322-65.932,2.992c-1.562-1.032-3.128-2.099-4.672-3.048   c-4.714-2.887-9.337-5.328-13.929-7.168c-4.452-1.771-8.891-2.991-13.535-3.236v-0.02c-6.956-0.565-13.709-0.816-19.918-0.816   c-9.453,0.014-17.517,0.537-23.493,1.534h0.024c-0.826,0.126-1.732,0.203-2.716,0.203c-5.164,0.062-12.312-2.392-18.797-5.935   c-4.372-2.343-9.79-1.102-12.705,2.915L77.86,260.171c-2.424,3.34-2.511,7.866-0.227,11.311c1.806,2.706,3.316,5.515,4.313,8.326   c1.433,3.968,3.508,7.573,5.903,11.081c2.398,3.493,5.136,6.882,7.994,10.118l1.12,1.073c0,0,5.125,4.226,13.291,10.948   c-2.131,3.055-3.302,6.681-3.344,10.502c-0.052,5.035,1.855,9.805,5.384,13.41c3.584,3.661,8.375,5.676,13.497,5.676   c3.588,0,7.018-1.032,10.006-2.922c-1.997,3.012-3.106,6.52-3.148,10.209c-0.056,5.035,1.858,9.798,5.383,13.396   c3.577,3.668,8.372,5.683,13.497,5.683c4.026,0,7.837-1.311,11.052-3.654c-5.85,7.336-5.533,18.039,1.192,24.922   c3.578,3.654,8.368,5.669,13.486,5.669h0.004c4.965,0,9.658-1.917,13.228-5.411l3.49-3.466c-1.461,2.678-2.333,5.648-2.368,8.78   c-0.052,5.041,1.855,9.804,5.383,13.409c3.581,3.654,8.375,5.669,13.497,5.669c4.961,0,9.65-1.91,13.252-5.425l2.124-2.155   c1.063,0.837,2.033,1.59,2.824,2.204c0.648,0.488,1.2,0.907,1.705,1.27l0.75,0.53l1.063,0.656c3.992,2.189,7.81,3.138,10.846,3.807   c1.513,0.314,2.81,0.53,3.772,0.662l1.172,0.154l0.366,0.035l0.139,0.014l0.087,0.014l0.094,0.007l0.126,0.007   c0.115,0,0.059,0.014,0.665,0.028l0.715-0.028c6.65-0.488,12.946-2.776,18.114-6.722c2.056-1.576,3.856-3.48,5.467-5.564   c3.183,1.032,6.554,1.645,10.062,1.645c14.228-0.006,26.202-9.079,30.839-21.7c0.516-0.035,1.029-0.056,1.537-0.188   c1.806,0.328,3.637,0.565,5.533,0.565c14.118-0.014,26.066-8.911,30.78-21.366c0.032-0.028,0.063-0.041,0.094-0.063l1.108,0.105   c18.238,0,33.001-14.777,33.008-33.004c0.011-5.063-0.69-10.662-2.618-16.485c12.517-11.059,30.86-28.144,34.176-37.418   c1.597-4.463,10.575-15.166,13.183-18.814l-70.621-97.394C351.848,165.377,334.369,176.214,324.708,174.596z M366.923,330.384   c-0.01,7.287-5.906,13.186-13.194,13.2c-1.806,0-3.493-0.362-5.065-1.018c-0.157-0.07-0.321-0.084-0.478-0.133l-12.238-14.888   c-3.096-3.584-8.518-3.988-12.106-0.893c-3.591,3.096-3.988,8.522-0.889,12.113l11.837,14.427   c-0.757,6.562-6.272,11.701-13.044,11.708c-3.215-0.007-6.066-1.15-8.399-3.068l-11.746-14.324   c-3.1-3.584-8.522-3.981-12.109-0.885c-3.592,3.096-3.986,8.522-0.89,12.105l8.183,10.196c-0.014,0.634-0.076,1.269,0.035,1.904   c0.143,0.802,0.209,1.526,0.209,2.196c-0.01,7.294-5.909,13.186-13.193,13.2c-1.904,0-3.657-0.439-5.275-1.15l-14.316-15.048   c-3.455-3.25-8.887-3.082-12.137,0.376c-3.253,3.452-3.085,8.891,0.366,12.133l6.718,7.88c-0.673,1.444-1.569,2.748-2.932,3.807   c-1.747,1.339-4.149,2.259-6.882,2.566c-0.798-0.118-1.883-0.3-3.173-0.606c-1.6-0.362-3.288-0.955-4.163-1.416   c-0.303-0.222-1.077-0.794-2.196-1.674c-0.635-0.488-1.356-1.045-2.158-1.687c1.45-6.094-0.112-12.775-4.815-17.586   c-3.581-3.661-8.375-5.676-13.497-5.676c-2.88,0-5.641,0.711-8.18,1.946l-0.076-0.063l0.087-0.098   c3.602-3.528,5.617-8.242,5.672-13.29c0.052-5.042-1.862-9.805-5.39-13.403c-3.578-3.654-8.374-5.676-13.493-5.676   c-4.003,0-7.796,1.296-10.997,3.612c2.59-3.264,4.094-7.225,4.139-11.457c0.056-5.042-1.858-9.805-5.384-13.403   c-3.58-3.668-8.374-5.683-13.496-5.683c-4.961,0-9.651,1.911-13.221,5.411l-3.183,3.166c3.926-7.113,3.02-16.22-2.943-22.314   c-3.584-3.661-8.378-5.676-13.5-5.676c-4.961,0-9.651,1.91-13.228,5.411l-2.106,2.113c-1.496-1.235-2.964-2.441-4.261-3.508   c-4.874-4.003-8.232-6.778-9.581-7.894c-2.28-2.601-4.39-5.216-6.039-7.642c-1.771-2.566-3.026-4.944-3.591-6.555   c-0.83-2.329-1.82-4.518-2.897-6.596l62.57-86.279c6.186,2.587,12.953,4.532,20.258,4.582c1.945,0,3.936-0.14,5.954-0.474h0.025   c4.166-0.711,11.592-1.27,20.205-1.255c5.68-0.014,11.928,0.223,18.315,0.739l0.436,0.028c1.569,0.042,4.181,0.6,7.353,1.883   l0.718,0.328c-26.728,12.07-64.606,35.292-77.054,39.447c-14.215,4.735-15.404,23.695,16.579,27.244   c31.989,3.563,60.419-16.589,67.525-20.131c5.101-2.552,37.508,0.565,55.458,2.531c7.915,7.817,14.853,15.069,19.912,20.55   l39.423,48.198l0.174,0.196c5.052,5.85,7.793,10.598,9.348,14.671C366.446,322.874,366.913,326.388,366.923,330.384z"/>
								<path class="st0" d="M510.641,229.622L415.374,98.233c-2.305-3.187-6.747-3.884-9.927-1.583l-42.198,30.599   c-3.18,2.301-3.888,6.75-1.58,9.93l95.268,131.389c2.304,3.18,6.746,3.891,9.926,1.59l42.205-30.605   C512.242,237.243,512.953,232.801,510.641,229.622z M478.226,241.427c-5.293,3.835-12.705,2.65-16.548-2.643   c-3.839-5.292-2.656-12.698,2.643-16.54c5.296-3.842,12.702-2.657,16.544,2.628C484.704,230.172,483.522,237.585,478.226,241.427z"/>
								<path class="st0" d="M148.757,127.248l-42.206-30.599c-3.173-2.301-7.618-1.604-9.926,1.583L1.354,229.622   c-2.308,3.18-1.59,7.622,1.583,9.93l42.198,30.605c3.18,2.301,7.621,1.59,9.922-1.59l95.272-131.389   C152.637,133.998,151.929,129.549,148.757,127.248z M120.554,141.92c-3.839,5.293-11.248,6.478-16.544,2.636   c-5.3-3.835-6.481-11.255-2.64-16.54c3.838-5.3,11.248-6.485,16.544-2.642C123.217,129.215,124.389,136.62,120.554,141.92z"/>
							</g>
						</svg>
							<span class="side-menu__label">{{ trans('dashbord/sidebar.clients') }}</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="{{ url('/' . $page='clients/create') }}">{{ trans('dashbord/sidebar.create_client') }}</a></li>
							<li><a class="slide-item" href="{{ url('/' . $page='clients') }}">{{ trans('dashbord/sidebar.view_clients') }}</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</aside>
<!-- main-sidebar -->
