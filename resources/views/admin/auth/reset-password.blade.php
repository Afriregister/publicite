@extends('layouts.guest')

@section('title') {{ __('Reset Password') }} @endsection

@section('content')
<div class="login-header box-shadow">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <div class="brand-logo">
            <a href="login.html">
                <img src="{{ asset('vendors/images/deskapp-logo.png') }}" alt="">
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
			
			@include('lang')
			
			</ul>
            
        </div>
    </div>
</div>
<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <img src="{{ asset('vendors/images/forgot-password.png') }}" alt="">
            </div>
            <div class="col-md-6">
                <div class="login-box bg-white box-shadow border-radius-10">
                    <div class="login-title">
                        <h2 class="text-center text-primary">{{ __('Reset Password') }}</h2>
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

                    <form method="POST" action="{{ route('admin.password.update') }}">
                        @csrf

                        <!-- Password Reset Token -->
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <div class="input-group custom">
                            <input type="text" name="email" value="{{ old('email', $request->email) }}" required class="form-control form-control-lg" placeholder="{{ __('Email') }}">
                            <div class="input-group-append custom">
                                <span class="input-group-text"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
                            </div>
                        </div>
                        <div class="input-group custom">
                            <input type="password" name="password" required class="form-control form-control-lg" placeholder="{{ __('Password') }}">
                            <div class="input-group-append custom">
                                <span class="input-group-text"><i class="fa fa-lock" aria-hidden="true"></i></span>
                            </div>
                        </div>
                        <div class="input-group custom">
                            <input type="password" name="password_confirmation" required class="form-control form-control-lg" placeholder="{{ __('Confirm Password') }}">
                            <div class="input-group-append custom">
                                <span class="input-group-text"><i class="fa fa-lock" aria-hidden="true"></i></span>
                            </div>
                        </div>
                        <div class="input-group custom">
							{!! NoCaptcha::renderJs('fr') !!}
							{!! NoCaptcha::display() !!}
						</div>
                        <div class="row align-items-center">
                            <div class="col-12">
                                <div class="input-group mb-0">

                                    <input class="btn btn-primary btn-lg btn-block" type="submit" value="{{ __('Submit') }}">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @include('layouts.footer')
    </div>

</div>

@endsection