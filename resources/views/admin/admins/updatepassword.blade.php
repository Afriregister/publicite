@extends('admin.layouts.app')

@section('title') {{ __('Update Password') }} @endsection

@section('content')

<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>{{ __('Admin') }}</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ __('Update Password') }} </li>
                            </ol>
                        </nav>
                    </div>

                </div>
            </div>
            <!-- Default Basic Forms Start -->
            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="text-blue h4">{{ __('Admin details') }}</h4>
                        <p class="mb-30"> {{ __('All fields with * are required') }}</p>
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

                <form action="{{ route('admin.admins.updatepassword',$admin->id) }}" method="POST">
                    @csrf

                    {{ method_field('PUT') }}

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">{{ __('Name') }}</label>
                        <div class="col-sm-12 col-md-10">
                            {{ $admin->lastname }} {{ $admin->firstname }}
                            <input class="form-control" name="id" value="{{ $admin->id }}" type="hidden">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">{{ __('New Password') }}*</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" name="password" value="" type="text" placeholder="********">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label"></label>
                        <div class="col-sm-12 col-md-10">
                            <a href="{{ route('admin.admins.index') }}" class="btn btn-secondary"> {{ __('Back') }} </a>
                            &nbsp; &nbsp;
                            <input class="btn btn-primary" type="submit" value="{{ __('Update Password') }}">
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