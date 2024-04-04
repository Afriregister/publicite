@extends('admin.layouts.app')

<?php

$title = __('Edit').' '.__('Platform');

$details = __('Platform');

$header = __('Platform');

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

                <form action="{{ route('admin.platforms.update',$platform->id) }}" method="POST">
                    @csrf
                    {{ method_field('PUT') }}

   
                    @foreach (config('app.supported_locales') as $key => $val)
                @php
                    $name = "name_".$key;
                    
                @endphp

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">{{ __('Name') }} ({{ $val }})</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" name="{{$name}}" value="{{ old($name,json_decode($platform->name,true)[$key]) }}" type="text" placeholder="{{ __('Name') }} ({{ $val }})">
                        </div>
                    </div>
                    <hr>
            @endforeach
                    
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">{{ __('Status') }}</label>
                        <div class="col-sm-12 col-md-10">
                            <select name="status" class="custom-select col-12">
                                @if(old('status',$platform->status) == 1)
                                <option value="1" selected="selected">{{ __('Active') }}</option>
                                @else
                                <option value="1">{{ __('Active') }}</option>
                                @endif
                                @if(old('status',$platform->status) == 0)
                                <option value="0" selected="selected">{{ __('Inactive') }}</option>
                                @else
                                <option value="0">{{ __('Inactive') }}</option>
                                @endif
                            </select>
                        </div>
                    </div>

                     <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">{{ __('Ads format allowed') }} </label>
                        <div class="col-sm-12 col-md-10">
                            @foreach ($formats as $format)

                                <div class="custom-control custom-checkbox mb-5">
									<input type="checkbox" @if(in_array($format->id,$list_formats)) checked = "checked" @endif value="{{$format->id}}" class="custom-control-input" name="formats[]" id="format-{{$format->id}}"/>
									<label class="custom-control-label" for="format-{{$format->id}}">{{ json_decode($format->name,true)[config('app.locale')] }}</label>
								</div>
                            @endforeach
                        </div>
                    </div> 

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">{{ __('Ads cycle allowed') }} </label>
                        <div class="col-sm-12 col-md-10">

                            @foreach ($cycles as $cycle)

                               <div class="custom-control custom-checkbox mb-5">
									<input type="checkbox" @if(in_array($cycle->id,$list_cycles)) checked = "checked" @endif value="{{$cycle->id}}" class="custom-control-input" name="cycles[]" id="cycle-{{$cycle->id}}"/>
									<label class="custom-control-label" for="cycle-{{$cycle->id}}">{{ json_decode($cycle->name,true)[config('app.locale')] }}</label>
								</div>
                            @endforeach
                        </div>
                    </div> 

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label"></label>
                        <div class="col-sm-12 col-md-10">
                            <a href="{{ route('admin.platforms.index') }}" class="btn btn-secondary"> {{ __('Back') }} </a>
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