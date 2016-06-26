<div id="sidebar" @if(Session::has('showSideBar')) class="open-sidebar" @endif >
	<i class="fa fa-close fa-2x" id="btn-close-sidebar" data-toggle="tooltip" data-placement="left" title="Cerrar"></i>

		@include('app.layouts.index')
		@include('app.layouts.routes')
		@include('app.layouts.contact')
		<div id="location-content" class="sidebar-content" @if(Session::has('showLocation')) style="display:block" @endif></div>
		
		@if( ! Auth::check() )			
			@include('app.layouts.login')
			@include('app.layouts.register')
			@include('app.password.remind')
			@include('app.password.reset')
			@include('app.password.reset')
		@else 
			@include('app.layouts.profile')
		@endif
		<?php /* @include('app.layouts.tags') */ ?>

</div>