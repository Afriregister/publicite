@extends('admin.layouts.guest')

@section('title') {{ __('Register') }} @endsection

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
			
			@include('admin.lang')
			
			
			</ul>

        </div>
    </div>
</div>
<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 col-lg-7">
                <img src="{{ asset('admin/vendors/images/register-page-img.png') }}" alt="">
            </div>
            <div class="col-md-6 col-lg-5">
                <div class="login-box bg-white box-shadow border-radius-10">
                    <div class="login-title">
                        
                        @php $app = config('app.name') @endphp
                        
                        <h2 class="text-center text-primary">{{ __("Register on :site",["site" => $app]) }} </h2>
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

                    <form method="POST" action="{{ route('admin.register') }}">
                        @csrf

                        <div class="input-group custom">
                            <input type="text" name="firstname" class="form-control form-control-lg" value="{{ old('firstname') }}" placeholder="{{ __('Firstname') }}">
                            <div class="input-group-append custom">
                                <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                            </div>
                        </div>
                        <div class="input-group custom">
                            <input type="text" name="lastname" class="form-control form-control-lg" value="{{ old('lastname') }}" placeholder="{{ __('Lastname') }}">
                            <div class="input-group-append custom">
                                <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                            </div>
                        </div>
                        <div class="input-group custom">
                            <input type="text" name="email" class="form-control form-control-lg" value="{{ old('email') }}" placeholder="{{ __('Email') }}">
                            <div class="input-group-append custom">
                                <span class="input-group-text"><i class="fa fa-envelope-o"></i></span>
                            </div>
                        </div>
                        <div class="input-group custom">
                            <input type="password" name="password" class="form-control form-control-lg" placeholder="{{ __('Password') }}">
                            <div class="input-group-append custom">
                                <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                            </div>
                        </div>
                        <div class="input-group custom">
                            <input type="password" name="password_confirmation" class="form-control form-control-lg" placeholder="{{ __('Confirm Password') }}">
                            <div class="input-group-append custom">
                                <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                            </div>
                        </div>

                        <div class="input-group custom">
                            
                            {!! NoCaptcha::renderJs($locale) !!}
                            {!! NoCaptcha::display() !!}
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="input-group mb-0">
                                    <input class="btn btn-primary btn-lg btn-block" type="submit" value="{{ __('Create Account') }}">
                                </div>
                                <!--
								<div class="font-16 weight-600 pt-10 pb-10 text-center" data-color="#707373">OR</div>
								<div class="input-group mb-0">
									<a class="btn btn-outline-primary btn-lg btn-block" href="{{ route('admin.register') }}">
										Register To Create Account
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