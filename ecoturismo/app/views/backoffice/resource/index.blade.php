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
RECURSOS DEL SISTEMA
@stop

@section('breadcrumb')
<li class="active">Recursos</li>
@stop

@section('content')
<div class="box box-success">
    <div class="box-body text-right">
        @if(BackofficeResource::can('recursos', 'create'))
        <a class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Crear recurso" href="{{ route('resource.create'); }}"><i class="fa fa-plus"></i></a>
        &nbsp;
        @endif
        <a class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Salir al dashboard" href="{{ route('dashboard'); }}"><i class="fa  fa-sign-out"></i></a>
    </div>
</div>

<div class="clearfix"></div>
<div class="box">

    @if(BackofficeResource::can('recursos', 'read'))
    <div class="box-body table-responsive">
        <table id="data-table" 
               class="table table-bordered table-striped table-hover"
               data-url-request="../admin/resource/list"

              @if(BackofficeResource::can('recursos', 'update'))
               data-url-edit="../admin/resource/{id}/edit"
              @endif
  
              @if(BackofficeResource::can('recursos', 'destroy'))
               data-url-destroy="../admin/resource/{id}/destroy"
               data-modal-destroy="#resourceDestroyModal"
               data-modal-button-destroy="#resourceDestroy"
              @endif

               data-column-action-pos="3"
               data-display-length="{{{ Config::get('app.list.take') }}}"
               data-columns="id, module, action">
            <thead>
                <tr>
                    <th class="id-column">Id</th>
                    <th>Modulo</th>
                    <th>Acción</th>
                    <th class="action-column">Acciones</th>
                </tr>
            </thead>
        </table>
    </div>
    @endif
    
</div>
@stop

<!-- MODAL -->
@if(BackofficeResource::can('recursos', 'destroy'))
@include('backoffice.layouts.modal', array(
  'modalId'     => 'resourceDestroyModal',
  'modalTitle'  => '<i class="fa fa-bell"></i> Confirmar para eliminar',
  'modalBody'   => '<div class="alert alert-danger" role="alert"><i class="fa fa-warning"></i> <b>Por favor, Confirme</b> para eliminar el recurso seleccionado</div>',
  'modalFooter' => '<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <a id="resourceDestroy" href="#" class="btn btn-danger">Eliminar</a>',
))
@endif