@extends('admin.layouts.app')

<?php

$title = __('Program');

$details = __('Program').' '.__('for'). ' '.$channel->name;

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


                <!-- Default Basic Forms Start -->
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-blue h4">{{ __('Program') }}</h4>
                            <!-- <p class="mb-30">All bootstrap element classies</p> -->
                        </div>
                    </div>

                    <br>

                    <div>
                        <table class="table table-bordered table-active" id="Tabday">
                            <thead>
                                <tr>
                                    @foreach ($days as $day)
                                        <th>{{ json_decode($day->name,true)[config('app.locale')] }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                </div>


                <form action="{{ route('admin.channels.store') }}" method="POST">
                    @csrf

                    @foreach (config('app.supported_locales') as $key => $val)
                @php
                    $name = "name_".$key;
                    $description = "description_".$key;
                @endphp

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">{{ __('Name') }} ({{ $val }})</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" name="{{$name}}" value="{{ old($name) }}" type="text" placeholder="{{ __('Name') }} ({{ $val }})">
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">{{ __('Description') }} ({{ $val }})</label>
                        <div class="col-sm-12 col-md-10">
                            <textarea class="form-control" name="{{$description}}">{{ old($description) }}</textarea>
                        </div>
                    </div>

                    <hr>

            @endforeach
                    
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


                <hr>

                     <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">{{ __('Day of the program') }} </label>
                        <div class="col-sm-12 col-md-10">
                            @foreach ($days as $day)
                                <div class="custom-control custom-checkbox mb-5">
                                    <input type="checkbox" value="{{$day->id}}" class="custom-control-input" name="days[]" id="format-{{$day->id}}"/>
                                    <label class="custom-control-label" for="format-{{$day->id}}">{{ json_decode($day->name,true)[config('app.locale')] }}</label>
                                    <br>
                                    Heure <input name="hour[]" type="text"> &nbsp;&nbsp;
                                    Minute <input name="hour[]" type="text">
                                    
                                </div>
                                <br>
                            @endforeach
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