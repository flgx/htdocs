<div class="box-body">    	
    <div class="row">				
        <div class="col-md-6">
            <div class="form-group @if($errors->has('name')) has-error @endif">
                <label for="name" class="col-sm-2 control-label">Nombre</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" id="name" value="{{{ isset($role['name']) ? $role['name'] : Input::old('name') }}}" placeholder="Ingresar el nombre del role">
                    {{ $errors->first('name', '<label class="control-label" for="name"><i class="fa fa-times-circle-o"></i> :message </label>') }}	
                </div>
            </div>
        </div>
    </div>
</div>

<div class="box-header">
    <h3 class="box-title">Recursos disponibles</h3>
</div>
<div class="box-body">      
    <div class="row">
        <div class="col-md-12">
            <?php $id = isset($role['id']) ? $role['id'] : '' ?>
            {{ App::make('RoleController')->toCheck($id); }}
        </div>
    </div>
</div>


<div class="box-footer clearfix">
    <div class="pull-right">
        <a href="{{ route('role') }}" class="btn btn-default" role="button"  data-toggle="tooltip" data-placement="top" title="Volver al listado de roles">Cancelar</a>
        <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Guardar los datos del role">Guardar</button>
    </div>
</div>