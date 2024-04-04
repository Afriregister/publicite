@extends('admin.layouts.app')

<?php

$title = __('Add').' '.__('Channel');

$details = __('Channel');

$header = __('Channel');

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

                <form action="{{ route('admin.channels.store') }}" method="POST">
                    @csrf

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">{{ __('Media') }}</label>
                        <div class="col-sm-12 col-md-10">
                            <select class="custom-select2 form-control" name="media_id">
                                <option value="">{{__('Select')}}</option>
                                @foreach ($medias as $media)
                                    @if ($media->id == old('media_id'))
                                        <option value="{{$media->id}}" selected="selected"> {{ $media->name }} </option> 
                                    @else
                                        <option value="{{$media->id}}"> {{ $media->name }} </option> 
                                    @endif
                                                                       
                                @endforeach
                            </select>
                        </div>
                    </div> 

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">{{ __('Platform') }}</label>
                        <div class="col-sm-12 col-md-10">
                            <select class="custom-select2 form-control" name="platform_id">
                                <option value="">{{__('Select')}}</option>
                                @foreach ($platforms as $platform)
                                    @if ($platform->id == old('platform_id'))
                                        <option value="{{$platform->id}}" selected="selected"> {{ json_decode($platform->name,true)[config('app.locale')] }} </option> 
                                    @else
                                        <option value="{{$platform->id}}"> {{ json_decode($platform->name,true)[config('app.locale')] }} </option> 
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
                        <label class="col-sm-12 col-md-2 col-form-label">{{ __('Status') }}</label>
                        <div class="col-sm-12 col-md-10">
                            <select name="status" class="custom-select col-12">
                                @if(old('status') == 1)
                                <option value="1" selected="selected">{{ __('Active') }}</option>
                                @else
                                <option value="1">{{ __('Active') }}</option>
                                @endif
                                @if(old('status') == 0)
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
                            <a href="{{ route('admin.channels.index') }}" class="btn btn-secondary"> {{ __('Back') }} </a>
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