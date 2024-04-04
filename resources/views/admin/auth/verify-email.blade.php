@extends('layouts.guest')

@section('title') {{ __("Verify Email Address") }} @endsection

@section('content')
<div class="login-header box-shadow">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <div class="brand-logo">
            <a href="login.html">
                <img src="{{ asset('vendors/images/deskapp-logo.svg') }}" alt="">
            </a>
        </div>
        <div class="login-menu">
            <ul class="list-inline">
                <li class="list-inline-item"><a href="{{ route('admin.login') }}">{{ __("Log In") }}</a></li>
                
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
            <div class="col-md-6 col-lg-7">
                <img src="{{ asset('vendors/images/forgot-password.png') }}" alt="">
            </div>
            <div class="col-md-6 col-lg-5">
                <div class="login-box bg-white box-shadow border-radius-10">
                    <div class="login-title">
                        <h2 class="text-center text-primary">{{ __("Verify Email Address") }}</h2>
                    </div>

                    <div class="input-group custom">
         
               {{ __("Thank you for your registration! Before we begin, could you verify your email address by clicking on the link we just sent you? If you have not received the email, we will gladly send you another one.") }}
                    
                    </div>

                    @if (session('status') == 'verification-link-sent')
                    <div class="input-group custom">
                        {{ __("A new verification link has been sent to the email address you provided during registration.") }}
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="input-group mb-0">
                                <form method="POST" action="{{ route('admin.verification.send') }}">
                                    @csrf
                                    <input class="btn btn-primary btn-lg btn-block" type="submit" value="{{ __('Resend verification email') }}">
                                </form>
                            </div>
                            <div class="font-16 weight-600 pt-10 pb-10 text-center" data-color="#707373">{{ __('Or') }}</div>
                            <div class="input-group mb-0">
                                <form method="POST" action="{{ route('admin.logout') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-primary btn-lg btn-block">
                                       {{ __('Logout') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        @include('layouts.footer')
    </div>
</div>

@endsection