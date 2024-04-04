@extends('admin.layouts.app')

<?php

$title = __('Add').' '.__('Company');

$details = __('Company details');

$header = __('Company');

?>

@section('title') {{ $title }} @endsection

@section('content')

<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>{{ $header }}</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $title }} </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Default Basic Forms Start -->
            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="text-blue h4">{{ $details }}</h4>
                        <!-- <p class="mb-30">All bootstrap element classies</p> -->
                    </div>
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

                @if (Session::get('info'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ Session::get('info') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                
                @if (Session::get('msg'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ Session::get('msg') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

                <form action="{{ route('admin.companies.store') }}" method="POST">
                    @csrf

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">{{ __('User') }}</label>
                        <div class="col-sm-12 col-md-10">
                            <select class="custom-select2 form-control" name="user_id">
                                <option value="">{{__('Select')}}</option>
                                @foreach ($users as $user)
                                    @if ($user->id == old('user_id'))
                                        <option value="{{$user->id}}" selected="selected"> #{{$user->id}} {{ $user->firstname }} {{ $user->lastname }} ({{$user->role}}) </option> 
                                    @else
                                        <option value="{{$user->id}}"> #{{$user->id}} {{ $user->firstname }} {{ $user->lastname }} ({{$user->role}}) </option> 
                                    @endif
                                                                       
                                @endforeach
                            </select>
                        </div>
                    </div> 

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">{{ __('Name') }}</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" name="name" value="{{ old('name') }}" type="text" placeholder="{{ __('Name') }}">
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">{{ __('TIN') }}</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" name="tin" value="{{ old('tin') }}" type="text" placeholder="{{ __('TIN') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">{{ __('Country') }}</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" name="country" value="{{ old('country') }}" type="text" placeholder="{{ __('Country') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">{{ __('City') }}</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" name="city" value="{{ old('city') }}" type="text" placeholder="{{ __('City') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">{{ __('Address') }}</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" name="address" value="{{ old('address') }}" type="text" placeholder="{{ __('Address') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">{{ __('Phonenumber') }}</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" name="phonenumber" value="{{ old('phonenumber') }}" type="text" placeholder="{{ __('Phonenumber') }}">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">{{ __('Email') }}</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" name="email" value="{{ old('email') }}" type="text" placeholder="{{ __('Email') }}">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">{{ __('Website') }}</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" name="website" value="{{ old('website') }}" type="text" placeholder="{{ __('Website') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label"></label>
                        <div class="col-sm-12 col-md-10">
                            <a href="{{ route('admin.companies.index') }}" class="btn btn-secondary"> {{ __('Back') }} </a>
                            &nbsp; &nbsp;
                            <input class="btn btn-primary" type="submit" value="{{ __('Save') }}">
                        </div>
                    </div>

                </form>
            </div>
            <!-- Default Basic Forms End -->

        </div>
        @include('admin.layouts.footer')
    </div>
</div>

@endsection