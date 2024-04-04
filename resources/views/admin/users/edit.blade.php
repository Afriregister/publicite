@extends('admin.layouts.app')

<?php

$title = __('Edit').' '.__('User');

$details = __('User details');

$header = __('User');

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
            <!-- Default Basic Forms Start -->
            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="text-blue h4"> {{ $details }}</h4>
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

                @if(Session::get('info'))
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

                <form action="{{ route('admin.users.update',$user->id) }}" method="POST">
                    @csrf

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">{{ __('Sub Account') }}</label>
                        <div class="col-sm-12 col-md-10">
                            <select class="custom-select2 form-control" name="parent_id">
                                <option value="">{{__('Select')}}</option>
                                @foreach ($users as $userSel)
                                    @if ($userSel->id == old('parent_id',$user->parent_id))
                                        <option value="{{$userSel->id}}" selected="selected"> #{{$userSel->id}} {{ $userSel->firstname }} {{ $userSel->lastname }} ({{$userSel->role}}) </option> 
                                    @else
                                        <option value="{{$userSel->id}}"> #{{$userSel->id}} {{ $userSel->firstname }} {{ $userSel->lastname }} ({{$userSel->role}}) </option> 
                                    @endif
                                                                       
                                @endforeach
                            </select>
                        </div>
                    </div> 

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">{{ __('Firstname') }}</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" name="firstname" value="{{ old('firstname',$user->firstname) }}" type="text" placeholder="{{ __('Firstame') }}">
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">{{ __('Lastname') }}</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" name="lastname" value="{{ old('lastname',$user->lastname) }}" type="text" placeholder="{{ __('Lastname') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">{{ __('Role') }}</label>
                        <div class="col-sm-12 col-md-10">
                            <select name="role" class="custom-select2 form-control">
                                <option value="client" @if(old('role',$user->role) == 'client') selected="selected" @endif>Client</option>
                                <option value="company" @if(old('role',$user->role) == 'company') selected="selected" @endif>Company</option>
                                <option value="sales" @if(old('role',$user->role) == 'sales') selected="selected" @endif>Sales</option>
                                <option value="media" @if(old('role',$user->role) == 'media') selected="selected" @endif>Technical/Media</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">{{ __('Email') }}</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" name="email" value="{{ old('email',$user->email) }}" type="text" placeholder="{{ __('Email') }}">
                        </div>
                    </div>

                    <hr>

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">{{ __('Country') }}</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" name="country" value="{{ old('country',$user->country) }}" type="text" placeholder="{{ __('Country') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">{{ __('City') }}</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" name="city" value="{{ old('city',$user->city) }}" type="text" placeholder="{{ __('City') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">{{ __('Address') }}</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" name="address" value="{{ old('address',$user->address) }}" type="text" placeholder="{{ __('Address') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">{{ __('Phonenumber') }}</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" name="phonenumber" value="{{ old('phonenumber',$user->phonenumber) }}" type="text" placeholder="{{ __('Phonenumber') }}">
                        </div>
                    </div>

                    <hr>
                    
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">{{ __('Status') }}</label>
                        <div class="col-sm-12 col-md-10">
                            <select name="status" class="custom-select col-12">
                                @if(old('status',$user->status) == 1)
                                <option value="1" selected="selected">{{ __('Active') }}</option>
                                @else
                                <option value="1">{{ __('Active') }}</option>
                                @endif
                                @if(old('status',$user->status) == 0)
                                <option value="0" selected="selected">{{ __('Inactive') }}</option>
                                @else
                                <option value="0">{{ __('Inactive') }}</option>
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label"></label>
                        <div class="col-sm-12 col-md-10">
                            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary"> {{ __('Back') }} </a>
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