@extends('backoffice.layouts.master')

@section('styles')
    {{ HTML::style('/backoffice/css/datatables/dataTables.bootstrap.css') }}
    {{ HTML::style('/app/css/jquery.raty.css') }} 
@stop

@section('scripts')
    {{ HTML::script('/backoffice/js/plugins/datatables/jquery.dataTables.js') }}
    {{ HTML::script('/backoffice/js/plugins/datatables/dataTables.bootstrap.js') }}
    {{ HTML::script('/backoffice/js/app/app.table.js') }}
    {{ HTML::script('/app/js/jquery.raty.js') }}
    {{ HTML::script('/backoffice/js/app/app.ranking.js') }}
    {{ HTML::script('/backoffice/js/app/app.comments.js') }}
@stop

@section('section')
COMENTARIOS
@stop

@section('breadcrumb')
<li class="active">Comentarios</li>
@stop

@section('content')
<div class="box box-success">
    <div class="box-body text-right">

        <a class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="Configurar palabras prohibidas" href="{{ route('badword'); }}"><i class="fa fa-shield"></i></a>
        &nbsp;

        <a class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Salir al dashboard" href="{{ route('dashboard'); }}"><i class="fa  fa-sign-out"></i></a>
    </div>
</div>

<div class="clearfix"></div>
<div class="box">

    @if(BackofficeResource::can('comentarios', 'read'))
    <div class="box-body table-responsive">
        <table id="data-table" 
               class="table table-bordered table-striped table-hover"
               data-url-request="/admin/comment/list"

               data-display-length="{{{ Config::get('app.list.take') }}}"
               data-column-block="4"
               data-columns="id, user_id, location_id, comment, block, created_at">
            <thead>
                <tr>
                    <th class="id-column">Id</th>
                    <th>Usuario</th>
                    <th>Punto interactivo</th>
                    <th width="500px">Comentario</th>
                    <th>Bloqueado</th>
                    <th width="120px">Creado</th>
                </tr>
            </thead>
        </table>
    </div>
    @endif
    
</div>
@stop








