@extends('admin.layouts.app')

<?php

$title = __('Channels');

?>

@section('title') {{ $title }} @endsection

@section('css')

<link rel="stylesheet" type="text/css" href="{{ asset('admin/src/plugins/datatables/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('admin/src/plugins/datatables/css/responsive.bootstrap4.min.css') }}">
@endsection

@section('content')

<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
 
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>{{ $title }}</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right">
                        <!--
                        <div class="dropdown">
                            <a class="btn btn-primary dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                January 2018
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#">Export List</a>
                                <a class="dropdown-item" href="#">Policies</a>
                                <a class="dropdown-item" href="#">View Assets</a>
                            </div>
                        </div>
                        -->
                        <a class="btn btn-primary" href="{{ route('admin.channels.create') }}">{{ __('Add') }} {{ __('Channel') }}</a>
                    </div>
                </div>
            </div>
            
            <!-- Simple Datatable start -->
            <div class="card-box mb-30">
                <div class="pd-20">
                    <h4 class="text-blue h4">{{ $title }}</h4>
                </div>

                @if (Session::get('info'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ Session::get('info') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

                <div class="pb-20">
                    <table class="data-table table stripe hover nowrap">
                        <thead>
                            <tr>
                                <th class="datatable-nosort">{{ __('ID') }}</th>
                                <th>{{ __('User') }}</th>
                                <th>{{ __('Media') }}</th>
                                <th>{{ __('Platform') }}</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Created') }}</th>
                                <th class="datatable-nosort">{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($channels as $channel)
                            <tr>
                                <td>{{ $channel->id }}</td>
                                <td>#{{$channel->user_id}} {{ $channel->user->firstname }} {{ $channel->user->lastname }}</td>
                                <td>{{ $channel->media->name }}</td>
                                <td>{{ json_decode($channel->platform->name,true)[config('app.locale')] }}</td>
                                <td>{{ $channel->name }}</td>
                                <td>
                                    @if($channel->status == 1)
                                    <span class="badge badge-success"> {{ __('Active') }} </span>
                                    @elseif($channel->status == 0)
                                    <span class="badge badge-secondary">{{ __('Inactive') }}</span>
                                    @endif
                                </td>
                                <td>{{ date('d/m/Y H:i:s', strtotime($channel->created_at)) }}</td>
                                <td>
                                    <div class="dropdown">
                                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                            <i class="dw dw-more"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                            <!--<a class="dropdown-item" href=""><i class="dw dw-eye"></i> View</a>-->
                                            <a class="dropdown-item" href="channels/{{$channel->id}}/edit"><i class="dw dw-edit2"></i> {{ __('Edit') }}</a>

                                            <a class="dropdown-item" href="channels/{{$channel->id}}/program"><i class="dw dw-edit2"></i> {{ __('Programs') }}</a>

                                             <a class="dropdown-item" href="channels/{{$channel->id}}/package"><i class="dw dw-edit2"></i> {{ __('Packages') }}</a>

                                            <a class="dropdown-item" href="channels/{{$channel->id}}/price"><i class="dw dw-megaphone"></i> {{ __('Ads price') }}</a>

                                            <form action="{{ route('admin.channels.destroy',$channel->id) }}" method="POST" onSubmit="return confirm('{{__('Do you really want to delete?')}}')" class="dropdown-item">
                                            @method('DELETE')
                                            @csrf
                                            <input name="id" type="hidden" value="{{ $channel->id }}">
                                             <button type="submit" class="btn btn-sm bg-danger-light"><i class="dw dw-delete-3"></i>{{ __('Delete') }}</button>
                                            </form>

                                            <!--<a class="dropdown-item" href="#"><i class="dw dw-delete-3"></i> Delete</a>-->
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Simple Datatable End -->
        </div>
        @include('admin.layouts.footer')
    </div>
</div>

@endsection

@section('js')

<script src="{{ asset('admin/src/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/src/plugins/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin/src/plugins/datatables/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('admin/src/plugins/datatables/js/responsive.bootstrap4.min.js') }}"></script>
<!-- buttons for Export datatable -->
<script src="{{ asset('admin/src/plugins/datatables/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('admin/src/plugins/datatables/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin/src/plugins/datatables/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('admin/src/plugins/datatables/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('admin/src/plugins/datatables/js/buttons.flash.min.js') }}"></script>
<script src="{{ asset('admin/src/plugins/datatables/js/pdfmake.min.js') }}"></script>
<script src="{{ asset('admin/src/plugins/datatables/js/vfs_fonts.js') }}"></script>
<!-- Datatable Setting js -->
<script src="{{ asset('admin/vendors/scripts/datatable-setting.js') }}"></script>

@endsection