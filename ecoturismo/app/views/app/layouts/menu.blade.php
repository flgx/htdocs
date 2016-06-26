<div class="col-md-1 general_menu startpage">
	@if(Auth::check())
		<a href="#" class="avatar" id="action_profile_content" data-show="0">
	        <img src="{{ asset('/app/img/no_ava.png')}}" alt="..."/>
	    </a>
	@endif

    <ul>
    	@foreach( $mainTags as $tag)
        <li>
            <center><a href="#" class="gradientmenu" data-action="getChildren" data-id="{{$tag['id']}}"><i class="{{$tag['icon']}}"></i></a></center>
        </li>
        @endforeach
    </ul>
</div>