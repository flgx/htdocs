<div id="routes-content" class="sidebar-content" @if(Session::has('showRoutes')) style="display:block" @endif>
	<fieldset  class="sidebar-top-content">
        <legend><i class="fa fa-road"></i> &nbsp;Calcular rutas !</legend>
        <br>

        <p>
            Lorem ipsum dolor sit amet, nec no tota minimum, debet labore oporteat pri id. 
            Vis ad altera aperiam, eam omnium eleifend ex. An eos quot nihil intellegam, fugit 
            omittam quaestio ei vim. Deleniti senserit adipiscing vim in, exerci libris democritum cu duo. Meis 
            illum graece ad cum.
        </p>

        <br>
        	<div class="checkbox" style="display:inline-block">
                <label>
                    <input id="route-from-my-location" type="checkbox" name="my-location"/>
                    Desde mi ubicación 
                </label>
            </div>
            &nbsp;&nbsp;<i style="cursor:pointer" class="fa fa-info-circle text-primary" data-toggle="popover" title="Información" data-placement="top" data-content="Para poder calcular una ruta desde su úbicación actual, primero debe tildar la opción 'Desde mi ubicación'."></i>

            <div class="form-group" id="start-route-container">
                <label for="route-start" class="col-sm-2 select-label">Desde</label>
                <div class="col-sm-10">
	                <select class="form-control" name="route-start" id="route-start">
	                    <option value="0">Seleccionar desde...</option>
	                    @foreach( $allLocations as $location)
	                    	<option value="{{$location['lat']}},{{$location['lng']}}">{{$location['value']}}</option>
	                    @endforeach
	                </select>
	            </div>
            </div>

            <div class="form-group">
	        	<label for="route-end" class="col-sm-2 select-label">Hasta</label>
	        	<div class="col-sm-10">
		            <select class="form-control" name="route-end" id="route-end">
		                <option value="0">Seleccionar hasta ...</option>
		                @foreach( $allLocations as $location)
		                    <option value="{{$location['lat']}},{{$location['lng']}}">{{$location['value']}}</option>
		                @endforeach
		            </select> 
		        </div>
            </div>
            @if( Auth::check())
                <button id="calculate-route" class="btn btn-success btn-lg btn-block">Calcular</button>
            @else 
                <button id="calculate-route-without-auth" class="btn btn-success btn-lg btn-block">Calcular</button>
            @endif
        </form>
    </fieldset>
    <br>
    <fieldset id="route-fieldset-container">
        <legend>Ruta Calculada</legend>
    	<div id="routes-directions-panel"></div>
    </fieldset>
</div>
