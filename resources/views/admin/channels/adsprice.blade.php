@extends('admin.layouts.app')

<?php

$title = __('Ads price');

$details = __('Ads price for').' '.$channel->name;

$header = __('Ads price');

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

                <form action="{{ route('admin.channels.adspriceday',$channel->id) }}" method="POST">
                @csrf

                <!-- Default Basic Forms Start -->
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-blue h4">{{ __('Per day') }}</h4>
                            <!-- <p class="mb-30">All bootstrap element classies</p> -->
                        </div>
                    </div>

                    <br>

                    <div>
                        <table class="table table-bordered table-active" id="Tabday">
                            <thead>
                                <tr>
                                    <th>{{ __('Ads type') }}</th>
                                    <th>{{ __('Ads format') }}</th>
                                    <th>{{ __('Price') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>

                    @if(old('day_ads_types'))

                        @php
                            
                        $nbre = count(old('day_ads_types'));

                        for($i=0;$i<$nbre;$i++)
                        {
                            echo '<tr id="day_'.$i.'">
                            <td><select name="day_ads_types[]" class="custom-select col-12" required="required"><option value="">'.__('Select').'</option>';

                            foreach($adsTypes as $adsType)
                            {
                                $name = json_decode($adsType->name,true)[config('app.locale')];

                                $sel_day_ads_types = '';

                                if(old('day_ads_types')[$i] == $adsType->id)
                                {
                                    $sel_day_ads_types = 'selected="selected"';
                                }

                                echo '<option value="'.$adsType->id.'" '.$sel_day_ads_types.' >'.$name.'</option>';
                            }

                            echo '</select> </td><td><select name="day_ads_formats[]" class="custom-select col-12" required="required"><option value="">'.__('Select').'</option>';

                            foreach($adsFormats as $adsFormat)
                            {

                                $name = json_decode($adsFormat->name,true)[config('app.locale')];

                                $sel_day_ads_formats = '';

                                if(old('day_ads_formats')[$i] == $adsFormat->id)
                                {
                                    $sel_day_ads_formats = 'selected="selected"';
                                }

                                echo '<option value="'.$adsFormat->id.'" '.$sel_day_ads_formats.' >'.$name.'</option>';
                            }

                            if($i > 0)
                            {
                                $delete = '<a href="#" onclick="test_suppression(\'day_'.$i.'\'); return false;" title="'.__('Delete').'">'.__('Delete').'</a>';
                            }
                            else
                            {
                                $delete = '';
                            }

                            echo '</select></td><td><input class="form-control" type="text" name="day_price[]" value="'.old('day_price')[$i].'"></td><td>'.$delete.'</td></tr>';

                        }

                        @endphp
                   
                   @else

                   @if ($channel->prices->where('period_id','!=',null)->count() > 0)

                        @php
                            $i = 0;
                        @endphp
                       
                       @foreach ($channel->prices->where('period_id','=',null) as $dayPrice)

                       <tr id="day_{{$i}}">
                        <td>
                            <select name="day_ads_types[]" class="custom-select col-12" required="required">
                            
                            <option value="">{{ __('Select') }}</option>

                            @foreach($adsTypes as $adsType)

                                @if ($adsType->id == $dayPrice->ads_type_id)

                                    <option value="{{ $adsType->id }}" selected="selected">{{ json_decode($adsType->name,true)[config('app.locale')] }}</option>

                                @else
                                    <option value="{{ $adsType->id }}">{{ json_decode($adsType->name,true)[config('app.locale')] }}</option>

                                @endif

                            @endforeach

                            </select>
                        </td>

                        <td>
                            <select name="day_ads_formats[]" class="custom-select col-12" required="required">
                            
                            <option value="">{{ __('Select') }}</option>

                            @foreach($adsFormats as $adsFormat)

                                @if ($adsFormat->id == $dayPrice->ads_format_id)

                                    <option value="{{ $adsFormat->id}}" selected="selected">{{ json_decode($adsFormat->name,true)[config('app.locale')] }}</option>

                                @else

                                    <option value="{{ $adsFormat->id}}">{{ json_decode($adsFormat->name,true)[config('app.locale')] }}</option>

                                @endif

                            @endforeach

                            </select>

                        </td>

                        <td> <input name="day_price[]" class="form-control" type="text" value="{{ $dayPrice->price }}"> </td>
                        
                        <td>
                        
                            @if ($i > 0)
                                <a href="#" onclick="test_suppression('day_{{ $i}}'); return false;" title="{{ __('Delete') }}">{{__('Delete')}}</a>
                            @else
                                
                            @endif
                        
                        </td>

                         @php
                            $i++;
                        @endphp

                    </tr>
                           
                       @endforeach

                   @else
                       
                    <tr id="day_1">
                        <td>
                            <select name="day_ads_types[]" class="custom-select col-12" required="required">
                            
                            <option value="">{{ __('Select') }}</option>

                            @foreach($adsTypes as $adsType)
                    
                                <option value="{{ $adsType->id }}">{{ json_decode($adsType->name,true)[config('app.locale')] }}</option>

                            @endforeach

                            </select>
                        </td>

                        <td>
                            <select name="day_ads_formats[]" class="custom-select col-12" required="required">
                            
                            <option value="">{{ __('Select') }}</option>

                            @foreach($adsFormats as $adsFormat)

                                <option value="{{ $adsFormat->id}}">{{ json_decode($adsFormat->name,true)[config('app.locale')] }}</option>
                        
                            @endforeach

                            </select>

                        </td>

                        <td> <input name="day_price[]" class="form-control" type="text" value=""> </td>
                        
                        <td></td>

                    </tr>

                   @endif


                   @endif

                     </tbody>
                    
                    </table>

                    <div class="form-group row">
                    <div class="pull-left">
                        <a href="#" class="btn btn-primary" onclick="AddDiv('Tabday'); return false;"><i class="fa fa-plus"></i> {{ __('Add price') }} </a>
                    </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-4 col-form-label"></label>
                        <div class="col-sm-12 col-md-8">
                            <input class="btn btn-primary" type="submit" value="{{ __('Save Ads price per day') }}">
                        </div>
                    </div>

                </div>
    
                </form>

                <hr>


                <form action="{{ route('admin.channels.adspriceperiod',$channel->id) }}" method="POST">
                @csrf

                <!-- Default Basic Forms Start -->
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-blue h4">{{ __('Per period') }}</h4>
                            <!-- <p class="mb-30">All bootstrap element classies</p> -->
                        </div>
                        <!--
                        <div class="pull-right">
                            <a href="#" class="btn btn-primary" onclick="AddDiv('Tabperiod'); return false;"><i class="fa fa-plus"></i> {{ __('Add price') }} </a>
                        </div>
                        -->
                    </div>

                    <br>

                    <div>
                        <table class="table table-bordered table-active" id="Tabperiod">
                            <thead>
                                <tr>
                                    <th>{{ __('Period') }}</th>
                                    <th>{{ __('Ads type') }}</th>
                                    <th>{{ __('Ads format') }}</th>
                                    <th>{{ __('Price') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>


                    @if(old('period_ads_types'))

                        @php
                            
                        $nbre = count(old('period_ads_types'));

                        for($i=0;$i<$nbre;$i++)
                        {

                            echo '<tr id="period_'.$i.'">
                            <td><select name="periods[]" class="custom-select col-12" required="required"><option value="">'.__('Select').'</option>';

                            foreach($periods as $period)
                            {
                                $name = json_decode($period->name,true)[config('app.locale')];

                                $sel_period = '';

                                if(old('periods')[$i] == $period->id)
                                {
                                    $sel_period = 'selected="selected"';
                                }

                                echo '<option value="'.$period->id.'" '.$sel_period.' >'.$name.'</option>';
                            }

                            echo '</select> </td><td>
                            <select name="period_ads_types[]" class="custom-select col-12" required="required"><option value="">'.__('Select').'</option>';

                            foreach($adsTypes as $adsType)
                            {
                                $name = json_decode($adsType->name,true)[config('app.locale')];

                                $sel_day_ads_types = '';

                                if(old('period_ads_types')[$i] == $adsType->id)
                                {
                                    $sel_day_ads_types = 'selected="selected"';
                                }

                                echo '<option value="'.$adsType->id.'" '.$sel_day_ads_types.' >'.$name.'</option>';
                            }

                            echo '</select> </td><td><select name="period_ads_formats[]" class="custom-select col-12" required="required"><option value="">'.__('Select').'</option>';

                            foreach($adsFormats as $adsFormat)
                            {

                                $name = json_decode($adsFormat->name,true)[config('app.locale')];

                                $sel_day_ads_formats = '';

                                if(old('period_ads_formats')[$i] == $adsFormat->id)
                                {
                                    $sel_day_ads_formats = 'selected="selected"';
                                }

                                echo '<option value="'.$adsFormat->id.'" '.$sel_day_ads_formats.' >'.$name.'</option>';
                            }

                            if($i > 0)
                            {
                                $delete = '<a href="#" onclick="test_suppression(\'period_'.$i.'\'); return false;" title="'.__('Delete').'">'.__('Delete').'</a>';
                            }
                            else
                            {
                                $delete = '';
                            }

                            echo '</select></td><td><input class="form-control" type="text" name="period_price[]" value="'.old('period_price')[$i].'"></td><td>'.$delete.'</td></tr>';

                        }

                        @endphp
                   
                   @else

                   @if ($channel->prices->where('period_id','!=',null)->count() > 0)

                    @php
                        $i = 0;
                    @endphp

                    @foreach ($channel->prices->where('period_id','!=',null) as $periodPrice)
                        
                        <tr id="period_{{$i}}">
                        <td>
                            <select name="periods[]" class="custom-select col-12" required="required">
                            
                            <option value="">{{ __('Select') }}</option>

                            @foreach($periods as $period)
                    
                                @if ($period->id == $periodPrice->period_id)

                                    <option value="{{ $period->id }}" selected="selected">{{ json_decode($period->name,true)[config('app.locale')] }}</option>
                                    
                                @else
                                    <option value="{{ $period->id }}">{{ json_decode($period->name,true)[config('app.locale')] }}</option>

                                @endif

                            @endforeach

                            </select>
                        </td>

                        <td>
                            <select name="period_ads_types[]" class="custom-select col-12" required="required">
                            
                            <option value="">{{ __('Select') }}</option>

                            @foreach($adsTypes as $adsType)

                                @if ($adsType->id == $periodPrice->ads_type_id)

                                    <option value="{{ $adsType->id }}" selected="selected">{{ json_decode($adsType->name,true)[config('app.locale')] }}</option>
                                    
                                @else
                                    <option value="{{ $adsType->id }}">{{ json_decode($adsType->name,true)[config('app.locale')] }}</option>

                                @endif

                            @endforeach

                            </select>
                        </td>

                        <td>
                            <select name="period_ads_formats[]" class="custom-select col-12" required="required">
                            
                            <option value="">{{ __('Select') }}</option>

                            @foreach($adsFormats as $adsFormat)

                                @if ($adsFormat->id == $periodPrice->ads_format_id)
                                    
                                    <option value="{{ $adsFormat->id}}" selected="selected">{{ json_decode($adsFormat->name,true)[config('app.locale')] }}</option>

                                @else

                                    <option value="{{ $adsFormat->id}}">{{ json_decode($adsFormat->name,true)[config('app.locale')] }}</option>
                                    
                                @endif
                        
                            @endforeach

                            </select>

                        </td>

                        <td> <input name="period_price[]" class="form-control" type="text" value="{{ $periodPrice->price }}"> </td>
                        
                        <td>
                        
                            @if ($i > 0)
                                <a href="#" onclick="test_suppression('period_{{ $i}}'); return false;" title="{{ __('Delete') }}">{{__('Delete')}}</a>
                            @else
                                
                            @endif
                        
                        </td>

                         @php
                            $i++;
                        @endphp

                    </tr>

                    @endforeach
                       
                   @else

                    <tr id="period_1">
                        <td>
                            <select name="periods[]" class="custom-select col-12" required="required">
                            
                            <option value="">{{ __('Select') }}</option>

                            {!! $list_periods !!}

                            </select>
                        </td>

                        <td>
                            <select name="period_ads_types[]" class="custom-select col-12" required="required">
                            
                            <option value="">{{ __('Select') }}</option>

                            @foreach($adsTypes as $adsType)
                    
                                <option value="{{ $adsType->id }}">{{ json_decode($adsType->name,true)[config('app.locale')] }}</option>

                            @endforeach

                            </select>
                        </td>

                        <td>
                            <select name="period_ads_formats[]" class="custom-select col-12" required="required">
                            
                            <option value="">{{ __('Select') }}</option>

                            @foreach($adsFormats as $adsFormat)

                                <option value="{{ $adsFormat->id}}">{{ json_decode($adsFormat->name,true)[config('app.locale')] }}</option>
                        
                            @endforeach

                            </select>

                        </td>

                        <td> <input name="period_price[]" class="form-control" type="text" value=""> </td>
                        
                        <td></td>

                    </tr>
                       
                   @endif

                   @endif

                     </tbody>
                    
                    </table>

                    <div class="form-group row">
                    <div class="pull-left">
                        <a href="#" class="btn btn-primary" onclick="AddDiv('Tabperiod'); return false;"><i class="fa fa-plus"></i> {{ __('Add price') }} </a>
                    </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-4 col-form-label"></label>
                        <div class="col-sm-12 col-md-8">
                            <input class="btn btn-primary" type="submit" value="{{ __('Save Ads price per period') }}">
                        </div>
                    </div>

                </div>
    
                </form>

            </div>
            <!-- Default Basic Forms End -->








        
            <script type="text/javascript">

                function AddDiv(indicTab) {

                    //alert(indicTab);
		
                    if(indicTab == "Tabday"){
                        var tableau = document.getElementById('Tabday');
                        var indicRow = 'day_';
                    }
                    else{
                        var tableau = document.getElementById('Tabperiod');
                        var indicRow = 'period_';
                    }
		
		            var trs = tableau.getElementsByTagName('tr').length; // on trouve le nombre des tr

                    // alert(trs);

                    if (trs > 1) {

                        var indice = trs - 1;

                        //alert(indice);

                        var id_dernier_trs = tableau.getElementsByTagName('tr').item(indice).id;

                        var TabNom = id_dernier_trs.split('_');

                        var No = parseInt(TabNom[1]); // on recupere le numero

                        var indic = parseInt(No + 1);

                        var NewIndice = indicRow + indic;

                        //alert(NewIndice);

                    } else {
                        var IndicRow1 = indicRow + '1';

                        var NewIndice = IndicRow1;

                        var indic = 1;

                    }

                    // alert(NewIndice);

                    var tr = document.createElement('tr');

                    tr.setAttribute('id', NewIndice);
                    

                    if(indicTab == "Tabday")
                    {
                        var list_types = '<?php echo $list_ads_type ?>';
                        var list_formats = '<?php echo $list_ads_format ?>';
		
                        var td1 = document.createElement('td');
                        td1.innerHTML = '<select name="day_ads_types[]" class="custom-select col-12" required="required"><option value="">Select</option>'+list_types+'</select>';
                        tr.appendChild(td1);

                        var td2 = document.createElement('td');
                        td2.innerHTML = '<select name="day_ads_formats[]" class="custom-select col-12" required="required"><option value="">Select</option>'+list_formats+'</select>';
                        tr.appendChild(td2);

                        var td3 = document.createElement('td');
                        td3.innerHTML = '<input name="day_price[]" class="form-control" type="text" value="" />';
                        tr.appendChild(td3);

                    }
                    else
                    {
                        var list_periods = '<?php echo $list_periods ?>';
                        var list_types = '<?php echo $list_ads_type ?>';
                        var list_formats = '<?php echo $list_ads_format ?>';

                        var td1 = document.createElement('td');
                        td1.innerHTML = '<select name="periods[]" class="custom-select col-12" required="required"><option value="">Select</option>'+list_periods+'</select>';
                        tr.appendChild(td1);

		
                        var td2 = document.createElement('td');
                        td2.innerHTML = '<select name="period_ads_types[]" class="custom-select col-12" required="required"><option value="">Select</option>'+list_types+'</select>';
                        tr.appendChild(td2);

                        var td3 = document.createElement('td');
                        td3.innerHTML = '<select name="period_ads_formats[]" class="custom-select col-12" required="required"><option value="">Select</option>'+list_formats+'</select>';
                        tr.appendChild(td3);

                        var td4 = document.createElement('td');
                        td4.innerHTML = '<input name="period_price[]" class="form-control" type="text" value="" />';
                        tr.appendChild(td4);

                    }

                    var td5 = document.createElement('td');
                    td5.innerHTML = '<a href="#" onclick="test_suppression(\'' + NewIndice + '\'); return false;" title="Delete">Delete</a>';
                    tr.appendChild(td5);

                    if (tableau.firstChild.tagName == 'tbody') {
                        tableau.firstChild.appendChild(tr);
                    } else {
                        tableau.appendChild(tr);
                    }

                    return false;


                }


                function suppression(ligne) {

                    // La suppression se fait en recuperent la ligne=noeud courant par son id ensuite on 
                    //recupere le noeud parent avec parentNode et enfin on supprime avec removeChild  
                    if (document.getElementById(ligne)) {

                        document.getElementById(ligne).parentNode.removeChild(document.getElementById(ligne));
                    }

                }


                function test_suppression(id) {
                    
                    var info = '<?php echo addslashes(__('Do you really want to delete?')) ?>';

                    if (confirm(info)) {
                        suppression(id);
                        return true;
                    } else {
                        return false;
                    }


                }
            </script>

        </div>
        @include('admin.layouts.footer')
    </div>
</div>

@endsection