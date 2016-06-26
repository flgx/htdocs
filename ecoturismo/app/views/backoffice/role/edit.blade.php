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
	<li><a href="{{ route('role') }}">Roles</a></li>
	<li class="active">Edición</li>
@stop

@section('content')

<div class="box box-warning">

    <div class="box-header">
        <h3 class="box-title">Edición de Role</h3>
    </div>

	{{ Form::open(['route' => ['role.update', $role['id']], 'method' => 'put', 'class' => 'form-horizontal', 'role' => 'form']) }}
    	@include('backoffice.role.form')
    {{ Form::close() }}
</div>

@stop