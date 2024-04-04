@extends('admin.layouts.app')

<?php

$title = __('Edit').' '.__('Movement');

$details = __('Details');

$header = __('Movement');

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

                <form action="{{ route('admin.accountmovements.update',$accountmovement->id) }}" method="POST">
                    @csrf
                    {{ method_field('PUT') }}
                    
                   <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">{{ __('Action') }}</label>
                        <div class="col-sm-12 col-md-10">
                            <select class="custom-select2 form-control" name="action">
                                <option value="">{{__('Select')}}</option>

                                    @if ('Credit account' == old('action',$accountmovement->action))
                                        <option value="Credit account" selected="selected"> Credit account </option> 
                                    @else
                                        <option value="Credit account"> Credit account </option> 
                                    @endif

                                    @if ('Debit account' == old('action',$accountmovement->action))
                                        <option value="Debit account" selected="selected"> Debit account </option> 
                                    @else
                                        <option value="Debit account"> Debit account </option> 
                                    @endif

                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">{{ __('Amount') }}</label>
                        <div class="col-sm-12 col-md-10">
                            <input name="amount" value="{{old('amount',$accountmovement->amount)}}" type="text" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">{{ __('Currency') }}</label>
                        <div class="col-sm-12 col-md-10">
                            <select name="currency" class="form-control">
                                <option value="{{$accountmovement->account->currency}}">{{$accountmovement->account->currency}}</option>
                            </select>
                        </div>
                    </div>               
                    
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">{{ __('Description') }}</label>
                        <div class="col-sm-12 col-md-10">
                            <input name="description" value="{{old('description',$accountmovement->amount)}}" type="text" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label"></label>
                        <div class="col-sm-12 col-md-10">
                            <a href="{{ route('admin.accountmovements.index',$accountmovement->account_id) }}" class="btn btn-secondary"> {{ __('Back') }} </a>
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