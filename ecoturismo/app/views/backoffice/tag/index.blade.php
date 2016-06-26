@extends('backoffice.layouts.master')

@section('styles')
    {{ HTML::style('/backoffice/css/datatables/dataTables.bootstrap.css') }}
@stop

@section('scripts')
    {{ HTML::script('/backoffice/js/plugins/datatables/jquery.dataTables.js') }}
    {{ HTML::script('/backoffice/js/plugins/datatables/dataTables.bootstrap.js') }}
    {{ HTML::script('/backoffice/js/app/app.table.js') }}
@stop

@section('section')
ETIQUETAS
@stop

@section('breadcrumb')
<li class="active">Etiquetas</li>
@stop

@section('content')
<div class="box box-success">
    <div class="box-body text-right">
        @if(BackofficeResource::can('tags', 'create'))
        <a class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Crear una etiqueta" href="{{ route('tag.create'); }}"><i class="fa fa-plus"></i></a>
        &nbsp;
        @endif
        <a class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Salir al dashboard" href="{{ route('dashboard'); }}"><i class="fa  fa-sign-out"></i></a>
    </div>
</div>

<div class="clearfix"></div>
<div class="box">

    @if(BackofficeResource::can('tags', 'read'))
    <div class="box-body table-responsive">
        <table id="data-table" 
               class="table table-bordered table-striped table-hover"
               data-url-request="../admin/tag/list"

              @if(BackofficeResource::can('tags', 'update'))
               data-url-edit="../admin/tag/{id}/edit"
              @endif

              @if(BackofficeResource::can('tags', 'destroy'))
               data-url-destroy="../admin/tag/{id}/destroy"
               data-modal-destroy="#tagDestroyModal"
               data-modal-button-destroy="#tagDestroy"
              @endif

               data-column-action-pos="3"
               data-display-length="{{{ Config::get('app.list.take') }}}"
               data-columns="id, name, parent">
            <thead>
                <tr>
                    <th class="id-column">Id</th>
                    <th>Nombre</th>
                    <th>Padre</th>
                    <th class="action-column">Acciones</th>
                </tr>
            </thead>
        </table>
    </div>
    @endif
    
</div>
@stop

<!-- MODAL -->
@if(BackofficeResource::can('tags', 'destroy'))
@include('backoffice.layouts.modal', array(
  'modalId'     => 'tagDestroyModal',
  'modalTitle'  => '<i class="fa fa-bell"></i> Confirmar para eliminar',
  'modalBody'   => '<div class="alert alert-danger" role="alert"><i class="fa fa-warning"></i> <b>Por favor, Confirme</b> para eliminar la etiqueta seleccionada</div>',
  'modalFooter' => '<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <a id="tagDestroy" href="#" class="btn btn-danger">Eliminar</a>',
))
@endif








