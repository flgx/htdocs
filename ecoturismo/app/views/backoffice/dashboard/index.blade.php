@extends('backoffice.layouts.master')

@section('styles')
	{{ HTML::style('/app/css/jquery.raty.css') }} 
@stop

@section('scripts')
	{{ HTML::script('/app/js/jquery.raty.js') }}
    {{ HTML::script('/backoffice/js/app/app.ranking.js') }}
@stop

@section('section')
DASHBOARD
@stop

@section('breadcrumb')
<li class="active">Dashboard</li>
@stop


@section('content')
<div class="clearfix"></div>
<div class="box">
	<div class="row">
		<div class="col-md-12">
	    	<center>
	    		<div style="width:40%; display:inline-block">
	    			<h3 class="pull-left">Puntos interactivos más visitados</h3>
		        </div>
		        <table style="width:80%" class="table table-striped table-bordered">
		        	<thead>
				        <tr>
				          <th style="width:50px">#</th>
				          <th>Nombre</th>
				          <th style="width:120px">Puntuación</th>
				        </tr>
				    </thead>
		        @foreach($pointsViews as $index => $points)
		        	<tr>
		        		<td>
		        			{{ $index + 1 }}
		        		</td>
		        		<td>
		        			{{ $points['name'] }}
		        		</td>
		        		<td>
		        			<strong> {{ $points['views'] }}</strong>		        			
		        		</td>
		        	</tr>
		        @endforeach
		        </table>
	        </center>
	    </div>
    </div>

	<div class="row">
		<div class="col-md-12">
	    	<center>
	    		<div style="width:40%; display:inline-block">
	    			<h3 class="pull-left">Puntos interactivos mejor rankeados</h3>
		        </div>
		        <table style="width:80%" class="table table-striped table-bordered">
		        	<thead>
				        <tr>
				          <th style="width:50px">#</th>
				          <th>Nombre</th>
				          <th style="width:120px">Puntuación</th>
				        </tr>
				    </thead>
		        @foreach($pointsRanked as $index => $points)
		        	<tr>
		        		<td>
		        			{{ $index + 1 }}
		        		</td>
		        		<td>
		        			{{ $points['name'] }}
		        		</td>
		        		<td>
		        			<div class="ranking" data-ranking="{{ $points['ranking'] }}"></div>		        			
		        		</td>
		        	</tr>
		        @endforeach
		        </table>
	        </center>
	    </div>
    </div>
</div>
@stop