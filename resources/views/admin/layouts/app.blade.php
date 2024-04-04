<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>@yield('title') - {{ config('app.name') }}</title>

	<!-- Site favicon -->
    <!--
	<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('admin/vendors/images/apple-touch-icon.png') }}">
	<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('admin/vendors/images/favicon-32x32.png') }}">
	<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('admin/vendors/images/favicon-16x16.png') }}">
    -->

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="{{ asset('admin/vendors/styles/core.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('admin/vendors/styles/icon-font.min.css') }}">

	@yield('css')

	<link rel="stylesheet" type="text/css" href="{{ asset('admin/vendors/styles/style.css') }}">

</head>

<body>
	<!--
	<div class="pre-loader">
		<div class="pre-loader-box">
			<div class="loader-logo"><img src="admin/vendors/images/deskapp-logo.svg" alt=""></div>
			<div class='loader-progress' id="progress_div">
				<div class='bar' id='bar1'></div>
			</div>
			<div class='percent' id='percent1'>0%</div>
			<div class="loading-text">
				Loading...
			</div>
		</div>
	</div>
-->

	<div class="header">
		<div class="header-left">
			<div class="menu-icon dw dw-menu"></div>
			<div class="search-toggle-icon dw dw-search2" data-toggle="header_search"></div>
			<div class="header-search">
			    <!--
				<form>
					<div class="form-group mb-0">
						<i class="dw dw-search2 search-icon"></i>
						<input type="text" class="form-control search-input" placeholder="Search Here">
						<div class="dropdown">
							<a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
								<i class="ion-arrow-down-c"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-right">
								<div class="form-group row">
									<label class="col-sm-12 col-md-2 col-form-label">From</label>
									<div class="col-sm-12 col-md-10">
										<input class="form-control form-control-sm form-control-line" type="text">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-12 col-md-2 col-form-label">To</label>
									<div class="col-sm-12 col-md-10">
										<input class="form-control form-control-sm form-control-line" type="text">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-12 col-md-2 col-form-label">Subject</label>
									<div class="col-sm-12 col-md-10">
										<input class="form-control form-control-sm form-control-line" type="text">
									</div>
								</div>
								<div class="text-right">
									<button class="btn btn-primary">Search</button>
								</div>
							</div>
						</div>
					</div>
				</form>
				-->
			</div>
		</div>
		<div class="header-right">
			<div class="user-info-dropdown">
				<div class="dropdown">
					<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
						<span class="user-icon">
							<img src="{{ asset('admin/vendors/images/photo1.jpg') }}" alt="">
						</span>
						<span class="user-name">{{ Auth::guard('admin')->user()->firstname  }}</span>
					</a>
					<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
						<a class="dropdown-item" href="{{ route('admin.admins.edit', Auth::guard('admin')->user()->id ) }}"><i class="dw dw-user1"></i>{{ __('Profile') }} </a>
						<a class="dropdown-item" href="{{ route('admin.admins.password', Auth::guard('admin')->user()->id ) }}"><i class="dw dw-password"></i>{{ __('Update Password') }} </a>
						<!--
						<a class="dropdown-item" href="profile.html"><i class="dw dw-settings2"></i> Setting</a>
						<a class="dropdown-item" href="faq.html"><i class="dw dw-help"></i> Help</a>
	-->

						<!-- Authentication -->
						<form method="POST" action="{{ route('admin.logout') }}">
							@csrf

							<a class="dropdown-item" href="{{ route('admin.logout') }}" onclick="event.preventDefault();
                                        this.closest('form').submit();">
								<i class="dw dw-logout"></i> {{ __('Logout') }}
							</a>
						</form>
						<!-- <a class="dropdown-item" href="{{ route('admin.logout') }}"><i class="dw dw-logout"></i> Log Out</a> -->
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="left-side-bar">
		<div class="brand-logo">
			<a href="{{route('admin.dashboard')}}">
				<!-- <img src="{{ asset('admin/vendors/images/deskapp-logo.svg') }}" alt="" class="dark-logo"> 
				<img src="{{ asset('admin/vendors/images/deskapp-logo-white.svg') }}" alt="" class="light-logo"> -->

                <!--
				<img src="{{ asset('admin/vendors/images/logo_white.png') }}" alt="" class="dark-logo"> 
				<img src="{{ asset('admin/vendors/images/logo_white.png') }}" alt="" class="light-logo">
                -->

                {{ config('app.name') }}
			</a>
			<div class="close-sidebar" data-toggle="left-sidebar-close">
				<i class="ion-close-round"></i>
			</div>
		</div>
		<div class="menu-block customscroll">
			<div class="sidebar-menu">
				<ul id="accordion-menu">
					<li>
						<a href="" class="dropdown-toggle no-arrow">
							<span class="micon fa fa-home"></span><span class="mtext">{{ __('Home') }}</span>
						</a>
					</li>

					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon fa fa-money"></span><span class="mtext">{{ __('Orders') }}</span>
						</a>
						<ul class="submenu">
							<li><a href="">{{ __('All orders') }}</a></li>
							<li><a href="">{{ __('Add order') }}</a></li>
						</ul>
					</li>

					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon bi bi-megaphone-fill"></span> <span class="mtext">{{ __('Ads') }}</span>
						</a>
						<ul class="submenu">
							<li><a href="">{{ __('All ads') }}</a></li>
							<li><a href="{{route('admin.adsformats.index')}}">{{ __('Ads formats') }}</a></li>
							<li><a href="{{route('admin.adstypes.index')}}">{{ __('Ads types') }}</a></li>
							<li><a href="{{route('admin.adscycles.index')}}">{{ __('Ads cycles') }}</a></li>
						</ul>
					</li>

					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-antenna"></span><span class="mtext">{{ __('Medias') }}</span>
						</a>
						<ul class="submenu">
							<li><a href="{{route('admin.platforms.index')}}">{{ __('Platforms') }}</a></li>
							<li><a href="{{route('admin.media.index')}}">{{ __('Medias') }}</a></li>
							<li><a href="{{route('admin.channels.index')}}">{{ __('Channels') }}</a></li>
						</ul>
					</li>

					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon fa fa-user-circle"></span><span class="mtext">{{ __('Users') }}</span>
						</a>
						<ul class="submenu">
							<li><a href="{{route('admin.users.index')}}">{{ __('Users') }}</a></li>
							<li><a href="{{route('admin.companies.index')}}">{{ __('Companies') }}</a></li>
							<li><a href="{{route('admin.accounts.index')}}">{{ __('Accounts') }}</a></li>
						</ul>
					</li>

					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon fa fa-user-o"></span><span class="mtext">{{ __('Admins') }}</span>
						</a>
						<ul class="submenu">
							<li><a href="{{ route('admin.admins.index') }}">{{ __('All admins') }}</a></li>
							<li><a href="{{ route('admin.admins.create')}}">{{ __('Create Admin') }}</a></li>
						</ul>
					</li>


					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon fa fa-gear"></span><span class="mtext">{{ __('Settings') }}</span>
						</a>
						<ul class="submenu">
							<li><a href="{{ route('admin.days.index')}}">{{ __('Days') }}</a></li>
							<li><a href="{{ route('admin.periods.index')}}">{{ __('Periods') }}</a></li>
						</ul>
					</li>	

			
				</ul>
			</div>
		</div>
	</div>
	<div class="mobile-menu-overlay"></div>

	@yield('content')

	<!-- js -->
	<script src="{{ asset('admin/vendors/scripts/core.js') }}"></script>
	<script src="{{ asset('admin/vendors/scripts/script.min.js') }}"></script>
	<script src="{{ asset('admin/vendors/scripts/process.js') }}"></script>
	<script src="{{ asset('admin/vendors/scripts/layout-settings.js') }}"></script>
	@yield('js')
</body>

</html>