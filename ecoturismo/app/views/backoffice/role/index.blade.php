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
ROLES
@stop

@section('breadcrumb')
<li class="active">Roles</li>
@stop

@section('content')
<div class="box box-success">
    <div class="box-body text-right">
        @if(BackofficeResource::can('roles', 'create'))
        <a class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Crear role" href="{{ route('role.create'); }}"><i class="fa fa-plus"></i></a>
        &nbsp;
        @endif
        <a class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Salir al dashboard" href="{{ route('dashboard'); }}"><i class="fa  fa-sign-out"></i></a>
    </div>
</div>

<div class="clearfix"></div>
<div class="box">

    @if(BackofficeResource::can('roles', 'read'))
    <div class="box-body table-responsive">
        <table id="data-table" 
               class="table table-bordered table-striped table-hover"
               data-url-request="../admin/role/list"
               
              @if(BackofficeResource::can('roles', 'update'))
               data-url-edit="../admin/role/{id}/edit"
              @endif

              @if(BackofficeResource::can('roles', 'destroy'))
               data-url-destroy="../admin/role/{id}/destroy"
               data-modal-destroy="#roleDestroyModal"
               data-modal-button-destroy="#roleDestroy"
              @endif

               data-column-action-pos="2"
               data-display-length="{{{ Config::get('app.list.take') }}}"
               data-columns="id, name">
            <thead>
                <tr>
                    <th class="id-column">Id</th>
                    <th>Role</th>
                    <th class="action-column">Acciones</th>
                </tr>
            </thead>
        </table>
    </div>
    @endif
    
</div>
@stop


<!-- MODAL -->
@if(BackofficeResource::can('roles', 'destroy'))
@include('backoffice.layouts.modal', array(
  'modalId'     => 'roleDestroyModal',
  'modalTitle'  => '<i class="fa fa-bell"></i> Confirmar para eliminar',
  'modalBody'   => '<div class="alert alert-danger" role="alert"><i class="fa fa-warning"></i> <b>Por favor, Confirme</b> para eliminar el role seleccionado</div>',
  'modalFooter' => '<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <a id="roleDestroy" href="#" class="btn btn-danger">Eliminar</a>',
))
@endif
