@extends('backoffice.layouts.master')

@section('styles')
	{{ HTML::style('/backoffice/css/select2/select2.css') }}
	{{ HTML::style('/backoffice/css/select2/select2-bootstrap.css') }}	
	{{ HTML::style('/app/css/jquery.raty.css') }}	
@stop

@section('scripts')
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
	{{ HTML::script('/backoffice/js/plugins/select2/select2.min.js') }}
	{{ HTML::script('/backoffice/js/app/app.edit.js') }}
	{{ HTML::script('/backoffice/js/app/app.location.js') }}
	{{ HTML::script('/backoffice/js/app/app.image.js') }}
	{{ HTML::script('/backoffice/js/plugins/flot/jquery.flot.min.js') }}
	{{ HTML::script('/backoffice/js/plugins/flot/jquery.flot.resize.min.js') }}
	{{ HTML::script('/backoffice/js/plugins/flot/jquery.flot.pie.min.js') }}
	{{ HTML::script('/backoffice/js/plugins/flot/jquery.flot.categories.min.js') }}
	{{ HTML::script('/app/js/jquery.raty.js') }}
	{{ HTML::script('/backoffice/js/app/app.ranking.js') }}
@stop

@section('section')
PUNTOS INTERACTIVOS
@stop

@section('breadcrumb')
	<li><a href="{{ route('location')}}">Puntos interactivos</a></li>
	<li class="active">Edición</li>
@stop

@section('content')

<div class="box box-warning">

    <div class="box-header">
        <h3 class="box-title">Edición de Puntos interactivos</h3>
    </div>

	{{ Form::open(['route' => ['location.update', $location['id']], 'method' => 'put', 'class' => 'form-horizontal', 'role' => 'form', 'files'=>true]) }}
    	@include('backoffice.location.form')
  
    		<div class="col-md-6">	

	        <div class="col-md-12 image-viewer">
				    <?php $count = 1;?>
				    <form id="theform"></form>

				    @if (isset($images))				    	
						@foreach($images as $index => $image)
							<form id="form{{$count}}" action="http://ecoturismo.com.ar/location/{{$image['location_image_id']}}/destroyImage" method="POST">
							   
								<img src="http://ecoturismo.com.ar/assets/images/location/{{ $image['image_id'] }}"  width="100%" />
							       
							  
							    <?php $count ++; ?>
							    <!-- MODAL -->
							    <i class="fa fa-btn fa-trash"></i>
								<input class="btn btn-danger" type='submit' value='Delete'>
					        </form>
						@endforeach					
					@endif
			
	   
	        </div>
		</div>
	  {{ Form::close() }}
</div>

@stop