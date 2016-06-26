@extends('backoffice.layouts.master')

@section('styles')
	{{ HTML::style('/backoffice/css/select2/select2.css') }}
	{{ HTML::style('/backoffice/css/select2/select2-bootstrap.css') }}	
@stop

@section('scripts')
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
	<style>
	.gmnoprint img {
    max-width: none; 
	}
</style>
	{{ HTML::script('/backoffice/js/plugins/select2/select2.min.js') }}
	{{ HTML::script('/backoffice/js/app/app.edit.js') }}
	{{ HTML::script('/backoffice/js/app/app.location.js') }}
	{{ HTML::script('/backoffice/js/app/app.image.js') }}
@stop



	

@section('section')
PUNTOS INTERACTIVOS
@stop

@section('breadcrumb')
	<li><a href="{{ route('location')}}">Puntos interactivos</a></li>
	<li class="active">Creación</li>
@stop

@section('content')

<div class="box box-warning">

    <div class="box-header">
        <h3 class="box-title">Creación de puntos interactivos</h3>
    </div>
	
	{{ Form::open(['route' => 'location.store', 'method' => 'post', 'class' => 'form-horizontal', 'role' => 'form', 'files'=> true ]) }}
    	@include('backoffice.location.form')
    {{ Form::close() }}
</div>

@stop