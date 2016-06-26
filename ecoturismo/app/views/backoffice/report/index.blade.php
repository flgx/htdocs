@extends('backoffice.layouts.master')

@section('styles')
	{{ HTML::style('/backoffice/css/datepicker/datepicker3.css') }}
@stop

@section('scripts')	
	{{ HTML::script('/backoffice/js/plugins/datepicker/bootstrap-datepicker.js') }}
	{{ HTML::script('/backoffice/js/app/app.report.js') }}
@stop

@section('section')
REPORTES
@stop

@section('breadcrumb')
<li class="active">Reportes</li>
@stop

@section('content')
<div class="box box-success">
    <div class="box-body text-right">
        <a class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Salir al dashboard" href="{{ route('dashboard'); }}"><i class="fa  fa-sign-out"></i></a>
    </div>
</div>

<div class="clearfix"></div>
<div class="box">
	{{ Form::open(['route' => ['report.generate'], 'method' => 'post', 'class' => 'form-horizontal', 'role' => 'form']) }}
		<div class="box-body">    			

			<div class="row">
		        <div class="col-md-6">
		            <div class="form-group @if($errors->has('report')) has-error @endif">
		                <label for="report" class="col-sm-3 control-label">Tipo de reporte</label>
		                <div class="col-sm-9">
		                    <select class="form-control" name="report" id="report">
		                        <option value="ranking">Por Ranking</option>
		                        <option value="views">Por Visitas</option>
		                    </select>		                     
		                </div>
		            </div>
		        </div>	
				<div class="col-md-6">
					<div class="form-group @if($errors->has('start') || $errors->has('end')) has-error @endif">
						<label for="type" class="col-sm-4 control-label">
							Rango
							&nbsp;&nbsp;<i style="cursor:pointer" id="btn-info-range" class="fa fa-info-circle text-primary" data-toggle="tooltip" data-placement="top" title="El rango de fecha filtra los puntos interactivos por fecha de creación."></i>
						</label>
						<div class="col-sm-8" id="datepicker-container">
							<div class="input-daterange input-group" id="datepicker">
							    <input type="text" class="input-sm form-control" name="start" placeholder="Ingrese fecha desde" />
							    <span class="input-group-addon">a</span>
							    <input type="text" class="input-sm form-control" name="end"  placeholder="Ingrese fecha hasta" />			    
							</div>							
						</div>
					</div>
		        </div>
			</div>
		</div>
		<div class="row form-group @if($errors->has('start') || $errors->has('end')) has-error @endif">
			<div style="margin-left:20px;" class=" col-md-10">
				{{ $errors->first('report', '<br><label class="control-label" for="report"><i class="fa fa-times-circle-o"></i> :message </label>') }} 
				{{ $errors->first('start', '<br><label class="control-label" for="range"><i class="fa fa-times-circle-o"></i> :message </label>') }} 
				{{ $errors->first('end', '<br><label class="control-label" for="range"><i class="fa fa-times-circle-o"></i> :message </label>') }} 
			</div>
		</div>
		<input type="hidden" value="csv" name="type"/>
		<div class="box-footer clearfix">
		    <div class="pull-right">
		      <a href="{{ route('dashboard') }}" class="btn btn-default" role="button"  data-toggle="tooltip" data-placement="top" title="Volver al dashboard">Cancelar</a>
		      <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Descargar reporte">Descargar</button>
		    </div>
		</div>

    {{ Form::close() }}
</div>
@stop