<div class="box-body">    	
	<div class="row">				
		<div class="col-md-6">
            
            <div class="form-group @if($errors->has('name')) has-error @endif">
            	<label for="name" class="col-sm-2 control-label">Nombre</label>
			    <div class="col-sm-10">
			    	<div class="input-group">
                		<div class="input-group-addon">
                            <i class="fa fa-thumb-tack"></i>
                        </div>
			      		<input type="text" class="form-control" name="name" id="name" value="{{{ isset($location['name']) ? $location['name'] : Input::old('name') }}}" placeholder="Ingresar el nombre del punto interactivo">
			      	</div>
			      	{{ $errors->first('name', '<label class="control-label" for="name"><i class="fa fa-times-circle-o"></i> :message </label>') }}	
			    </div>
            </div>

			<?php $tagsSelected = isset($location['tags']) ? $location['tags'] : Input::old('tags') ?>
			<div class="form-group @if($errors->has('tags')) has-error @endif">
                <label for="tags" class="col-sm-2 control-label">Etiquetas</label>
                <div class="col-sm-10">
	                <select multiple class="form-control" name="tags[]" id="tags">
	                    @foreach($tags as $tag)
	                    	<option value="{{{$tag['id']}}}" 

	                    		@if($tagsSelected)
		                    		@foreach( $tagsSelected as $selected)
		                    			{{{ ($selected == $tag['id']) ? 'selected' : '' }}} 
		                    		@endforeach
		                    	@endif

	                    	>{{{$tag['name']}}}</option>
	                    @endforeach
	                </select>
	                {{ $errors->first('tags', '<label class="control-label" for="tags"><i class="fa fa-times-circle-o"></i> :message </label>') }}	
	            </div>
            </div>
			<div class="form-group @if($errors->has('tags')) has-error @endif">
                <label for="tags" class="col-sm-2 control-label">URL</label>
                <div class="col-sm-10">
					<input type="text" class="form-control" name="url" id="url" value="{{{ isset($location['url']) ? $location['url'] : Input::old('url') }}}" placeholder="Ingresar url">
	            </div>
            </div>

			<div class="form-group @if($errors->has('lat')) has-error @endif @if($errors->has('lng')) has-error @endif">
		        <label for="lat" class="col-sm-2 control-label">Latitud</label>
		        <div class="col-sm-3">
		            <input type="text" class="form-control" name="lat" id="lat_input" value="{{{ isset($location['lat']) ? $location['lat'] : Input::old('lat') }}}" placeholder="Ingresar la latitud del punto interactivo">		            
		        </div>
		        <label for="lat" class="col-sm-2 control-label">Longitud</label>
		        <div class="col-sm-3">
		            <input type="text" class="form-control" name="lng" id="lng_input" value="{{{ isset($location['lng']) ? $location['lng'] : Input::old('lng') }}}" placeholder="Ingresar la longitud del punto interactivo">		               
		        </div>
		        <div class="col-sm-2" style="text-align:right;">
		        	<button id="btn-show-map" style="padding: 4px 9px;" type="button" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Seleccionar coordenadas"><i class="btn fa fa-globe" style="font-size:2em; padding: 0px;"></i></button>
		        </div>
		        {{ $errors->first('lat', '<label class="control-label" for="lat"><i class="fa fa-times-circle-o"></i> :message </label><br>') }}    
		        {{ $errors->first('lng', '<label class="control-label" for="lng"><i class="fa fa-times-circle-o"></i> :message </label>') }} 
		    </div>
		    


		    <div class="form-group @if($errors->has('description')) has-error @endif">
		        <label for="description" class="col-sm-2 control-label">Descripción</label>
		        <div class="col-sm-10">
		            <textarea id="description" class="form-control" name="description" rows="10" placeholder="Ingresar una breve descripción">{{{ isset($location['description']) ? $location['description'] : Input::old('description') }}}</textarea>
		            {{ $errors->first('description', '<label class="control-label" for="description"><i class="fa fa-times-circle-o"></i> :message </label>') }}    
		        </div>
		    </div>  


            <div class="form-group @if($errors->has('enabled')) has-error @endif">
            	<label for="enabled" class="col-sm-2 control-label">Habilitado</label>
			    <div class="col-sm-10">
			      	<div class="checkbox">
				      	<input type="checkbox" class="enabled" name="enabled" value="1" {{{ (isset($location['enabled']) && $location['enabled']) ? 'checked' : '' }}} />
				    </div>
				    {{ $errors->first('enabled', '<label class="control-label" for="enabled"><i class="fa fa-times-circle-o"></i> :message </label>') }}
			    </div>
			</div>

			@if (isset($location['id']))
		    <div class="form-group">
		        <label for="description" class="col-sm-2 control-label">Ranking</label>
		        <div class="col-sm-10" style="padding-top:7px;">
		        	<div class="ranking" data-ranking="{{ $location['ranking']}}"></div>
		        </div>
		    </div>

		    <div class="form-group">
		        <label for="description" class="col-sm-2 control-label">Visitas</label>
		        <div class="col-sm-10" style="padding-top:7px;">
		        	{{ $location['views']}}
		        </div>
		    </div>  
		    @endif
		</div>

		<div class="col-md-6">	

	        <div class="col-md-12 image-viewer">
		
			
	            <div class="form-group @if($errors->has('image')) has-error @endif">
	                <div class="col-sm-10">
	                    <br>
	                    <input type="file" id="image" name="image[]" multiple>
	                    <p class="help-block">Seleccione una imágen que no supere los {{ Config::get('app.image.max-size')}}KB</p>
	                    <p class="help-block">Tamaño recomendado: 739px X 298px o proporcional</p>
	                    {{ $errors->first('image', '<label class="control-label" for="image"><i class="fa fa-times-circle-o"></i> :message </label>') }}   
	                </div>
	            </div>
	        </div>
		</div>
	</div>
</div>

<div class="box-footer clearfix">
    <div class="pull-right">
      <a href="{{ route('location') }}" class="btn btn-default" role="button"  data-toggle="tooltip" data-placement="top" title="Volver al listado de puntos interactivos">Cancelar</a>
      <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Guardar los datos del punto interactivo">Guardar</button>
    </div>
</div>

<!-- MODAL -->

@include('backoffice.location.selectcoordinates')