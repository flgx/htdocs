@extends('backoffice.layouts.master')

@section('styles')
	{{ HTML::style('/backoffice/css/select2/select2.css') }}
	{{ HTML::style('/backoffice/css/select2/select2-bootstrap.css') }}	
@stop

@section('scripts')
	{{ HTML::script('/backoffice/js/plugins/select2/select2.min.js') }}
	{{ HTML::script('/backoffice/js/app/app.edit.js') }}
	{{ HTML::script('/backoffice/js/app/app.tag.js') }}
@stop

@section('section')
ETIQUETAS
@stop

@section('breadcrumb')
	<li><a href="{{ route('tag')}}">Etiquetas</a></li>
	<li class="active">Edición</li>
@stop

@section('content')

<div class="box box-warning">

    <div class="box-header">
        <h3 class="box-title">Edición de Etiquetas</h3>
    </div>

	{{ Form::open(['route' => ['tag.update', $tag['id']], 'method' => 'put', 'class' => 'form-horizontal', 'role' => 'form']) }}
    	@include('backoffice.tag.form')
    {{ Form::close() }}
</div>

@stop