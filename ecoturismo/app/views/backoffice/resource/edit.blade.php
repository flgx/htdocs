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
	<li class="active">Edición</li>
@stop

@section('content')

<div class="box box-warning">

    <div class="box-header">
        <h3 class="box-title">Edición de Recurso</h3>
    </div>

	{{ Form::open(['route' => ['resource.update', $resource['id']], 'method' => 'put', 'class' => 'form-horizontal', 'role' => 'form']) }}
    	@include('backoffice.resource.form')
    {{ Form::close() }}
</div>

@stop