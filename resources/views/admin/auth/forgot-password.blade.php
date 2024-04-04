@extends('admin.layouts.guest')

@section('title') {{ __("Forgot Password") }} @endsection

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
				<li class="list-inline-item"><a href="{{ route('admin.login') }}">{{ __('Log In') }}</a></li>

			
            @php 

            if(session()->get('locale') != ''){
            
                $locale = session()->get('locale'); 
            }
            else{
            
                $locale = config('app.fallback_locale');
            }
            
            @endphp
			
			</ul>
			
		</div>
	</div>
</div>
<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-md-6">
				<img src="{{ asset('admin/vendors/images/forgot-password.png') }}" alt="">
			</div>
			<div class="col-md-6">
				<div class="login-box bg-white box-shadow border-radius-10">
					<div class="login-title">
						<h2 class="text-center text-primary">{{ __("Forgot Password") }}?</h2>
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

					<h6 class="mb-20">  {{ __("Enter your email address to reset your password.") }}</h6>
					<form method="POST" action="{{ route('admin.password.email') }}">
						@csrf
						<div class="input-group custom">
							<input type="text" name="email" class="form-control form-control-lg" placeholder="{{ __('Email') }}">
							<div class="input-group-append custom">
								<span class="input-group-text"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
							</div>
						</div>
						
						<div class="input-group custom">
							{!! NoCaptcha::renderJs($locale) !!}
							{!! NoCaptcha::display() !!}
						</div>
						
						
						<div class="row align-items-center">
							<div class="col-5">
								<div class="input-group mb-0">

									<input class="btn btn-primary btn-lg btn-block" type="submit" value="{{ __('Submit') }}">

									<!-- <a class="btn btn-primary btn-lg btn-block" href="index.html">Submit</a> -->
								</div>
							</div>
							<div class="col-2">
								<div class="font-16 weight-600 text-center" data-color="#707373">{{ __('Or') }}</div>
							</div>
							<div class="col-5">
								<div class="input-group mb-0">
									<a class="btn btn-outline-primary btn-lg btn-block" href="{{ route('admin.login') }}">{{ __('Log In') }}</a>
								</div>
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