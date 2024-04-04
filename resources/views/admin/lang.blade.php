
<li class="nav-item dropdown list-inline-item">
    
	<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
		
		@php $lang = config('app.supported_locales'); @endphp
		
		@foreach($lang as $key=>$val)
		 @if($locale == $key)
		    <img src="{{asset('flags/'.$key.'.png')}}" width="25px"> {{ $val }}
		 @endif
		@endforeach
		
		<!--
		@if($locale == 'en')
		<img src="{{asset('flags/en.png')}}" width="25px"> English
		@elseif($locale == "fr")
		<img src="{{asset('flags/fr.png')}}" width="25px"> Français
		@else
		<img src="{{asset('flags/fr.png')}}" width="25px"> Français
		@endif
		-->

		<span class="caret"></span>
	</a>
	<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
	     
	     @foreach($lang as $key=>$val)
		    <a class="dropdown-item" href="../lang/{{ $key }}"><img src="{{ asset('flags/'.$key.'.png') }}" width="25px"> {{ $val }}</a>
		 @endforeach
	</div>
</li>