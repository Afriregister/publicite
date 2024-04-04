@extends('admin.layouts.guest')

@section('title') {{ __('Log In') }}  @endsection

@section('content')

<div class="login-header box-shadow">
	<div class="container-fluid d-flex justify-content-between align-items-center">
		<div class="brand-logo">
			<a href="">
				<img src="{{ asset('admin/vendors/images/deskapp-logo.png') }}" alt="">
				<font color="blue">{{ config('app.name') }}</font>
			</a>
		</div>
		<div class="login-menu">

			<ul class="list-inline">
			<!-- <li class="list-inline-item"><a href="{{route('admin.register')}}">{{__('Register')}}</a></li> -->
			
			
			@php 

            if(session()->get('locale') != ''){
            
                $locale = session()->get('locale'); 
            }
            else{
            
                $locale = config('app.fallback_locale');
            }
            
            @endphp
			
			@include('admin.lang')
			
			</ul>
		</div>
	</div>
</div>
<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-md-6 col-lg-7">
				<img src="{{ asset('admin/vendors/images/login-page-img.png') }}" alt="">
			</div>
			<div class="col-md-6 col-lg-5">
				<div class="login-box bg-white box-shadow border-radius-10">
					<div class="login-title">
						<h2 class="text-center text-primary">{{__('Login')}} {{__('to')}} {{ config('app.name') }}</h2>
					</div>

					@if ($errors->any())
					<div class="alert alert-danger">
						<ul>
							@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
					@endif

					@if (session('status'))
					<div class="alert alert-success">
						<ul>
							<li>{{ session('status') }}</li>
						</ul>
					</div>
					@endif

					<form method="POST" action="{{ route('admin.login') }}">
						@csrf

						<!--
							<div class="select-role">
								<div class="btn-group btn-group-toggle" data-toggle="buttons">
									<label class="btn active">
										<input type="radio" name="options" id="admin">
										<div class="icon"><img src="akarusho/vendors/images/briefcase.svg" class="svg" alt=""></div>
										<span>I'm</span>
										Manager
									</label>
									<label class="btn">
										<input type="radio" name="options" id="user">
										<div class="icon"><img src="akarusho/vendors/images/person.svg" class="svg" alt=""></div>
										<span>I'm</span>
										Employee
									</label>
								</div>
							</div>
							-->

						<div class="input-group custom">
							<input type="text" name="email" class="form-control form-control-lg" placeholder="{{ __('Email') }}">
							<div class="input-group-append custom">
								<span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
							</div>
						</div>
						<div class="input-group custom">
							<input type="password" name="password" class="form-control form-control-lg" placeholder="**********">
							<div class="input-group-append custom">
								<span class="input-group-text"><i class="dw dw-padlock1"></i></span>
							</div>
						</div>
						<div class="input-group custom">
						{!! NoCaptcha::renderJs($locale) !!}
						{!! NoCaptcha::display() !!} 
						</div>
						<div class="row pb-30">
							<div class="col-6">
								<div class="custom-control custom-checkbox">

									<input type="checkbox" name="remember" class="custom-control-input" id="customCheck1">
									<label class="custom-control-label" for="customCheck1">{{ __('Remember me') }}</label>
								</div>
							</div>
							@if (Route::has('password.request'))
							<div class="col-6">
								<div class="forgot-password">
									<a href="{{ route('admin.password.request') }}">{{ __('Forgot Your Password?') }}</a>
								</div>
							</div>
							@endif
						</div>
						<div class="row">
							<div class="col-sm-12">
								<div class="input-group mb-0">
									<input class="btn btn-primary btn-lg btn-block" type="submit" value="{{ __('Log in') }}">
								</div>
								
								<!--
								<div class="font-16 weight-600 pt-10 pb-10 text-center" data-color="#707373">{{ __('Or') }}</div>
								<div class="input-group mb-0">
									<a class="btn btn-outline-primary btn-lg btn-block" href="{{ route('admin.register') }}">
									    {{ __('Create Account') }}
									</a>
								</div>
								-->
							
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>

		@include('admin.layouts.footer')

	</div>

</div>


@endsection