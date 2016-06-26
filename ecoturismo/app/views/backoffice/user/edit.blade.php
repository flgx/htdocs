@extends('backoffice.layouts.master')

@section('styles')

@stop

@section('scripts')
	{{ HTML::script('/js/app/app.edit.js') }}
@stop

@section('section')
USUARIOS
@stop

@section('breadcrumb')
	<li><a href="{{ route('user')}}">Usuarios</a></li>
	<li class="active">Edición</li>
@stop

@section('content')

<div class="box box-warning">

    <div class="box-header">
        <h3 class="box-title">Edición de Usuario</h3>
    </div>

	{{ Form::open(['route' => ['user.update', $user['id']], 'method' => 'put', 'class' => 'form-horizontal', 'role' => 'form']) }}
    	@include('backoffice.user.form')
    {{ Form::close() }}
</div>

@stop