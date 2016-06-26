@extends('backoffice.layouts.master')

@section('styles')

@stop

@section('scripts')
	{{ HTML::script('/js/app/app.edit.js') }}
@stop

@section('section')
PALABRAS PROHIBIDAS
@stop

@section('breadcrumb')
	<li> Edición de palabras prohibidas</li>
@stop

@section('content')

<div class="box box-warning">

    <div class="box-header">
        <h3 class="box-title">Edición de palabras prohibidas</h3>
    </div>
	<div class="callout callout-warning">
	    <h4>Información!</h4>
	    <p>El listado de palabras debe estar separadas por coma.</p>
	</div>

	{{ Form::open(['route' => 'badword.update', 'method' => 'put', 'class' => 'form-horizontal', 'role' => 'form']) }}

		<div class="box-body">   			
			<div class="form-group">
		        <label for="words" class="col-sm-2 control-label">Palabras prohibidas</label> 	
		        <div class="col-sm-10">
		            <textarea id="words" class="form-control" name="words" rows="10" placeholder="Ingresar las palabras prohibidas separadas por coma ','">{{{ isset($config['words']) ? $config['words'] : Input::old('words') }}}</textarea>
		        </div>
		    </div>  
		</div>

		<div class="box-footer clearfix">
		    <div class="pull-right">
		      <a href="{{ route('comments.admin') }}" class="btn btn-default" role="button"  data-toggle="tooltip" data-placement="top" title="Salir de la edición">Salir</a>
		      <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Guardar configuración">Guardar</button>
		    </div>
		</div>
    {{ Form::close() }}
</div>

@stop