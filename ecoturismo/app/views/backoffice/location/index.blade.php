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
@stop

@section('section')
PUNTOS INTERACTIVOS
@stop

@section('breadcrumb')
<li class="active">Puntos interactivos</li>
@stop

@section('content')
<div class="callout callout-info">
    <h4>Información!</h4>
    <p>Por favor tenga en cuenta que solo serán publicados los puntos interactivos que tengan al menos una etiqueta asignada, posean coordenadas y estén habilitados.</p>
</div>
<div class="box box-success">
    <div class="box-body text-right">
        @if(BackofficeResource::can('locaciones', 'create'))
        <a class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Crear un punto interactivo" href="{{ route('location.create'); }}"><i class="fa fa-plus"></i></a>
        &nbsp;
        @endif
        <a class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Salir al dashboard" href="{{ route('dashboard'); }}"><i class="fa  fa-sign-out"></i></a>
    </div>
</div>

<div class="clearfix"></div>
<div class="box">

    @if(BackofficeResource::can('locaciones', 'read'))
    <div class="box-body table-responsive">
        <table id="data-table" 
               class="table table-bordered table-striped table-hover"
               data-url-request="../admin/location/list"

              @if(BackofficeResource::can('locaciones', 'update'))
               data-url-edit="../admin/location/{id}/edit"
              @endif

              @if(BackofficeResource::can('locaciones', 'destroy'))
               data-url-destroy="../admin/location/{id}/destroy"
               data-modal-destroy="#locationDestroyModal"
               data-modal-button-destroy="#locationDestroy"
              @endif

               data-column-ranking = "3"
               data-column-action-pos="5"
               data-display-length="{{{ Config::get('app.list.take') }}}"
               data-bool-render-target="4"
               data-columns="id, name, views, ranking, enabled">
            <thead>
                <tr>
                    <th class="id-column">Id</th>
                    <th>Nombre</th>
                    <th>Visitas</th>
                    <th>Ranking</th>
                    <th>Disponible</th>
                    <th class="action-column">Acciones</th>
                </tr>
            </thead>
        </table>
    </div>
    @endif
    
</div>
@stop

<!-- MODAL -->
@if(BackofficeResource::can('locaciones', 'destroy'))
@include('backoffice.layouts.modal', array(
  'modalId'     => 'locationDestroyModal',
  'modalTitle'  => '<i class="fa fa-bell"></i> Confirmar para eliminar',
  'modalBody'   => '<div class="alert alert-danger" role="alert"><i class="fa fa-warning"></i> <b>Por favor, Confirme</b> para eliminar el punto interactivo seleccionada</div>',
  'modalFooter' => '<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <a id="locationDestroy" href="#" class="btn btn-danger">Eliminar</a>',
))
@endif








