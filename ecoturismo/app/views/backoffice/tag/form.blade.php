	<div class="box-body">    	
	<div class="row">				
		<div class="col-md-6">
            <div class="form-group @if($errors->has('name')) has-error @endif">
            	<label for="name" class="col-sm-2 control-label">Nombre</label>
			    <div class="col-sm-10">
			    	<div class="input-group">
                		<div class="input-group-addon">
                            <i class="fa fa-tag"></i>
                        </div>
			      		<input type="text" class="form-control" name="name" id="name" value="{{{ isset($tag['name']) ? $tag['name'] : Input::old('name') }}}" placeholder="Ingresar el nombre de la etiqueta">
			      	</div>
			      	{{ $errors->first('name', '<label class="control-label" for="name"><i class="fa fa-times-circle-o"></i> :message </label>') }}	
			    </div>
            </div>
        </div>
    </div>
	
	<?php $parent_tag_id = isset($tag['parent_tag_id']) ? $tag['parent_tag_id'] : Input::old('parent_tag_id') ?>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group @if($errors->has('parent_tag_id')) has-error @endif">
                <label for="parent_tag_id" class="col-sm-2 control-label">Padre</label>
                <div class="col-sm-10">
	                <select class="form-control" name="parent_tag_id" id="parent_tag_id">
	                    <option value="0">Seleccionar...</option>
	                    @foreach($parentTags as $parentTag)
	                    	<option value="{{{$parentTag['id']}}}" {{{ ($parent_tag_id == $parentTag['id']) ? 'selected' : '' }}} >{{{$parentTag['name']}}}</option>
	                    @endforeach
	                </select>
	                {{ $errors->first('parent_tag_id', '<label class="control-label" for="parent_tag_id"><i class="fa fa-times-circle-o"></i> :message </label>') }}	
	            </div>
            </div>
		</div>
	</div>
	
	<?php $markerSelected = isset($tag['marker']) ? $tag['marker'] : Input::old('marker') ?>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group @if($errors->has('marker')) has-error @endif">
                <label for="marker" class="col-sm-2 control-label">Marcador</label>
                <div class="col-sm-10">
	                <select class="form-control" name="marker" id="marker">
	                    <option value="">Seleccionar</option>
	                    @foreach($markers as $marker) 
	                    	<option value="{{{$marker['id']}}} {{{ ($markerSelected == $marker['id']) ? 'selected' : '' }}}"><img src="./app/img/icon/{{{$marker['name']}}}" alt="">{{{$marker['name']}}}</option>
	                    @endforeach
	                </select>
	                {{ $errors->first('marker', '<label class="control-label" for="marker"><i class="fa fa-times-circle-o"></i> :message </label>') }}	
	            </div>
            </div>
		</div>
	</div>
	
	<?php $iconSelected = isset($tag['icon']) ? $tag['icon'] : Input::old('icon') ?>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group @if($errors->has('icon')) has-error @endif">
                <label for="icon" class="col-sm-2 control-label">Icono</label>
                <div class="col-sm-10">
	                <select class="form-control" name="icon" id="icon">
	                    <option value="">Seleccionar</option>
	                    @foreach($icons as $icon)  
	                    	<option value="{{{$icon['id']}}}"   > {{{ ($iconSelected == $icon['id']) ? 'selected' : '' }}} {{{$icon['name']}}}  </option>
	                    @endforeach
	                </select>
	                {{ $errors->first('icon', '<label class="control-label" for="marker"><i class="fa fa-times-circle-o"></i> :message </label>') }}	
	            </div>
            </div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group @if($errors->has('icon')) has-error @endif">
                <label for="icon" class="col-sm-2 control-label">USER ID</label>
                <div class="col-sm-10">
			      	<input type="text" class="form-control" name="user_created_id" id="user_created_id" value="<?php echo $user_created_id; ?>">

	            </div>
            </div>
		</div>
	</div>

</div>

<div class="box-footer clearfix">
    <div class="pull-right">
      <a href="{{ route('tag') }}" class="btn btn-default" role="button"  data-toggle="tooltip" data-placement="top" title="Volver al listado de etiquetas">Cancelar</a>
      <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Guardar los datos de la etiqueta">Guardar</button>
    </div>
</div>