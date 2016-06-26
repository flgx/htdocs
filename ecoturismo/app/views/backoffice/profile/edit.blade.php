@extends('backoffice.layouts.master')

@section('styles')

@stop

@section('scripts')
	{{ HTML::script('/js/app/app.edit.js') }}
@stop

@section('section')
PERFIL
@stop

@section('breadcrumb')
	<li> Edición de perfil</li>
@stop

@section('content')

<div class="box box-warning">

    <div class="box-header">
        <h3 class="box-title">Edición de Perfil</h3>
    </div>

	{{ Form::open(['route' => 'profile.update', 'method' => 'put', 'class' => 'form-horizontal', 'role' => 'form']) }}

		<div class="box-body">    	
			<div class="row">				
				<div class="col-md-6">
		            <div class="form-group @if($errors->has('first_name')) has-error @endif">
		            	<label for="first_name" class="col-sm-2 control-label">Nombre</label>
					    <div class="col-sm-10">
					    	<div class="input-group">
		                		<div class="input-group-addon">
		                            <i class="fa fa-user"></i>
		                        </div>
					      		<input type="text" class="form-control" name="first_name" id="first_name" value="{{{ isset($profile['first_name']) ? $profile['first_name'] : '' }}}" placeholder="Ingresar nombre">
					      	</div>
					      	{{ $errors->first('first_name', '<label class="control-label" for="first_name"><i class="fa fa-times-circle-o"></i> :message </label>') }}	
					    </div>
		            </div>
		        </div>
		    </div>

			<div class="row">	
				<div class="col-md-6">
		            <div class="form-group @if($errors->has('last_name')) has-error @endif">
		            	<label for="last_name" class="col-sm-2 control-label">Apellido</label>
					    <div class="col-sm-10">
					    	<div class="input-group">
		                		<div class="input-group-addon">
		                            <i class="fa fa-user"></i>
		                        </div>
					      		<input type="text" class="form-control" name="last_name" id="last_name" value="{{{ isset($profile['last_name']) ? $profile['last_name'] : '' }}}" placeholder="Ingresar apellido">
					      	</div>
					      	{{ $errors->first('last_name', '<label class="control-label" for="last_name"><i class="fa fa-times-circle-o"></i> :message </label>') }}	
					    </div>
		            </div>
		        </div>
			</div>

			<div class="row">	
				<div class="col-md-6">
		            <div class="form-group @if($errors->has('password')) has-error @endif">
		            	<label for="password" class="col-sm-2 control-label">Clave</label>
					    <div class="col-sm-10">
		                	<div class="input-group">
		                		<div class="input-group-addon">
		                            <i class="fa fa-lock"></i>
		                        </div>
					      		<input type="password" class="form-control" name="password" id="password" value="" placeholder="Ingresar clave">
					      	</div>
					      	{{ $errors->first('password', '<label class="control-label" for="password"><i class="fa fa-times-circle-o"></i> :message </label>') }}	
					    </div>
		            </div>
		        </div>
			</div>

			<div class="row">	
				<div class="col-md-6">
		            <div class="form-group @if($errors->has('password_confirmation')) has-error @endif">
		            	<label for="password_confirmation" class="col-sm-2 control-label">Confirmación</label>
					    <div class="col-sm-10">
		                	<div class="input-group">
		                		<div class="input-group-addon">
		                            <i class="fa fa-lock"></i>
		                        </div>
					      		<input type="password" class="form-control" name="password_confirmation" id="password_confirmation" value="" placeholder="Repetir clave">
					      	</div>
					      	{{ $errors->first('password_confirmation', '<label class="control-label" for="password_confirmation"><i class="fa fa-times-circle-o"></i> :message </label>') }}	
					    </div>
		            </div>
		        </div>
			</div>

		</div>

		<div class="box-footer clearfix">
		    <div class="pull-right">
		      <a href="{{ route('dashboard') }}" class="btn btn-default" role="button"  data-toggle="tooltip" data-placement="top" title="Salir de la edición">Salir</a>
		      <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Guardar los datos de su perfil">Guardar</button>
		    </div>
		</div>
    {{ Form::close() }}
</div>

@stop