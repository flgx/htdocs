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
USUARIOS
@stop

@section('breadcrumb')
<li class="active">Usuarios</li>
@stop

@section('content')
<div class="box box-success">
    <div class="box-body text-right">
        @if(BackofficeResource::can('usuarios', 'create'))
        <a class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Crear usuario" href="{{ route('user.create'); }}"><i class="fa fa-plus"></i></a>
        &nbsp;
        @endif
        <a class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Salir al dashboard" href="{{ route('dashboard'); }}"><i class="fa  fa-sign-out"></i></a>
    </div>
</div>

<div class="clearfix"></div>
<div class="box">

    @if(BackofficeResource::can('usuarios', 'read'))
    <div class="box-body table-responsive">
        <table id="data-table" 
               class="table table-bordered table-striped table-hover"
               data-url-request="../admin/user/list"

              @if(BackofficeResource::can('usuarios', 'update'))
               data-url-edit="../admin/user/{id}/edit"
              @endif

              @if(BackofficeResource::can('usuarios', 'destroy'))
               data-url-destroy="../admin/user/{id}/destroy"
               data-modal-destroy="#userDestroyModal"
               data-modal-button-destroy="#userDestroy"
              @endif

               data-column-action-pos="6"
               data-display-length="{{{ Config::get('app.list.take') }}}"
               data-bool-render-target="5"
               data-columns="id, role, first_name, last_name, email, enabled">
            <thead>
                <tr>
                    <th class="id-column">Id</th>
                    <th>Role</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Email</th>
                    <th>Habilitado</th>
                    <th class="action-column">Acciones</th>
                </tr>
            </thead>
        </table>
    </div>
    @endif
    
</div>
@stop

<!-- MODAL -->
@if(BackofficeResource::can('usuarios', 'destroy'))
@include('backoffice.layouts.modal', array(
  'modalId'     => 'userDestroyModal',
  'modalTitle'  => '<i class="fa fa-bell"></i> Confirmar para eliminar',
  'modalBody'   => '<div class="alert alert-danger" role="alert"><i class="fa fa-warning"></i> <b>Por favor, Confirme</b> para eliminar el usuaro seleccionado</div>',
  'modalFooter' => '<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <a id="userDestroy" href="#" class="btn btn-danger">Eliminar</a>',
))
@endif








