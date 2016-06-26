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
			      		<input type="text" class="form-control" name="first_name" id="first_name" value="{{{ isset($user['first_name']) ? $user['first_name'] : Input::old('first_name') }}}" placeholder="Ingresar el nombre">
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
			      		<input type="text" class="form-control" name="last_name" id="last_name" value="{{{ isset($user['last_name']) ? $user['last_name'] : Input::old('last_name') }}}" placeholder="Ingresar el apellido">
			      	</div>
			      	{{ $errors->first('last_name', '<label class="control-label" for="last_name"><i class="fa fa-times-circle-o"></i> :message </label>') }}	
			    </div>
            </div>
        </div>
	</div>

	<div class="row">	
		<div class="col-md-6">
            <div class="form-group @if($errors->has('email')) has-error @endif">
            	<label for="email" class="col-sm-2 control-label">Correo</label>
			    <div class="col-sm-10">
                	<div class="input-group">
                		<div class="input-group-addon">
                            <i class="fa fa-envelope"></i>
                        </div>
			      		<input type="email" class="form-control" name="email" id="email" value="{{{ isset($user['email']) ? $user['email'] : Input::old('email') }}}" placeholder="Ingresar el correo">
			      	</div>
			      	{{ $errors->first('email', '<label class="control-label" for="email"><i class="fa fa-times-circle-o"></i> :message </label>') }}	
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
	
	<?php $role_id = isset($user['role_id']) ? $user['role_id'] : Input::old('role_id') ?>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group @if($errors->has('role_id')) has-error @endif">
                <label for="role_id" class="col-sm-2 control-label">Role</label>
                <div class="col-sm-10">
	                <select class="form-control" name="role_id" id="role_id">
	                    <option>Seleccionar...</option>
	                    @foreach($roles as $role)
	                    	<option value="{{{$role['id']}}}" {{{ ($role_id == $role['id']) ? 'selected' : '' }}} >{{{$role['name']}}}</option>
	                    @endforeach
	                </select>
	                {{ $errors->first('role_id', '<label class="control-label" for="role_id"><i class="fa fa-times-circle-o"></i> :message </label>') }}	
	            </div>
            </div>
		</div>
	</div>


	<div class="row">	
		<div class="col-md-6">
            <div class="form-group @if($errors->has('enabled')) has-error @endif">
            	<label for="enabled" class="col-sm-2 control-label">Habilitado</label>
			    <div class="col-sm-10">
			      	<div class="checkbox">
				      	<input type="checkbox" class="enabled" name="enabled" value="1" {{{ (isset($user['enabled']) && $user['enabled']) ? 'checked' : '' }}} />
				    </div>
				    {{ $errors->first('enabled', '<label class="control-label" for="enabled"><i class="fa fa-times-circle-o"></i> :message </label>') }}
			    </div>
			</div>
        </div>
	</div>

</div>

<div class="box-footer clearfix">
    <div class="pull-right">
      <a href="{{ route('user') }}" class="btn btn-default" role="button"  data-toggle="tooltip" data-placement="top" title="Volver al listado de usuarios">Cancelar</a>
      <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Guardar los datos del usuario">Guardar</button>
    </div>
</div>