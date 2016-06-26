<div class="box-body">    	
	<div class="row">				
		<div class="col-md-6">
            <div class="form-group @if($errors->has('module')) has-error @endif">
            	<label for="module" class="col-sm-2 control-label">Modulo</label>
			    <div class="col-sm-10">
			    	<div class="input-group">
                		<div class="input-group-addon">
                            <i class="fa fa-folder"></i>
                        </div>
			      		<input type="text" class="form-control" name="module" id="module" value="{{{ isset($resource['module']) ? $resource['module'] : Input::old('module') }}}" placeholder="Ingresar el nombre del modulo">
			      	</div>
			      {{ $errors->first('module', '<label class="control-label" for="module"><i class="fa fa-times-circle-o"></i> :message </label>') }}	
			    </div>
            </div>
        </div>
    </div>

	<div class="row">	
		<div class="col-md-6">
            <div class="form-group @if($errors->has('action')) has-error @endif">
            	<label for="action" class="col-sm-2 control-label">acción</label>
			    <div class="col-sm-10">
			    	<div class="input-group">
                		<div class="input-group-addon">
                            <i class="fa fa-cogs"></i>
                        </div>
			      		<input type="text" class="form-control" name="action" id="action" value="{{{ isset($resource['action']) ? $resource['action'] : Input::old('action') }}}" placeholder="Ingresar el nombre de la acción">
			      	</div>
			      {{ $errors->first('action', '<label class="control-label" for="action"><i class="fa fa-times-circle-o"></i> :message </label>') }}	
			    </div>
            </div>
        </div>
	</div>
</div>

<div class="box-footer clearfix">
    <div class="pull-right">
      <a href="{{ route('resource') }}" class="btn btn-default" role="button"  data-toggle="tooltip" data-placement="top" title="Volver al listado de recursos">Cancelar</a>
      <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Guardar los datos del recurso">Guardar</button>
    </div>
</div>