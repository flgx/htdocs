@extends('backoffice.layouts.master')

@section('styles')

@stop

@section('scripts')
	{{ HTML::script('/js/app/app.edit.js') }}
@stop


@section('section')
ROLES
@stop

@section('breadcrumb')
	<li><a href="{{ route('role')}}">Roles</a></li>
	<li class="active">Creación</li>
@stop

@section('content')

<div class="box box-warning">

    <div class="box-header">
        <h3 class="box-title">Creación de Role</h3>
    </div>

	{{ Form::open(['route' => 'role.store', 'method' => 'post', 'class' => 'form-horizontal', 'role' => 'form']) }}
    	@include('backoffice.role.form')
    {{ Form::close() }}
</div>

@stop