@extends('backoffice.layouts.master')

@section('styles')

@stop

@section('scripts')
@stop

@section('section')
RECURSOS DE SISTEMA
@stop

@section('breadcrumb')
	<li><a href="{{ route('resource')}}">Recursos</a></li>
	<li class="active">Creación</li>
@stop

@section('content')

<div class="box box-warning">

    <div class="box-header">
        <h3 class="box-title">Creación de Recurso</h3>
    </div>

	{{ Form::open(['route' => 'resource.store', 'method' => 'post', 'class' => 'form-horizontal', 'role' => 'form']) }}
    	@include('backoffice.resource.form')
    {{ Form::close() }}
</div>

@stop